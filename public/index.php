<?php

declare(strict_types=1);

session_start();
header('Access-Control-Allow-Origin:*');
// header("Content-Type: application/json; charset=UTF-8");

/** User: Dev Lee ... */
require_once __DIR__ . "/../vendor/autoload.php";
// App Configurations
require_once "config.php";

use App\Controllers\AdminController;
use Devlee\XRouter\Router;
use App\Controllers\SiteController;
use App\Controllers\AuthController;
use App\Controllers\ResumeController;
use App\Controllers\MainController;

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
$router->get("/resume/{resume_id}/", [ResumeController::class, 'getResumeData']);
// $router->get("/resume/meta/", [ResumeController::class, 'getMetaData']);
// $router->get("/resume/meta/{resume_key}/", [ResumeController::class, 'getResumeData']);
$router->get("/app/create/resume/{resume_id}", [ResumeController::class, 'createResumeDemo']);
$router->get("/resume/create/{resume_id}", [ResumeController::class, 'createResume']);
$router->post("/resume/create/{resume_id}", [ResumeController::class, 'createResume']);
// Get Resume Setup on edit
$router->post("/resume/edit/{template_id}", [ResumeController::class, 'setupResume']);

// Templates
$router->get("/new/template", [AdminController::class, 'createTemplate']);
$router->post("/new/template", [AdminController::class, 'createTemplate']);
// Dashboard
$router->get("/app", [MainController::class, 'index']);
$router->get("/app/", [MainController::class, 'index']);
$router->get("/app/resumes", [MainController::class, 'resumes']);
$router->get("/templates/{type}", [MainController::class, 'templates']);
$router->get("/api/templates/{type}", [MainController::class, 'templates']);
$router->get("/account/settings", [MainController::class, 'settings']);
$router->get("/app/get-started", '@_dashboard/get-started');
$router->get("/user/profile", [AuthController::class, 'profile']);
$router->post("/user/profile", [AuthController::class, 'profile']);

// Router resolve
$router->resolve();