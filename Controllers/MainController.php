<?php

namespace App\controllers;

use App\models\Post;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

// middlewares
use App\Middlewares\AuthMiddleware;
use Devlee\mvccore\Session;

class MainController
{
  private Session $session;
  public function __construct()
  {
    /**
     * Introducing middle wares
     *
     * Middleware => AuthMiddleware
     *  ::isUser(token);
     *  ::isAdmin(role);
     *
     */
    $AuthMiddleware = new AuthMiddleware();
    $AuthMiddleware->isUser();
    Router::$router->setLayout('layouts/dashboard');
    $this->session = new Session();
  }
  public function index(Request $req, Response $res)
  {
    // Rendering home view
    $res->render("_dashboard/index");
  }
  public function resumes(Request $req, Response $res)
  {
    $resume = new ResumeController('nolayout');
    $meta = $resume->getMetaData();
    // Rendering home view
    $res->render("_dashboard/my-resumes", ['metadata' => $meta]);
  }
  public function templates(Request $req, Response $res)
  {
    $res->render("_dashboard/templates");
  }
  public function settings(Request $req, Response $res)
  {
    $res->render("_dashboard/settings");
  }

  public function contact(Request $req, Response $res)
  {
    $res->render("contact");
  }
}
