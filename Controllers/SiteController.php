<?php

namespace App\controllers;

use App\models\Post;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

class SiteController
{
  public function __construct()
  {
    Router::$router->setLayout('layouts/main');
  }
  public function index(Request $req, Response $res)
  {
    // Rendering home view
    $res->render("home");
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
