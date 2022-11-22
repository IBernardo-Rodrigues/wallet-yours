<?php
namespace App\models;

use App\database\Db;
use App\utils\ApiValidations;
use App\utils\Responses;

class Transaction {
  public static function readOne($id) {
    $database = new Db;
    $pdo = $database->getConnection();
    $id = implode($id);

    $sql = "SELECT * FROM transactions WHERE id = :id";
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

    $sql = "SELECT * FROM transactions";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseData(200, $response);
  }

  public static function insert($data) {
    $database = new Db;
    $pdo = $database->getConnection();

    $sql = "INSERT INTO transactions VALUES(NULL, :idUser, :description, :price, :date)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":idUser", $data['idUser']);
    $stmt->bindValue(":description", $data['description']);
    $stmt->bindValue(":price", $data['price']);
    $stmt->bindValue(":date", date('Y-m-d'));
    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Transação adicionada com sucesso!");
  }

  public static function update($id, $data) {
    // return $data->description;
    $database = new Db;
    $pdo = $database->getConnection();
    $id = implode($id);

    $sql = "UPDATE transactions SET description = :description, price = :price WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":description", $data->description);
    $stmt->bindValue(":price", $data->price);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Transação atualizada com sucesso!");
  }

  public static function delete($id) {
    $database = new Db;
    $pdo = $database->getConnection();
    $id = implode($id);

    $sql = "DELETE FROM transactions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    ApiValidations::validateDBResponse($stmt);

    return Responses::newResponseMessage(200, "Transação deletada com sucesso!");
  }

}
