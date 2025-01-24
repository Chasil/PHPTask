<?php

namespace App\Model;

class GithubFetcher
{
    private string $apiBase = "https://api.github.com/users/";

    /**
     * @param string $username
     * @return array|null
     */
    public function fetchUser(string $username): ?array
    {
        return $this->fetch($this->apiBase . $username);
    }

    /**
     * @param string $reposUrl
     * @return array|null
     */
    public function fetchRepositories(string $reposUrl): ?array
    {
        return $this->fetch($reposUrl);
    }

    /**
     * @param string $url
     * @return array|null
     */
    private function fetch(string $url): ?array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'GitHub Resume Generator');
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}