<?php

namespace App\controllers;

use Devlee\mvccore\Library;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

use Devlee\mvccore\Session;
// middlewares
use App\Middlewares\AuthMiddleware;
use app\models\Resume;
use app\models\TemplateDesign;
// use app\models\Template;
use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\FileUpload;
// PDF for Dompdf 

class AdminController
{
  public Session $session;
  private TemplateDesign $templateObj;
  private DataAccess $DataAccess;

  public function __construct()
  {
    $this->session = new Session();
    $this->DataAccess = new DataAccess();

    $this->templateObj = new TemplateDesign();
    $AuthMiddleware = new AuthMiddleware();
    $AuthMiddleware->isAdmin();

    Router::$router->setLayout('');
  }

  public function createTemplate(Request $req, Response $res)
  {
    $key = $req->params('template_id');

    if ($req->isPost()) {
      $data = $req->body();
      if (isset($data['cover_photo']) && !empty($_FILES)) {
        $image = $_FILES['image'];

        $file_options = [
          "path" => Router::root_folder() . "/uploads/covers/",
          "filename" => "RESUME-" . $data['resume_id'],
        ];

        $FileHandler = new FileUpload();
        $FileHandler->options($file_options);

        $data['cover_photo'] = $FileHandler->upload($image);

        // if ($data['cover_photo']) {
        //   $update = $this->templateObj->update($data, ['resume_id']);
        //   if ($update) $res->json(['success' => true, 'cover' => $data['cover_photo']]);
        //   exit;
        // }
      }
      // Getting Resume Data
      $data['personal'] = json_encode($data['personal']  ?? "");
      $data['extras'] = json_encode($data['extras']  ?? "");
      $data['education'] = json_encode($data['education']  ?? "");
      $data['experience'] = json_encode($data['experience']  ?? "");
      $data['social'] = json_encode($data['social']  ?? "");
      $data['language'] = json_encode($data['language']  ?? "");
      $data['skill'] = json_encode($data['skill']  ?? "");
      $data['hobby'] = json_encode($data['hobby']  ?? "");

      $meta = $data['meta'] ?? false;

      $data['resume_id'] = $meta['resume'];

      // $update = $this->templateObj->update($data, ['resume_id']);

      // if ($update) $res->json(['success' => true]);
      exit;
    }

    $res->render("resume/template");
  }
}