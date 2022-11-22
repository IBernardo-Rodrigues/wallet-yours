<?php
namespace App\database;
//require_once('../../vendor/autoload.php');

use PDO;

class Db {
  public function getConnection() {
    $pdo = new PDO(DSN, USER, PASSWORD, OPTIONS); 
    return $pdo;
  }
}