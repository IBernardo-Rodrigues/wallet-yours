<?php
require_once('vendor/autoload.php');

use App\routes\Router;
use App\utils\Request;
use App\utils\Uri;
use App\utils\Responses;

$url = Uri::getPath() ? Uri::getPath() : ["home"];

if ($url[0] == 'api') {
  array_shift($url);
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  try {
    if (isset($url[0]) && trim($url[0]) != "") {
      $controller = $url[0];
      array_shift($url);
      echo Router::routes(Request::getRequestMethod(), $controller, $url);
      die;
    }

    throw new \Exception(Responses::newResponseMessage(400, "Está faltando dados!"));
  } catch(\Exception $error) {
    $statusCode = json_decode($error->getMessage())->status;
    http_response_code($statusCode);
    echo $error->getMessage();
  }
  die;
}

$path = "App/public/pages/$url[0].php";

if (file_exists($path)) {
  require_once($path);
} else {
  require_once('App/public/pages/pagenotfound.html');
}
