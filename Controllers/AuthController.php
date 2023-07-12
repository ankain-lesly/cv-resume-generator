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

  // Fetch User
  // Basis Authentication
  public function get_user_info(Request $req, Response $res) {
    $user = $this->session->get('user');
    $token = $req->body('_sess_token');

    if($user && $user['_sess_token'] === $token) {
      return $res->json($this->UserObj->findOne(['userID' => $user['userID']]));
    }

    $res->status(401)->json(['message' => 'Unauthorized...']);
  }

  // Register New User
  public function register(Request $req, Response $res)
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
        $this->session->setToast("toast", 'Welcome back, '.$data['username'].'. 😎');
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


  // Login
  public function logout($req, $res)
  {
    // Clearing user data
    $this->session->clear('user');
    // Setting Toast
    $this->session->setToast("toast", 'You have been logged out: ✔');
    $res->json([
      "_logout" => true,
    ]);
  }

  private function setUser(array $data) {
    $user_data = array(
      'name' => $data['username'],
      'userID' => $data['userID'],
      'email' => $data['email'],
      'role' => $data['role'] ?? "USER",
      'profile' => $data['profile_image'] ?? '',
      '_sess_token' => $data['_sess_token'],
    );
    $this->session->set('user', $user_data);
  }
}
