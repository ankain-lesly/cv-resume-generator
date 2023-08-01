<?php

namespace app\models;

use Devlee\mvccore\DB\DBModel;

class TemplateDesign extends DBModel
{
  public string $template_id = "";

  public string $thumbnail  = "";
  public string $php = "";
  public string $css = "";

  public string $title = "";
  public string $settings = "";

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