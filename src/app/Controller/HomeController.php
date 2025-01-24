<?php

namespace App\Controller;

use App\Model\GitHubApi;

class HomeController
{
	public function index(): void
	{
		require_once __DIR__ . '/../View/home.php';
	}

	public function generate(): void
	{
		$username = $_POST['username'] ?? null;
		if (!$username) {
			header('Location: /');
			exit;
		}

		$githubApi = new GitHubApi();
		$data = $githubApi->getUserData($username);

		if (!$data) {
			echo "User not found";
			exit;
		}

		require_once __DIR__ . '/../View/resume.php';
	}
}