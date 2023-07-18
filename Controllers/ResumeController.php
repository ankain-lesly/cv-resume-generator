<?php

namespace App\controllers;

use App\models\Post;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;
use Devlee\XRouter\Router;

// PDF for Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

class ResumeController
{
  public function __construct()
  {
    Router::$router->setLayout('');
  }

  public function create(Request $req, Response $res)
  {
    $resume_id = $req->params('resume_id');

    $resume = array('resume' => [
      'resume_id' => $resume_id,
    ]);

    $res->render("resume/resume", $resume);
  }


  public function setupResume(Request $req, Response $res)
  {
    $resume = $req->body();

    // Getting Resume Data
    $personal = $resume['personal'] ?? [];
    $education = $resume['education'] ?? [];
    $experience = $resume['experience'] ?? [];
    $languages = $resume['language'] ?? [];
    $skills = $resume['skill'] ?? [];
    $hobbies = $resume['hobby'] ?? [];


    $template_id = $req->params('template_id');
    $folder = Router::root_folder()."/resumes/";

    $isDownload = $req->body('dd');

    // Process to get resume info and template Design;
    $design = $folder.$template_id.'.php';

    if(!file_exists($design)) {
      // send default template
      $design = $folder.'default.php';
    }

    // $isDownload = true;
    if(!$isDownload) {
      require ($design);
      exit;
    }

    ob_start();
    require ($design);
    $template = ob_get_clean();

    $this->generatePDF($template);
  }


  public function generatePDF(string $template) {
    /**
     * Set the Dompdf options
     */

    $options = new Options;
    $options->setChroot(Router::root_folder());
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);

    /**
     * Set the paper size and orientation
     */
    $dompdf->setPaper("A4", "portrait");

    /**
     * Load the HTML and replace placeholders with values from the form
     */
    
    // $dompdf->loadHtmlFile($template);
    $dompdf->loadHtml($template);

    /**
     * Create the PDF and set attributes
     */
    $dompdf->render();

    // set title or user defualt web title
    $dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

    /**
     * Send the PDF to the browser
     */
    $dompdf->stream("design_123.pdf", ["Attachment" => 0]);

    /**
     * Save the PDF file locally
     */
    $output = $dompdf->output();
    file_put_contents("My_resume.pdf", $output);

  }


  public function getData() {
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
