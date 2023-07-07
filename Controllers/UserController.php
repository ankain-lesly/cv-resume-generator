<?php

namespace App\Controllers;

include_once __DIR__ . "/../Models/User.php";
include_once __DIR__ . "/../Config/CustomErrorValidator.php";

use App\Models\User;
use App\Config\CustomErrorValidator;
// use App\Models\DataAccess;

class UserController
{
  private $user;
  // private $DataAccess;

  public function __construct()
  {
    $this->user = new User();
    // $this->DataAccess = new DataAccess();
  }

  // Get all Users
  public function index()
  {
    return $this->user->getUsers();
  }
  // Get A User
  public function user($user)
  {
    return $this->user->getUser($user);
  }
  // SIGNUP
  public function signup()
  {
    $data = $_POST;
    $validate = CustomErrorValidator::validateData($data);

    if (!empty($validate['errors'])) return $validate;

    return $this->user->create($validate['data']);
  }

  // LOGIN 
  public function login()
  {
    $data = $_POST;
    $validate = CustomErrorValidator::validateData($data, 'sanitize');

    if (!empty($validate['errors']))
      return $validate;

    $res = $this->user->login($validate['data']);

    return $res;
  }
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

    return $this->user->update($validate['data']);
  }
}
