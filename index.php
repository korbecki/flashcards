<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('flashcards', 'FlashcardsController');
Routing::post('login', 'AuthController');
Routing::post('register', 'RegisterController');
Routing::post('addFlashcards', 'FlashcardsController');
Routing::post('search', 'FlashcardsController');
Routing::post('resolve', 'ResolveController');
Routing::post('saveAttempt', 'ResolveController');
Routing::post('getNextPage', 'ResolveController');
Routing::run($path);