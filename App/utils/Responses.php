<?php
namespace App\utils;

class Responses {
  public static function newResponseMessage($statusCode, $message) {
    return json_encode([
      "status" => "$statusCode",
      "message" => "$message"
    ], JSON_UNESCAPED_UNICODE);
  }

  public static function newResponseData($statusCode, $data) {
    return json_encode([
      "status" => "$statusCode",
      "data" => $data
    ], JSON_UNESCAPED_UNICODE);
  }

  public static function newInputMessage($errorName, $errorMessage) {
    return json_encode([
      "errorName" => $errorName,
      "errorMessage" => $errorMessage
    ], JSON_UNESCAPED_UNICODE);
  }
}
