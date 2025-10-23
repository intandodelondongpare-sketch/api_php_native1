<?php
use Src\Router;
use Src\Controllers\UserController;

require __DIR__ . '/../src/Router.php';
require __DIR__ . '/../src/controllers/UserController.php';

$router = new Router();
$userController = new UserController();

// SESUAIKAN PATH DENGAN URL
$router->add('GET', '/api-php-native1/public/api/v1/users', [$userController, 'index']);
$router->add('GET', '/api-php-native1/public/api/v1/users/1', fn() => $userController->show(1));

$router->run();