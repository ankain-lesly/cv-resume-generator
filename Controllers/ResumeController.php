<?php

namespace App\Controllers;


use App\Models\User;
use App\Config\CustomErrorValidator;
use Devlee\XRouter\Router;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;

use Devlee\mvccore\Session;
use Devlee\mvccore\Library;

class ResumeController
{
  private User $UserObj;
  private Session $session;
  // private $DataAccess;

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

    $this->UserObj = new User();
    $this->session = new Session();
    Router::setLayout('layouts/auth');
    // $this->DataAccess = new DataAccess();
  }


  /*
    -> Access Form Meta Data
      - Title
      - Description
    -> Choose Resume Template
      - Resume ID

    -> Create Page
      - Display Loader
      - JS Create Meta Data
      - JS Create Default Resume Data
      - On success

    -> Redirect back to Create Page
      - Resume ID
      - Fetch Resume Data form DB
      - Load Temlate
      - Load Data 
  



  */

  // Register New User
  public function create(Request $req, Response $res)
  {
    if($req->isPost()) {
      $data = $req->body();
      $data['userID'] = Library::generateToken(12);

      $this->UserObj->loadData($data);

      if ($this->UserObj->validate() && $this->UserObj->save()) {
        // Setting User
        $data['_sess_token'] = Library::generateToken(16);
        $this->setUser($data);

        // Setting Toast
        $this->session->setToast("toast", 'Hi, '.$data['username'].'. 😎');
        
        return $res->json([
          "_sess_token" => $data["_sess_token"],
          "_signup" => true,
        ]);
      }

      // Form Errors
      $errors =  $this->UserObj->getErrors();
      return $res->status(422)->json($errors);
    }

    // Register Page
    $res->render('signup');
  }

}
