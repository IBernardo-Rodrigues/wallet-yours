<?php
namespace App\controllers;

require_once('vendor/autoload.php');

use App\models\User;
use App\utils\Responses;

class UserController {
  public static function get($search = null) {
    // add: user/current-user
    if ($search) {
      if ($search[0] == "current-user") {
        return User::currentUser();
      }

      $id = $search[0];
      array_shift($search);
      if (empty($search)) {
        return User::readOne($id);
      }

      if ($search[0] == "transaction") {
        array_shift($search);

        if (empty($search)) {
          return User::readAllUserTransactions($id);
        }

        if ($search[0] == "week") {
          return User::readThisWeekUserTransaction($id);
        }

        throw new \Exception(Responses::newResponseMessage(400, "Pesquisa sem resultados!"));
      }

      throw new \Exception(Responses::newResponseMessage(400, "Pesquisa sem resultados!"));
    }

    return User::readAll();
  }

  public static function post() {
    if ($_POST) {
      return User::insert($_POST);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }

  public static function put($id = null) {
    if ($id) {
      $data = json_decode(file_get_contents("php://input"));

      return User::update($id, $data);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }

  public static function delete($id = null) {
    if ($id) {
      return User::delete($id);
    }

    throw new \Exception(Responses::newResponseMessage(400, "Dados insuficientes"));
  }
}
