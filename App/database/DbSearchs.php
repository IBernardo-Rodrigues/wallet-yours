<?php
namespace App\database;
//require_once('../../vendor/autoload.php');

class DbSearchs {
  public static function emailExist($email) {
    $database = new Db;
    $pdo = $database->getConnection();
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $response = $stmt->fetch(\PDO::FETCH_ASSOC);
    
    if ($response) {
      return $response;
    }

    return false;
  }

  public static function tokenExist($token) {
    $database = new Db;
    $pdo = $database->getConnection();

    $sql = "SELECT * FROM users WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':token', $token);
    $stmt->execute();
    $response = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($response) {
      return $response;
    }

    return false;
  }
}
