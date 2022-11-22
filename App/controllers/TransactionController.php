<?php
namespace App\controllers;

require_once('vendor/autoload.php');

use App\models\Transaction;
use App\database\DbSearchs;
use App\utils\Responses;
use Firebase\JWT\KEY;

class TransactionController {
  public static function get($id = null) {
    if ($id) {
      return Transaction::readOne($id);
    }

    return Transaction::readAll();
  }

  public static function post() {
    if ($_POST) {
      return Transaction::insert($_POST);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }

  public static function put($id = null) {
    if ($id) {
      $data = json_decode(file_get_contents("php://input"));

      return Transaction::update($id, $data);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }

  public static function delete($id = null) {
    if ($id) {
      return Transaction::delete($id);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }
}
