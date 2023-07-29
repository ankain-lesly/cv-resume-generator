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

  public function SinglePost(Request $req, Response $res)
  {
    $param = $req->params('post_id');

    $res->render("single-post", ['post_id' => $param]);
  }
  public function createPost(Request $req, Response $res)
  {
    if ($req->isPost()) {
      $PostObject = new Post();
      $PostObject->loadData($req->body());

      if ($PostObject->validate() && $PostObject->save()) {
        // create an alert or notification here
        $res->render("home");
        exit;
      }
      $errors =  $PostObject->getErrors();
      $res->render("create-product", $errors);
    }

    $res->render("create-product");
  }
}