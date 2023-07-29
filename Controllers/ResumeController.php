<?php

namespace App\controllers;

use App\models\Resume;
use Devlee\mvccore\Library;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

use Devlee\mvccore\Session;
// middlewares
use App\Middlewares\AuthMiddleware;
use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\FileUpload;
// PDF for Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

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
    $AuthMiddleware = new AuthMiddleware();
    $AuthMiddleware->isUser("options");

    if ($option !== 'nolayout') Router::$router->setLayout('');
  }

  public function createMeta(Request $req, Response $res)
  {
    $data = $req->body();
    $meta_id = Library::generateToken(16);
    $resume_id = Library::generateToken(16);

    $user = $this->session->get('user') ?? exit('Not authorized...');
    if ($user['_sess_token'] !== $data['token']) exit('Not authorized...');

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
    $user = $this->session->get('user') ?? exit('Not authorized...');
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

        if ($data['cover_photo']) {
          $update = $this->resumeObj->update($data, ['resume_id']);
          if ($update) $res->json(['success' => true, 'cover' => $data['cover_photo']]);
          exit;
        }
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

      $update = $this->resumeObj->update($data, ['resume_id']);

      if ($update) $res->json(['success' => true]);
      exit;
    }
    $user = $this->session->get('user');
    $resume_id = $req->params('resume_id');

    $resume = $this->DataAccess->findOne("SELECT * FROM tblresume_metadata WHERE resume_id = ?", [$resume_id]);

    if (!$resume) return $res->render("resume/resume-not-found", ['user' => $user]);
    $res->render("resume/resume", $resume);
  }


  public function setupResume(Request $req, Response $res)
  {
    $resume = $req->body();

    // Getting Resume Data
    $cover = $resume['cover_photo'] ?? false;

    $personal = $resume['personal'] ?? [];
    $extras = $resume['extras'] ?? [];
    $education = $resume['education'] ?? [];
    $experience = $resume['experience'] ?? [];
    $social = $resume['social'] ?? [];
    $languages = $resume['language'] ?? [];
    $skills = $resume['skill'] ?? [];
    $hobbies = $resume['hobby'] ?? [];


    $template_id = $req->params('template_id');
    $folder = Router::root_folder() . "/resumes/";

    $isDownload = $req->query('dd');

    // Process to get resume info and template Design;
    $design = $folder . $template_id . '.php';

    if (!file_exists($design)) {
      // send default template
      $design = $folder . 'default.php';
    }

    // $isDownload = true;
    if (!$isDownload) {
      require($design);
      exit;
    }

    ob_start();
    require($design);
    $template = ob_get_clean();

    exit("Generating RESUME PDF");
    // $this->generatePDF($template);
  }


  // public function generatePDF(string $template)
  // {
  //   /**
  //    * Set the Dompdf options
  //    */

  //   $options = new Options;
  //   $options->setChroot(Router::root_folder());
  //   $options->setIsRemoteEnabled(true);

  //   $dompdf = new Dompdf($options);

  //   /**
  //    * Set the paper size and orientation
  //    */
  //   $dompdf->setPaper("A4", "portrait");

  //   /**
  //    * Load the HTML and replace placeholders with values from the form
  //    */

  //   // $dompdf->loadHtmlFile($template);
  //   $dompdf->loadHtml($template);

  //   /**
  //    * Create the PDF and set attributes
  //    */
  //   $dompdf->render();

  //   // set title or user defualt web title
  //   $dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

  //   /**
  //    * Send the PDF to the browser
  //    */
  //   $dompdf->stream("design_123.pdf", ["Attachment" => 0]);

  //   /**
  //    * Save the PDF file locally
  //    */
  //   $output = $dompdf->output();
  //   file_put_contents("My_resume.pdf", $output);
  // }

  public function getResumeData()
  {
    $data = '{"personal": {
                "firstname": "<h1>Ankain </h1>",
                "lastname": "Lesly",
                "address": "Bamenda Cameroon, <h1>Bambili<h1>",
                "date_of_birth": "2202-05-05",
                "headline": "Front End UI Designer",
                "email": "leex@gmail.com",
                "phone": "+23670740"
              },
              "education": {
                "UU-1689627865042": {
                  "education": "O Levels",
                  "school": "GBHS Fundong",
                  "description": "My adventure into olevel was greate..."
                },
                "UU-1689628365151": {
                  "education": "A Levels",
                  "school": "GBHS DSCHANG",
                  "start_date": "2023-07-26",
                  "end_date": "2023-07-19",
                  "city": "Dchang",
                  "present": "",
                  "description": "I worked so hard to achieve greate result and actually, This shool guided me on my programming life till date"
                }
              },
              "experience": {
                "UU-1689627865701": {
                  "position": "Web Developer",
                  "employer": "LeTECH CG",
                  "start_date": "2023-07-20",
                  "end_date": "2023-07-26",
                  "city": "Bamenda",
                  "present": "",
                  "description": "I was a student worker by  the it strived me through my career as a ui expert"
                },
                "UU-1689628579217": {
                  "position": "Backed Developer",
                  "employer": "CivilSalt",
                  "start_date": "2023-07-18",
                  "end_date": "2023-07-18",
                  "city": "Bamenda Nkwen",
                  "present": "",
                  "description": "I has serios inflow on backend development"
                }
              },
              "skill": {
                "UU-1689627865725": {
                  "skill": "Judo",
                  "proficiency": "60"
                },
                "UU-1689628711646": {
                  "skill": "Gymnast",
                  "proficiency": "100"
                },
                "UU-1689628711446": {
                  "skill": "Sporting",
                  "proficiency": "100"
                }
              },
              "hobby": [
                "Coding",
                "Spanking",
                "Coding",
                "Dancing",
                "Just for fun"
              ]
            }';
    echo ($data);
  }
}