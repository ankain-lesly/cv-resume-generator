<?php

namespace App\Models;

include_once __DIR__ . "/../Models/DataAccess.php";
include_once __DIR__ . "/../Config/CustomLibrary.php";

use App\Config\CustomLibrary;
use App\Models\DataAccess;

class User
{
  private $DataAccess;

  public function __construct()
  {
    $this->DataAccess = new DataAccess();
  }

  // Get items/Collection
  public function getUsers()
  {
    $sql = "SELECT * FROM  tblusers AS C 
      WHERE role = 'USER'";

    return $this->DataAccess->fetchAll($sql);
  }
  // Get iSIngle Resource
  public function getUser($key)
  {
    $sql = "SELECT * FROM tblusers
      WHERE userID = :userID";

    return $this->DataAccess->fetchCustomData($sql, [$key]);
  }
  // CREATE USER
  public function create(array $data)
  {
    $sql = "INSERT INTO tblusers 
            (userID,username, email, password)
            VALUES (:userID,:username, :email, :password)";

    $passEncypt = password_hash($data['password'], PASSWORD_DEFAULT);
    $token = CustomLibrary::generateKey();

    $user = [
      $token,
      $data['username'],
      $data['email'],
      $passEncypt,
    ];

    $this->DataAccess->insertCustomData($sql, $user);


    $user = array(
      'username' => $data['username'],
      'email' => $data['email'],
      'token' => $token,
      'role' => 'USER',
    );

    $name = $data['username'];
    $to = $data['email'];
    $from = "Testard.com <letechcg@gmail.com>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . " \r\n";
    $headers .= "From: " . $from . "\r\n";

    $subject = "Testard. Account Activated";

    // mail($to, $subject, $message, $headers);

    return $this->setUser($user);
  }


  // LOG IN USER
  public function login(array $data)
  {
    $sql = "SELECT userID, username, action, email, role, password FROM tblusers WHERE email = :email";

    $user =  $this->DataAccess->fetchCustomData($sql, [$data['email']]);

    if (!$user) return [
      'errors' => ['Invalid Login credentials!'],
      'data' => $_POST,
    ];

    if (!password_verify($data['password'], $user['password']))
      return ['errors' => ['Incorect login details!'], 'data' => $data];

    if ($user['action'] === 'TRASHED') {
      return CustomLibrary::setToast('Hellow, ' . $user['username'] . '. Your account has been susspended. 🚩', '/dashboard');
    }
    $user = array(
      'username' => $user['username'],
      'email' => $user['email'],
      'token' => $user['userID'],
      'role' => $user['role'],
    );

    return  $this->setUser($user);
  }

  // CREATE USER
  public function update(array $data)
  {
    $sql = "UPDATE tblusers 
            SET username = :username, phone = :phone, address = :address
            WHERE userID = :userID";

    $res = $this->DataAccess->queryCustomData($sql, [
      $data['username'],
      $data['phone'],
      $data['address'],
      $_SESSION['user']['token'],
    ]);
    return $res;
  }
  public function setUser($user)
  {
    session_start();
    $_SESSION['user'] = $user;

    return CustomLibrary::setToast('Welcome back, ' . $user['username'] . '. 😎', '/dashboard');
  }
}


  /*
    // CREATE USER
    public function create(array $data): array {
      $sql = "INSERT INTO tblusers (username, email, phone, password, userToken) VALUES (:username, :email, :phone, :password, :userToken)";

      $passEncypt = password_hash($data['password'], PASSWORD_DEFAULT);
      
      $token = Library::generateKey();

      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(":username", $data['username'], PDO::PARAM_STR);
      $stmt->bindValue(":email", $data['email'], PDO::PARAM_STR);
      $stmt->bindValue(":phone", $data['phone'], PDO::PARAM_STR);
      $stmt->bindValue(":password", $passEncypt, PDO::PARAM_STR);
      $stmt->bindValue(":userToken", $token, PDO::PARAM_STR);

      $stmt->execute();
      $id = $this->conn->lastInsertId();
      $this->conn = null;
      return array(
        'username'=>$data['username'],
        'email'=>$data['email'],
        'token'=>$token.'@@'.$id,
      );
    }
  */