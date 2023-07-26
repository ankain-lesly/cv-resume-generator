<?php

declare(strict_types=1);

session_start();
header('Access-Control-Allow-Origin:*');
// header("Content-Type: application/json; charset=UTF-8");

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../Config/config.php";

use Devlee\XRouter\Router;
use App\controllers\SiteController;
use App\controllers\AuthController;
use App\controllers\ResumeController;
use App\controllers\MainController;

$router = new Router(__DIR__);

// Router Configurations
$router->config("views", "layouts/main", "_404");

// $router->interceptRequest();

// Regular Views
$router->get("/", [SiteController::class, 'index']);

$router->get("/account/login", [AuthController::class, 'login']);
$router->get("/account/signup", [AuthController::class, 'signup']);
$router->get("/account/logout", [AuthController::class, 'logout']);
// $router->get("/account/verification", [AuthController::class, 'verify']);

//APIs
$router->post("/auth/login", [AuthController::class, 'login']);
$router->post("/auth/signup", [AuthController::class, 'signup']);

// Resume
$router->post("/resume/meta", [ResumeController::class, 'createMeta']);
$router->get("/resume/{resume_key}/", [ResumeController::class, 'getResumeData']);
// $router->get("/resume/meta/", [ResumeController::class, 'getMetaData']);
// $router->get("/resume/meta/{resume_key}/", [ResumeController::class, 'getResumeData']);
$router->get("/resume/create/{resume_id}", [ResumeController::class, 'createResume']);
// Get Resume Setup on edit
$router->post("/resume/on_edit/{template_id}", [ResumeController::class, 'setupResume']);

// Dashboard
$router->get("/dashboard/", [MainController::class, 'index']);
$router->get("/dashboard/resumes", [MainController::class, 'resumes']);
$router->get("/dashboard/templates", [MainController::class, 'templates']);
$router->get("/account/settings", [MainController::class, 'settings']);
$router->get("/dashboard/get-started", '@_dashboard/get-started');
$router->get("/user/profile", [MainController::class, 'profile']);

// Router resolve
$router->resolve();