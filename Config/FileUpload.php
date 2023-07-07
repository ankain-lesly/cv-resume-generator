<?php
namespace App\Config;

include_once __DIR__."/../Config/CustomLibrary.php";

use App\Config\CustomLibrary;

class FileUpload {
  private static $AcceptedFiles = ['jpg', 'jpeg', 'png', 'pdf'];

  public static function uploadPhotos(array $files, string $dir = null) {
    $token = CustomLibrary::generateKey();

    if(!$dir)
      $dir = '/uploads/docs/';

    $f_name = $files['name'];
    $f_tmp = $files['tmp_name'];

    $nameExtension = explode('.', $f_name);
    $extension = strtolower(end($nameExtension));

    if(in_array($extension, self::$AcceptedFiles)) {
      $user = explode(' ',$_SESSION['user']['username'])[0];
      $name = strtoupper($user).'-'.$token.'.'.$extension;

      if(move_uploaded_file($f_tmp, __DIR__.'/../..'.$dir.$name))
        return $dir.$name;
    }
  }
}