<?php

namespace App\Model;

class GithubApi
{
	private string $apiBase = "https://api.github.com/users/";

	/**
	 * @param $username
	 * @return array|null
	 */
    public function getUserData($username): ?array
    {
        $user = $this->fetch($this->apiBase . $username);
        if (!$user) return null;

        $repos = $this->fetch($user['repos_url']);
        return [
            'user' => $user,
            'repositories' => $repos,
            'languages' => $this->calculateLanguages($repos),
        ];
    }

	/**
	 * @param string $url
	 * @return array
	 */
    private function fetch(string $url): array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'GitHub Resume Generator');
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

	/**
	 * @param array $repos
	 * @return array
	 */
    private function calculateLanguages(array $repos): array
    {
        $languages = [];
        foreach ($repos as $repo) {
            if (!isset($repo['language']) || !$repo['language']) continue;
            $languages[$repo['language']] = ($languages[$repo['language']] ?? 0) + $repo['size'];
        }

        $totalSize = array_sum($languages);
        foreach ($languages as $lang => $size) {
            $languages[$lang] = round(($size / $totalSize) * 100, 2);
        }

        return $languages;
    }
}
