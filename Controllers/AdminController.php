<?php

namespace App\Controllers;

use Devlee\mvccore\Library;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

use Devlee\mvccore\Session;
// middlewares
use App\Middlewares\AuthMiddleware;
use App\Models\Template;
use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\FileUpload;
// PDF for Dompdf 

class AdminController
{
  public Session $session;
  private Template $templateObj;
  private DataAccess $DataAccess;

  public function __construct()
  {
    $this->session = new Session();
    $this->DataAccess = new DataAccess();

    $this->templateObj = new Template();
    $AuthMiddleware = new AuthMiddleware();
    $AuthMiddleware->isAdmin();

    Router::$router->setLayout('');
  }

  public function createTemplate(Request $req, Response $res)
  {
    $key = $req->params('template_id');

    if ($req->isPost()) {
      $data = $req->body();

      $file_image = $_FILES['file_image'];
      $file_php = $_FILES['file_php'];
      $file_css = $_FILES['file_css'];

      $FileHandler = new FileUpload();

      $template_id = Library::generateToken(10);
      $data['template_id'] = $template_id;
      $data['user_id'] = $this->session->get('user')['userID'];

      $file_options_image = [
        "path" => "/resumes/thumbnails/",
        "filename" => "TEMPLATE-" . $template_id,
        "accept" => [".jpg", ".jpeg", ".png"]
      ];
      $file_options_php = [
        "path" => "/resumes\/",
        "filename" => "Design-" . $template_id,
        "accept" => [".php"]
      ];
      $file_options_css = [
        "path" => "/resumes/design/",
        "filename" => "Design-" . $template_id,
        "accept" => [".css"]
      ];


      // settings: Image
      $data['thumbnail'] = $FileHandler->setup($file_options_image, $file_image);
      // settings: PHP
      $data['php_file'] = $FileHandler->setup($file_options_php, $file_php);
      // settings: CSS
      $data['css_file'] = $FileHandler->setup($file_options_css, $file_css);

      $FileHandler->upload();

      if ($FileHandler->errors()) {
        //handling upload errors
        echo "UPLOAD ERROR! \\n";

        echo '<pre>';
        print_r($FileHandler->errors());
        echo '</br>';
        exit;
      }

      $this->templateObj->loadData($data);
      $response = $this->templateObj->insert();

      // if ($response) $res->json(['success' => true]);
      if ($response) $this->session->setToast("toast", "Template added successfully");
      else $this->session->setToast("toast", "Ooops failed to create template 🚩");
      $res->redirect("/new/template");
    }

    $res->render("resume/template");
  }
}