<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('flashcards', 'DefaultController');
Routing::post('login', 'AuthController');
Routing::post('register', 'RegisterController');
Routing::run($path);