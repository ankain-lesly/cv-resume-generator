<?php
namespace App\Config;

use App\Models\DataAccess;
use App\Config\Library;

class CustomErrorValidator {

  // CUSTOME MESSAGE WITH STATUS CODE
	public static function errorResourceMsg(
		$msg = 'No related content found!', 
		array $errors = [], int $status_code = 422
  ) {
    http_response_code($status_code);
		
    if($msg === 'not-found') {
      $response = array(
        'status' => 'Resource Not Found!',
        'message'=>'This resource could not be loaded. Please try again...',
      );
    }else {
      $response = array(
        'message' => $msg,
      );
    }

    if($errors) {
      $response['errors'] = $errors;
    }

    

    $response['status_code'] = $status_code;
    print_r($response);
  }

  //Validate User Data
  public static function validateData(array $data, string $mode = ''): array {
    
    $result = array();

    $errors = array();
    $newData = array();

    foreach ($data as $name => $value) {
      $value = self::sanitiseValue($value);

      $newData[$name] = $value;

      if($mode === 'sanitize') continue;
      
      switch ($name) {
        case 'username':
            if (empty($value)) {
              $errors[] = 'Username is required!';
            }            
            else if (strlen($value) < 3) {
              $errors[] = 'Username should be at least 3 characters!';
            }
            // else if (!preg_match("/^[a-z\d][a-z_\d]{0,20}$/i", $value)) {
            //   $errors[] = 'Username is not valid!';
            // }
          break;

        case 'email':
            $newData[$name] = strtolower($value);
            if (empty($value)) {
              $errors[] = 'Email is required!';
            }

            else if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
              $errors[] = 'Email is not valid!';
            }
            else if(self::isUserExists($newData['email'])) {
              $errors[] = 'Ooops Email Address already exists! try Login';
            }
          break;

          case 'phone':
            if (empty($value)) {
              $errors[] = 'Phone Number is required!';
            }

            else if (!preg_match("/^[+]?\d{9,13}$/", $value)) {
              $errors[] = 'Phone Number is not valid!';
            }
          break;

        case 'password':
            if (empty($value)) {
              $errors[] = 'Password is required!';
            }

            else if (strlen($value) < 5) {
              $errors[] = 'Password should be at least 5 characters!';
            }
          break;

        case 'confirm_password':
            if (empty($value)) {
              $errors[] = 'Confirm password is required!';
            }

            else if ($value !== $data['password']) {
              $errors[] = 'Passwords must be the same!';
            }
          break;
      }
    }
    
    $result['errors'] = $errors;
    $result['data'] = $newData;


    return $result;
  }

  //Sanitise Values
  private static function sanitiseValue(string $string): string{
    $val = trim($string);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    return $val;
  }
  
  private static function isUserExists(string $email) {
    $DataAccess = new DataAccess();

    $sql = "SELECT email FROM tblusers WHERE email = :email";

    $user = $DataAccess->fetchCustomData($sql, [$email]);
    return $user;
  }
}