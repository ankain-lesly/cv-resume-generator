<?php

namespace App\Models;

use Devlee\mvccore\DB\DBModel;

class Resume extends DBModel
{
  public string $resume_id = "";

  public string $cover_photo  = "";

  public string $personal = "";
  public string $extras = "";
  public string $education = "";
  public string $experience = "";
  public string $social = "";
  public string $languages = "";
  public string $skills = "";
  public string $hobbies = "";

  public static function tableName(): string
  {
    return 'tblresumes';
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