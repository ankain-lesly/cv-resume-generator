<?php

namespace App\Models;

use Devlee\mvccore\DB\DBModel;

class Template extends DBModel
{
  public string $template_id = "";
  public string $thumbnail = "";
  public string $php_file = "";
  public string $css_file = "";
  public string $title = "";
  public string $setting = "";
  public string $user_id = "";
  public int $status = 0;
  public string $created_on = "";

  public static function tableName(): string
  {
    return 'tbltemplates';
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

  public function save()
  {
    return $this->insert();
  }
}