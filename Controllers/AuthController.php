<?php

namespace App\Controllers;


use App\Models\User;
use App\Config\CustomErrorValidator;
use Devlee\XRouter\Router;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;

class AuthController
{
  private $UserObj;
  // private $DataAccess;

  public function __construct()
  {
    $this->UserObj = new User();
    Router::setLayout('layouts/auth');
    // $this->DataAccess = new DataAccess();
  }


  // Login
  public function login(Request $req, Response $res)
  {
    // $data = $req->body();
    // $user = $UserObj->findOne(['email' => $data['email']]);

    // if($user) {
    //   //set Sessions
    //   exit('setting user sessions');
    // }
    $res->render('login');
  }

  // LOGIN 
  //   public function login()
  //   {
  //     $data = $_POST;
  //     $validate = CustomErrorValidator::validateData($data, 'sanitize');

  //     if (!empty($validate['errors']))
  //       return $validate;

  //     $res = $this->user->login($validate['data']);

  //     return $res;


  // if (isset($_POST['login'])) {
  //   $UserObj = (new UserController)->login();

  //   if ($UserObj === false) {
  //     $UserObj['errors'] = ['Invalid Login credentialss'];
  //     $UserObj['data'] = ['email' => $_POST['email']];
  //   }
  //   // // exit();
  // }
  //   }
  // UPDATE PROFILE
  public function updateProfile()
  {
    $data = $_POST;
    $email = $data['email'];
    $data['email'] = 'xyz@gmail.com';

    $validate = CustomErrorValidator::validateData($data);
    $data['email'] = $email;

    if (!empty($validate['errors']))
      return $validate;

    // return $this->UserObj->update($validate['data']);
  }
}
