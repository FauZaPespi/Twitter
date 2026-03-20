<?php
namespace Fauza\Template\Config;

use Fauza\Template\Controllers\AuthController;
use Fauza\Template\Controllers\MainController;
use Fauza\Template\Controllers\PostController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$app->get('/',    [MainController::class, 'home']);
$app->get('/api', [MainController::class, 'api']);

// Auth
$app->get('/login',    [AuthController::class, 'showLogin']);
$app->post('/login',   [AuthController::class, 'login']);
$app->get('/register', [AuthController::class, 'showRegister']);
$app->post('/register',[AuthController::class, 'register']);
$app->get('/profile',  [AuthController::class, 'profile']);
$app->post('/logout',  [AuthController::class, 'logout']);

// Posts
$app->post('/api/posts/view/:number', [PostController::class, 'view']);