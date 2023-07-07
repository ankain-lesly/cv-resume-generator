<?php

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router(__DIR__);

// Database Configurations
$DB_Config = [
  'host' => 'localhost',
  'user' => 'root',
  'password' => '',
  'name' => 'db_demo_blog',
];

DbModel::SetDatabaseDetails($DB_Config);
// Router Configurations
$router->config("templates", "layouts/main", "_404");

$router->interceptRequest();

$router->get("/", [MainController::class, 'index']);
$router->get("/home", [MainController::class, 'index']);
$router->get("/contact", [MainController::class, 'contact']);

$router->get("/blog/{post_id}", [MainController::class, 'SinglePost']);

$router->get("/create/post", [MainController::class, 'createPost']);
$router->post("/create/post", [MainController::class, 'createPost']);

// $router->get("/login", [AuthController::class, 'login']);
// $router->post("/login", [AuthController::class, 'login']);
// $router->get("/register", [AuthController::class, 'register']);
// $router->post("/register", [AuthController::class, 'register']);

$router->resolve();
