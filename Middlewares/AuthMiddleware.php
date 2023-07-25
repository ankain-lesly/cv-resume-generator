<?php

namespace App\Middlewares;


class AuthMiddleware
{
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
  }

  public function isUser()
  {
  }
  public function isAdmin()
  {
  }
}
