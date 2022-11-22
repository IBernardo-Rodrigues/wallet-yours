<?php
namespace App\utils;

require_once('vendor/autoload.php');

class ApiValidations {
  public static function validateDBResponse($stmt) {
    if (!$stmt->rowCount()) {
      throw new \Exception(Responses::newResponseMessage(500, "Algo deu errado!"));
    }
  }
}
