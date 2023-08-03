<?php

namespace App\Middlewares;

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
  public function isUser($options = false)
  {
    if (!$this->session->isUser()) {
      $this->session->setToast("toast", "User not authorized or invalid token!");
      header("Location: /");
    }
  }
  public function isAdmin(string $role = 'ADMIN')
  {
    if (!$this->session->isAdmin()) {
      $this->session->setToast("toast", "User not authorized or invalid token!");
      header("Location: /app/");
    }
  }
  public function isMaster(string $role = 'ADMIN')
  {
    if (!$this->session->isMaster()) {
      $this->session->setToast("toast", "User not authorized or invalid token!");
      header("Location: /app/");
    }
  }
}