<?php

namespace app\models;

use Devlee\mvccore\DB\DBModel;

class Resume extends DBModel
{
  public int $resume_id = 0;
  public string $personal = '';
  public string $education = '';
  public string $experience = '';
  public string $emexperience = '';
  public string $skill = '';
  public string $extras = '';

  public static function tableName(): string
  {
    return 'tblusers';
  }

  public function attributes(): array
  {
    // attr: user_id
    return ["personal", "education", "experience", "emexperience", "skill", "extras"];
  }

  // public function rules()
  // {
  //   return [];
  // }

  public function save()
  {
    return $this->insert();
  }
}
