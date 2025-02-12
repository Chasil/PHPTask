<?php

namespace App\Model;

class GithubUserData
{
    private GithubFetcher $fetcher;
    private LanguageCalculator $languageCalculator;

    /**
     * @param GithubFetcher $fetcher
     * @param LanguageCalculator $languageCalculator
     */
    public function __construct(GithubFetcher $fetcher, LanguageCalculator $languageCalculator)
    {
        $this->fetcher = $fetcher;
        $this->languageCalculator = $languageCalculator;
    }

    /**
     * @param string $username
     * @return array|null
     */
    public function getUserData(string $username): ?array
    {
        $user = $this->fetcher->fetchUser($username);
        if (!$user) {
            return null;
        }

        $repositories = $this->fetcher->fetchRepositories($user['repos_url']);
        $languages = $this->languageCalculator->calculate($repositories);

        return [
            'user' => $user,
            'repositories' => $repositories,
            'languages' => $languages,
        ];
    }
}