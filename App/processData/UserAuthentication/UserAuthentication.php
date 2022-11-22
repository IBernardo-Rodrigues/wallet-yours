<?php
namespace App\processData\UserAuthentication;

use App\database\DbSearchs;
use Firebase\JWT\JWT;

class UserAuthentication {
  public static function isLogged() {
    $token = $_COOKIE['userToken'];

    if (!$token) {
      header('location: http://walletyours.infinityfreeapp.com/signin');
      die;
    }

    $tokenExist = DbSearchs::tokenExist($token);

    if (!$tokenExist) {
      header('location: http://localhost/wallet-yours/signin');
      die;
    }
  }

  public static function createToken($email) {
    $payload = [
      "exp" => time() + 60 * 60 * 24 * 60,
      "iat" => time(),
      "email" => "$email"
    ];

    $encode = JWT::encode($payload, "somerandomkey", 'HS256');

    return $encode;
  }
}
