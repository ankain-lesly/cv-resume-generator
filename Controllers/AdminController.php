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

      $file_options_image = [
        "path" => "/resumes/thumbnails/",
        "filename" => "TEMPLATE-" . $template_id,
        "accept" => ['jpg', 'jpeg', 'png']
      ];
      $file_options_php = [
        "path" => "/resumes\/",
        "filename" => "Design-" . $template_id,
        "accept" => [".phpp"]
      ];
      $file_options_css = [
        "path" => "/resumes/design/",
        "filename" => "Design-" . $template_id,
        "accept" => [".csss"]
      ];


      // settings: Image
      $data['thumbnail'] = $FileHandler->setup($file_options_image, $file_image);
      // settings: PHP
      $data['php_file'] = $FileHandler->setup($file_options_image, $file_php);
      // settings: CSS
      $data['css_file'] = $FileHandler->setup($file_options_image, $file_css);

      $FileHandler->upload();


      echo '<pre>';
      print_r($data);
      print_r($_FILES);
      echo '</br>';
      echo '</pre>';
      exit();

      // if ($data['cover_photo']) {
      //   $update = $this->templateObj->update($data, ['template_id']);
      //   if ($update) $res->json(['success' => true, 'cover' => $data['cover_photo']]);
      //   exit;
      // }
      // Getting Resume Data 

      $meta = $data['meta'] ?? false;

      $data['template_id'] = $meta['resume'];

      $update = $this->templateObj->update($data, ['template_id']);

      if ($update) $res->json(['success' => true]);
      exit;
    }

    $res->render("resume/template");
  }
}