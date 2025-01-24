<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;

$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri === '' || $uri === 'home') {
	$controller = new HomeController();
	$controller->index();
} elseif ($uri === 'generate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$controller = new HomeController();
	$controller->generate();
} else {
	http_response_code(404);
	echo "Page not found.";
}
