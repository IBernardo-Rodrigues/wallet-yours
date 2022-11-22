<?php
namespace App\utils;

class Uri {
  public static function getPath() {
    if (isset($_GET['url'])) {
      $path = $_GET['url'];
      $explodedPath = explode("/", $path);

      $filteredPath = array_filter($explodedPath, function($value) {
        return !empty($value);
      });

      return $filteredPath;
    }

    return false;
  }
}
