<?php

namespace App\Models;

use Devlee\mvccore\DB\DBModel;

class Notification extends DBModel
{
  public string $notification_id = "";
  public string $title = "";
  public string $body = "";
  public string $target = "";

  public static function tableName(): string
  {
    return 'tblnotification';
  }

  // public function attributes(): array
  // {
  //   // attr: user_id
  //   return ["personal", "education", "experience", "emexperience", "skill", "extras"];
  // }

  // public function rules()
  // {
  //   return [];
  // }

  public function create()
  {
    return $this->insert();
  }
}