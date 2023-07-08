<?php

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";

use Devlee\XRouter\Router;
use Devlee\mvccore\DB\DBModel;
use App\controllers\SiteController;
use App\controllers\AuthController;

$router = new Router(__DIR__);

// Database Configurations
$DB_Config = [
  'host' => 'localhost',
  'user' => 'root',
  'password' => '',
  'name' => 'ken-car-web',
  //'name' => 'db_demo_blog',
];

DBModel::SetDatabaseDetails($DB_Config);
// Router Configurations
$router->config("views", "layouts/main", "_404");

// $router->interceptRequest();

$router->get("/", [SiteController::class, 'index']);
$router->get("/dashboard", "@dashboard");
$router->get("/module", "Module");

// $router->get("/create/post", [SiteController::class, 'createPost']);
// $router->post("/create/post", [SiteController::class, 'createPost']);

$router->get("/login", [AuthController::class, 'login']);
$router->post("/login", [AuthController::class, 'login']);

$router->get("/register", [AuthController::class, 'register']);
$router->post("/register", [AuthController::class, 'register']);

$router->resolve();
