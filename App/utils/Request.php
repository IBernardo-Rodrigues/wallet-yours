<?php
namespace App\utils;

class Request {
  public static function getRequestMethod() {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }
}
