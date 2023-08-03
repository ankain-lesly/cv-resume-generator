<?php

namespace App\Controllers;

use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

// middlewares
use App\Middlewares\AuthMiddleware;
use App\Models\Template;
use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\Session;

class MainController
{
  private Template $templateObj;
  private Session $session;
  private DataAccess $DataAccess;
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
    $this->templateObj = new Template();
    $AuthMiddleware = new AuthMiddleware();
    $AuthMiddleware->isUser();
    Router::$router->setLayout('layouts/dashboard');
    $this->session = new Session();
    $this->DataAccess = new DataAccess();
  }
  public function index(Request $req, Response $res)
  {
    // Rendering home view
    $res->render("_dashboard/index");
  }

  public function resumes(Request $req, Response $res)
  {
    $user = $this->session->get('user') ?? exit('Not authorized...');
    $sql_meta = "SELECT *
                FROM tblresume_metadata WHERE user_id = ?";
    $meta = $this->DataAccess->findAll(
      $sql_meta,
      [$user['userID']]
    );
    // Rendering home view
    $res->render("_dashboard/my-resumes", ['metadata' => $meta]);
  }
  public function templates(Request $req, Response $res)
  {
    $api = $req->query('api');

    $useTemplate = $req->query('use');
    $unuseTemplate = $req->query('unuse');

    if ($useTemplate) {
      $data = ['status' => 1, 'template_id' => $useTemplate];
      $this->templateObj->update($data, ['template_id']);
      $this->session->setToast("toast", "Template Activated ✔");
      $res->redirect("/templates/resume");
    } else if ($unuseTemplate) {
      $data = ['status' => 0, 'template_id' => $unuseTemplate];
      $this->templateObj->update($data, ['template_id']);
      $this->session->setToast("toast", "Template Deactivated 🚩");
      $res->redirect("/templates/resume");
    }

    $user = $this->session->get('user');

    if ($api) {
      $templates = $this->templateObj->findAll(
        ['user_id' => $user['userID']],
        ['status' => 1],
        ["thumbnail", "status", "template_id"]
      );
      return $res->json($templates);
    }

    $templates = $this->templateObj->findAll(
      ['user_id' => $user['userID']],
      ["thumbnail", "status", "template_id"]
    );

    $templates = $templates['data'] ?? [];

    $res->render("_dashboard/show-templates", ["user" => $this->session, "templates" => $templates]);
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