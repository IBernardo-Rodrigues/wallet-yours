<?php
namespace App\models;

require_once('vendor/autoload.php');

use App\database\Db;
use App\database\DbSearchs;
use App\utils\ApiValidations;
use App\utils\Responses;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User {
  public static function readOne($id) {
    $database = new Db;
    $pdo = $database->getConnection();

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":id", $id);

    $stmt->execute();
    $response = $stmt->fetch(\PDO::FETCH_ASSOC);

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseData(200, $response);
  }

  public static function readAll() {
    $database = new Db;
    $pdo = $database->getConnection();

    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseData(200, $response);
  }

  public static function insert($data) {
    $database = new Db;
    $pdo = $database->getConnection();

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $token = $data['token'];

    $sql = "INSERT INTO users VALUES(NULL, :username, :email, :password, :token)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":password", $password);
    $stmt->bindValue(":token", $token);

    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Usuário adicionado com sucesso!");
  }

  public static function update($id, $data) {
    $database = new Db;
    $pdo = $database->getConnection();
    $id = implode($id);

    $username = $data->username;
    $email = $data->email;
    $password = $data->password;
    $token = $data->token;

    $sql = "UPDATE users SET username = :username, email = :email, password = :password, token = :token WHERE id = '$id'";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":password", $password);
    $stmt->bindValue(":token", $token);

    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Usuário modificado com sucesso!");
  }

  public static function delete($id) {
    $database = new Db;
    $pdo = $database->getConnection();
    $id = implode($id);

    $sql = "DELETE FROM users WHERE id = '$id'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Usuário deletado com sucesso!");
  }

  public static function readAllUserTransactions($id) {
    $database = new Db;
    $pdo = $database->getConnection();

    $sql = "SELECT * FROM transactions WHERE id_user = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseData(200, $response);
  }

  public static function readThisWeekUserTransaction($id) {
    $database = new Db;
    $pdo = $database->getConnection();

    $firstDayWeek = date('Y-m-d', strtotime("this week"));
    $lastDayWeek = date('Y-m-d', strtotime("Sunday this week"));

    $sql = "SELECT * FROM transactions WHERE id_user = :id AND date BETWEEN :firstDayWeek AND :lastDayWeek";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":firstDayWeek", $firstDayWeek);
    $stmt->bindValue(":lastDayWeek", $lastDayWeek);
    $stmt->execute();
    $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseData(200, $response);
  }

  public static function currentUser() {
    $allHeader = getallheaders();

    if (!array_key_exists('Authorization', $allHeader)) {
      throw new \Exception(Responses::newResponseMessage(400, "Token inexistente"));
    }

    $userToken = $allHeader['Authorization'];

    if ($userToken) {

      $jwtDecoded = JWT::decode($userToken, new KEY("somerandomkey", "HS256"));

      if ($jwtDecoded == "Expired token") {
        throw new \Exception(Responses::newResponseMessage(400, "Token experiado"));
      }

      $userEmail = $jwtDecoded->email;
      $user = DbSearchs::emailExist($userEmail);

      if (!$user) {
        throw new \Exception(Responses::newResponseMessage(400, "Usuário não encontrado"));
      }

      return Responses::newResponseData(200, $user);
  }

  throw new \Exception(Responses::newResponseMessage(400, "Faltam dados!"));

  }
}
