<?php

namespace App\Controller;

use App\Model\GithubFetcher;
use App\Model\LanguageCalculator;
use App\Model\GithubUserData;

class HomeController
{
    private GithubUserData $githubUserData;

    public function __construct()
    {
        $fetcher = new GithubFetcher();
        $languageCalculator = new LanguageCalculator();
        $this->githubUserData = new GithubUserData($fetcher, $languageCalculator);
    }

    public function index(): void
    {
        require_once __DIR__ . '/../View/home.php';
    }

    public function generate(): void
    {
        $username = $_POST['username'] ?? null;
        if (!$username) {
            throw new \InvalidArgumentException('Username is required');
        }

        $data = $this->githubUserData->getUserData($username);

        if (!$data) {
            throw new \RuntimeException('User not found');
        }

        require_once __DIR__ . '/../View/resume.php';
    }
}