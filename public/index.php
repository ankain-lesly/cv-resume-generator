<?php
declare(strict_types=1);
header('Accept-Control-Allow-Origin:*');
header("Content-Type: application/json; charset=UTF-8");

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";

use Devlee\XRouter\Router;
use Devlee\mvccore\DB\DBModel;
use App\controllers\SiteController;
use App\controllers\AuthController;

$router = new Router(__DIR__);

// Router Configurations
$router->config("views", "layouts/main", "_404");

$router->interceptRequest();

// Regular Views
$router->get("/", [SiteController::class, 'index']);
$router->get("/dashboard", "@dashboard");
$router->get("/module", "Module");

//API
$router->get("/api/test/", function($req, $res) {
	$res->json(["status" => "success", "user" => "Dev Lee"]);
});

$router->get("/create/post", [SiteController::class, 'createPost']);
$router->post("/api/create/post", [SiteController::class, 'createPost']);

$router->get("/login", [AuthController::class, 'login']);
$router->post("/api/auth/login", [AuthController::class, 'login']);

$router->get("/register", [AuthController::class, 'register']);
$router->post("/api/auth/register", [AuthController::class, 'register']);

$router->resolve();
