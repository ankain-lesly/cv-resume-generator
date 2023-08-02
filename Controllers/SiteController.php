<?php

namespace App\Controllers;

use App\Models\Template;
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
    $templates = (new Template())->findAll(['status' => 1], ["template_id", "thumbnail"]);
    $templates = $templates['data'] ?? [];

    // Rendering home view
    $res->render("home", ['templates' => $templates]);
  }

  public function contact(Request $req, Response $res)
  {
    $res->render("contact");
  }
}