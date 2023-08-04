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
// password reset
$router->get("/account/reset-password", [AuthController::class, 'resetPassword']);
$router->post("/account/reset-password", [AuthController::class, 'resetPassword']);
// password change
$router->get("/account/change-password", [AuthController::class, 'changePassword']);
$router->post("/account/change-password", [AuthController::class, 'changePassword']);

//APIs
$router->post("/auth/login", [AuthController::class, 'login']);
$router->post("/auth/signup", [AuthController::class, 'signup']);

// Resume
$router->post("/resume/meta", [ResumeController::class, 'createMeta']);
$router->get("/resume/{resume_id}/", [ResumeController::class, 'getResumeData']);

// Resume workspace: user, client
$router->get("/app/create/resume/{resume_id}/", [ResumeController::class, 'createResume']);
$router->get("/resume/edit/{resume_id}", [ResumeController::class, 'createResume']);

// Get Resume Setup on edit
$router->post("/resume/update/{resume_id}", [ResumeController::class, 'createResume']);
$router->post("/resume/render/{template_id}", [ResumeController::class, 'setupResume']);

// Templates
$router->get("/new/template", [AdminController::class, 'createTemplate']);
$router->post("/new/template", [AdminController::class, 'createTemplate']);
// Dashboard
$router->get("/app", [MainController::class, 'index']);
$router->get("/app/", [MainController::class, 'index']);
// resume
$router->get("/app/resumes", [MainController::class, 'resumes']);
$router->get("/templates/{type}", [MainController::class, 'templates']);
$router->get("/api/templates/{type}", [MainController::class, 'templates']);
// account
$router->get("/account/settings", [MainController::class, 'settings']);
$router->get("/app/get-started", '@_dashboard/get-started');
// profile
$router->get("/user/profile", [AuthController::class, 'profile']);
$router->post("/user/profile", [AuthController::class, 'profile']);

$router->get("/about", '@about');
$router->get("/forum", '@forum');
$router->get("/letech", '@letech');

// Router resolve
$router->resolve();