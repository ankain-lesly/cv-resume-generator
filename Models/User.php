<?php

namespace app\models;

use Devlee\mvccore\DB\DBModel;

class User extends DBModel
{
    public int $id = 0;
    public string $userID = '';
    public string $username = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ["userID","username","email","phone","password"];
    }

    public function rules()
    {
        return [
          "userID" => [self::RULE_REQUIRED],
          "username" => [self::RULE_REQUIRED],
          "email" => [self::RULE_REQUIRED],
          "phone" => [self::RULE_REQUIRED],
          "password" => [self::RULE_REQUIRED],
        ];
    }

    public function save()
    {
        // return parent::insert();
        return $this->insert();
    }

}
