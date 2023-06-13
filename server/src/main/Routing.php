<?php

require_once 'php/controller/DefaultController.php';
require_once 'php/controller/AuthController.php';
require_once 'php/controller/RegisterController.php';
require_once 'php/controller/FlashcardsController.php';
require_once 'php/controller/ResolveController.php';
require_once 'php/controller/ActivateController.php';
class Routing
{
    public static $routes;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $action = explode("/", $url)[0];
        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $object -> $action();
    }
}