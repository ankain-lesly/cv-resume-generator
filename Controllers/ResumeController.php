<?php

namespace App\Controllers;

use Devlee\mvccore\Library;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

use Devlee\mvccore\Session;
// middlewares
use App\Middlewares\AuthMiddleware;
use App\Models\Resume;
use App\Models\Template;
use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\FileUpload;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

// PDF for Dompdf 

class ResumeController
{
  public Session $session;
  private Resume $resumeObj;
  private DataAccess $DataAccess;

  public function __construct($option = null)
  {
    $this->session = new Session();
    $this->DataAccess = new DataAccess();

    $this->resumeObj = new Resume();
    // $AuthMiddleware = new AuthMiddleware();
    // $AuthMiddleware->isUser("options");

    Router::$router->setLayout('');
  }

  public function createMeta(Request $req, Response $res)
  {
    $data = $req->body();
    $user = $this->session->get('user');
    if (isset($data['update_meta']) && $user) {
      $sql_resume = "UPDATE tblresume_metadata SET template_id = ? WHERE user_id = ? AND resume_id = ?";

      $resume = $this->DataAccess->query(
        $sql_resume,
        [$data['template_id'], $user['userID'], $data['resume_id']]
      );

      if ($resume) $res->json(['success' => true, "template" => $data['template_id']]);
      exit;
    }



    $meta_id = Library::generateToken(12);
    $resume_id = Library::generateToken(12);

    $user = $this->session->get('user') ?: exit(json_encode(['auth' => true]));
    if ($user['_sess_token'] !== $data['token']) exit(json_encode(['auth' => true]));

    $sql_meta = "INSERT INTO tblresume_metadata 
          (meta_id, user_id, template_id, title, description, resume_id)
          VALUES (?,?,?,?,?,?)";

    $meta = $this->DataAccess->insert(
      $sql_meta,
      [$meta_id, $user['userID'], $data['template'], $data['title'], $data['description'], $resume_id]
    );

    if ($meta) {
      $sql_resume = "INSERT INTO tblresumes
          (resume_id)
          VALUES (?)";

      $resume = $this->DataAccess->insert(
        $sql_resume,
        [$resume_id]
      );

      if ($resume) {
        $this->session->setToast("toast", "Huureyu! Resume created, Welcome to your resume designer. Get started");
        $meta_data = array(
          'success' => true,
          "resume" => $resume_id
        );
        $res->json($meta_data);
      }
    }
  }
  // public function getMetaData(Request $req, Response $res)
  public function getMetaData()
  {
    $user = $this->session->get('user') ?? exit(json_encode(['auth' => true]));
    $sql_meta = "SELECT *
                FROM tblresume_metadata WHERE user_id = ?";

    $meta = $this->DataAccess->findAll(
      $sql_meta,
      [$user['userID']]
    );

    return $meta;
  }
  public function createResume(Request $req, Response $res)
  {
    $user = $this->session->get('user');
    $resume_id = $req->params('resume_id');
    $basis = $req->query('x-status');

    if ($req->isPost()) {
      $data = $req->body();
      if (isset($data['cover_photo']) && !empty($_FILES)) {
        $image = $_FILES['image'];

        $key = $data['resume_id'];

        if ($data['current']) {
          $current = Router::root_folder() . "/uploads/covers/" . $data['current'];
          if (file_exists($current)) unlink($current);
          $key = Library::generateToken(12);
        }

        $file_options = [
          "path" => "/uploads/covers/",
          "filename" => $user ? "RESUME-" . $key : "Untited-R-" . $key,
          "accept" => ['.jpg', '.jpeg', '.png']
        ];

        $FileHandler = new FileUpload();

        // settings
        $data['cover_photo'] = $FileHandler->setup($file_options, $image);

        if ($FileHandler->errors()) return;

        $FileHandler->upload();

        $update = $this->resumeObj->update($data, ['resume_id']);
        if ($update) $res->json(['success' => true, 'cover' => $data['cover_photo']]);
        exit;
      }
      // Getting Resume Data
      if (!$user) return  $res->json(['success' => false, 'unauthorised' => true]);

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

      $update = $this->resumeObj->update($data, ['resume_id']);

      if ($update) $res->json(['success' => true]);
      exit;
    }
    if (!$basis) {
      $resume = $this->DataAccess->findOne("SELECT * FROM tblresume_metadata WHERE resume_id = ?", [$resume_id]);
    } else {
      $resume = $this->DataAccess->findOne("SELECT template_id FROM tbltemplates WHERE template_id = ?", [$resume_id]);

      if ($resume) {
        $resume["title"] = "Untitled";
        $resume["resume_id"] = "XR-12345678-Lee";
        $resume["demo"] = true;
      }
    }

    $templates = (new Template())->findAll(['status' => 1], ["template_id", "thumbnail"]);
    $templates = $templates['data'] ?? [];

    if (!$resume) return $res->render("resume/resume-not-found", ['user' => $user]);
    $res->render("resume/resume", ['templates' => $templates, 'resume' => $resume, 'user' => $user]);
  }


  public function setupResume(Request $req, Response $res)
  {
    $resume = $req->body();

    $template_id = $req->params('template_id');

    $php_file = "Design-" . $template_id . ".php";
    $css_file = "Design-" . $template_id . ".css";

    $folder = Router::root_folder() . "/resumes/";
    $design = $folder . $php_file;

    // send default template
    if (!file_exists($design))
      $design = $folder . 'default.php';

    require($design);
  }

  public function  getResumeData(Request $req, Response $res)
  {
    $key = $req->params("resume_id");

    $attr = ["cover_photo", "personal", "extras", "education", "experience", "social", "language", "skill", "hobby"];
    $resume = $this->resumeObj->findOne(['resume_id' => $key], $attr);

    if ($resume) {
      // Getting Resume Data
      $resume['personal'] = json_decode($resume['personal']);
      $resume['extras'] = json_decode($resume['extras']);
      $resume['education'] = json_decode($resume['education']);
      $resume['experience'] = json_decode($resume['experience']);
      $resume['social'] = json_decode($resume['social']);
      $resume['language'] = json_decode($resume['language']);
      $resume['skill'] = json_decode($resume['skill']);
      $resume['hobby'] = json_decode($resume['hobby']);

      $res->json($resume);
    }
  }
}
