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
    public string $confirm_password = '';

    public static function tableName(): string
    {
        return 'tblusers';
    }

    public function attributes(): array
    {
        // attr: user_id
        return ["userID", "username","email","phone","password"];
    }

    public function rules()
    {
        return [
            'userID' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        // return parent::insert();
        $this->password = self::hashString($this->password);
        return $this->insert();
    }

    public static function hashString(string $string) {
        return password_hash($string, PASSWORD_DEFAULT);
    }
    public static function verifyHashed(string $string, string $hashedString) {
        return password_verify($string, $hashedString);
    }
}
