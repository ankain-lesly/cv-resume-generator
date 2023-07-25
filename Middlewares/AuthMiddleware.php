<?php

namespace app\Middlewares;

use Devlee\mvccore\Middlewares\BaseMiddleware;
use Devlee\mvccore\Session;
use App\models\User;

class AuthMiddleware extends BaseMiddleware
{
  private User $user;
  private static $ware;

  private Session $session;
  // inherit properties from the parent ware

  public function __construct()
  {
    // $this->UserObj = new User();
    $this->session = new Session();
    $this->user = new User();
    self::$ware = $this;
  }

  public function caseName(): string
  {
    return "AuthMiddleware";
  }
  public static function isUser()
  {
    if (!self::$ware->session->get('user')) {
      self::$ware->session->setToast("toast", "User not authorized or invalid token!");
      header("Location: /");
    }
  }
  public function isAdmin()
  {
  }
}
