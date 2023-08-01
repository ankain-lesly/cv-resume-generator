<?php

namespace App\Controllers;

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
}