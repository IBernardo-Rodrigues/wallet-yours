<?php
namespace app\routes;

use App\utils\Responses;

class Router {
  const CONTROLLER_NAMESPACE = 'App\\controllers\\';

  public static function load($controller, $method, $search) {

    $controllerNamespace = self::CONTROLLER_NAMESPACE.$controller;
    if (!class_exists($controllerNamespace)) {
      throw new \Exception(Responses::newResponseMessage(400, "Busca sem resultados!"));
    }

    $controllerInstance = new $controllerNamespace;

    if (!method_exists($controllerInstance, $method)) {
      throw new \Exception(Responses::newResponseMessage(400, "Busca sem resultados!"));
    }

    return $controllerInstance->$method($search);
  }

  public static function routes($method, $controller, $search) {
    $routes = [
      'get' => [
        'user' => 'UserController',
        'transaction' => 'TransactionController'
      ],
      'post' => [
        'user' => 'UserController',
        'transaction' => 'TransactionController'
      ],
      'put' => [
        'user' => 'UserController',
        'transaction' => 'TransactionController'
      ],
      'delete' => [
        'user' => 'UserController',
        'transaction' => 'TransactionController'
      ]
    ];

    if (!array_key_exists($method, $routes)) {
      throw new \Exception(Responses::newResponseMessage(400, "Busca sem resultados!"));
    }

    if (!array_key_exists($controller, $routes[$method])) {
      throw new \Exception(Responses::newResponseMessage(400, "Busca sem resultados!"));
    }

    $controller = $routes[$method][$controller];

    return self::load($controller, $method, $search);
  }
}
