<?php

namespace App\Controllers;


use App\Models\User;
use App\Config\CustomErrorValidator;
use Devlee\XRouter\Router;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;

use Devlee\mvccore\Session;
use Devlee\mvccore\Library;

class AuthController
{
  private User $UserObj;
  // private $DataAccess;

  public function __construct()
  {
    $this->UserObj = new User();
    Router::setLayout('layouts/auth');
    // $this->DataAccess = new DataAccess();
  }

  // Fetch User
  public function user(Request $req, Response $res) {
    $user = $this->UserObj->findOne(['id'=>1]);

    $res->json($user);
  }

  // Register New User
  public function register(Request $req, Response $res)
  {
    if($req->isPost()) {
      $data = $req->body();

      $this->UserObj->loadData($data);

      if ($this->UserObj->validate() && $this->UserObj->save()) {

        // Setting User
        $data['_sess_token'] = Library::generateToken(16);
        $this->setUser($data);

        // Setting Toast
        Session::setToast("toast", 'Hi, '.$data['username'].'. 😎');
        return $res->json([
          "_sess_token" => $data["_sess_token"],
          "_success" => true,
        ]);
      }

      // Form Errors
      $errors =  $this->UserObj->getErrors();
      return $res->status(422)->json($errors);
    }

    // Register Page
    $res->render('signup');
  }

  // Login
  public function login(Request $req, Response $res)
  {
    if($req->isPost()) {
      $data = $req->body();

      $this->UserObj->loadData($data);
      $where = ['email' => $data['username'], 'username' => $data['username']];

      $user_data = $this->UserObj->findOne($where, [], 'OR');
      if ($this->UserObj->validate($data) && $user_data) {
        // Checking User Password
        
        if(!$this->UserObj->verifyHashed($data['password'], $user_data['password'])) {
          $error_response = [
            'message' => 'Error: User or password is incorrect'
          ];

          return $res->status(422)->json($error_response);
        }

        $user_data['_sess_token'] = Library::generateToken(16);
        $this->setUser($user_data);

        // Setting Toast
        Session::setToast("toast", 'Welcome back, '.$data['username'].'. 😎');
        return $res->json([
          "_sess_token" => $user_data["_sess_token"],
          "_login" => true,
        ]);
      }

      // Form Errors
      $errors =  $this->UserObj->getErrors();
      $errors['message'] = 'Invalid login credentials';

      return $res->status(422)->json($errors);
    }

    // Register Page
    $res->render('login');
  }

  private function setUser(array $data) {
    $user_data = array(
      'username' => $data['username'],
      'email' => $data['email'],
      'role' => $data['role'] ?? "USER",
      'profile' => $data['profile_image'] ?? '',
      'token' => $data['_sess_token'],
    );
    Session::set('user', $user_data);
  }
}
