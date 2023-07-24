<?php

declare(strict_types=1);
header('Access-Control-Allow-Origin:*');
// header("Content-Type: application/json; charset=UTF-8");

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../Config/config.php";

use Devlee\XRouter\Router;
use App\controllers\SiteController;
use App\controllers\AuthController;
use App\controllers\ResumeController;

$router = new Router(__DIR__);

// Router Configurations
$router->config("views", "layouts/main", "_404");

$router->interceptRequest();

// Regular Views
$router->get("/", [SiteController::class, 'index']);

$router->get("/dashboard", "@dashboard");
$router->get("/module", "Module");

//API
$router->get("/create/post", [SiteController::class, 'createPost']);
$router->post("/api/create/post", [SiteController::class, 'createPost']);

//Auth Test
$router->get("/info", [AuthController::class, 'get_user_info']);

$router->get("/login", [AuthController::class, 'login']);
$router->post("/api/auth/login", [AuthController::class, 'login']);

$router->get("/api/auth/logout", [AuthController::class, 'logout']);

$router->get("/register", [AuthController::class, 'register']);
$router->post("/api/auth/register", [AuthController::class, 'register']);



// Get Resume Data
$router->get("/resume/{resume_key}/", [ResumeController::class, 'getResumeData']);
$router->get("/resume/create/{resume_id}", [ResumeController::class, 'createResume']);
// Get Resume Setup on edit
$router->post("/resume/on_edit/{template_id}", [ResumeController::class, 'setupResume']);

// Router resolve
$router->resolve();