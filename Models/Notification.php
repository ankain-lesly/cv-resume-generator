<?php 
namespace App\Models;


include_once __DIR__."/../Models/DataAccess.php";
include_once __DIR__."/../Config/CustomErrorValidator.php";

use App\Config\CustomErrorValidator;
use App\Config\CustomLibrary;
use App\Models\DataAccess;

class Notification {
  private $DataAccess;

  public function __construct() {
    $this->DataAccess = new DataAccess();
  }


  // GET ALL Notif
  public function index() {
    $sql = "SELECT * FROM tblnotifications";
    $result = $this->DataAccess->fetchAll($sql);
    return $result;
  }
  // GET User Notif
  public function getUserNotiv() {
    $user = $_SESSION['user']['token'];
    
    $sql = "SELECT * FROM tblnotifications WHERE userID = :userID";
    $result = $this->DataAccess->fetchCustomDataArray($sql, [$user]);
    return $result;
  }

  // GET a book
  public function get($key = null) {
    $sql = "SELECT * FROM tblnotifications WHERE notivID = :keyword";

    return $this->DataAccess->fetchCustomData($sql,[$key]);
  }

  // CREATE a book
  public function create($title, $body, $user) {
    $data = $_POST;
    $newData = CustomErrorValidator::validateData($data, 'sanitize')['data'];
    
    $token = CustomLibrary::generateKey();

    $sql = "INSERT INTO tblnotifications (title, body, userID, authorID, notivID)
            VALUES(:title, :body, :userID, :authorID, :notivID)";

    $result = $this->DataAccess->insertCustomData($sql,
              [
                $title, 
                $body, 
                $user, 
                $_SESSION['user']['token'],
                $token,
              ]);

    return $result;
  }

  public function checkExist(string $param, $data) {
    $sql = "SELECT * FROM tblnotifications WHERE $param = :title";
   
    $result = $this->DataAccess->fetchCustomData($sql, [$data]);
    
    if($result) { 
      return array(
        'error' => [
          'message' => 'Data alreay exists', 
          'data' => $data
        ]);

    }else return false;
  }


  public function delete($key) {
    $sql = "DELETE FROM tblnotifications WHERE id = :key";

    $result = $this->DataAccess->queryCustomData($sql, [$key]);
    return $result;
  }


  public function update() {
    $data = $_POST;
    $newData = CustomErrorValidator::validateData($data, 'sanitize')['data'];

    $exists = $this->checkExist('title', $newData['brand_title']); 
    if($exists) return $exists;

    $sql = "UPDATE tblnotifications SET title = :title WHERE id = :id";

    $result = $this->DataAccess->queryCustomData($sql, [$data['brand_title'],$data['brand_id']]);
    return $result;
  }
}