<?php

namespace app\Middlewares;

use Devlee\mvccore\Middlewares\BaseMiddleware;
use Devlee\mvccore\Session;
use App\models\User;

class AuthMiddleware extends BaseMiddleware
{
  private User $user;

  public function __construct()
  {
    parent::__construct();
    // $this->UserObj = new User();
    $this->user = new User();
  }

  public function caseName(): string
  {
    return "AuthMiddleware";
  }
  public function isUser()
  {
    if (!$this->session->get('user')) {
      $this->session->setToast("toast", "User not authorized or invalid token!");
      header("Location: /");
    }
  }
  public function isAdmin()
  {
  }
}