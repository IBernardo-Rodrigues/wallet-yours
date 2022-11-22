<?php
require_once('../../../vendor/autoload.php');


use App\utils\ValidateInput;
use App\database\DbSearchs;
use App\utils\Responses;
use App\processData\requests\UserRequests;
use App\processData\UserAuthentication\UserAuthentication;

try {
  
  $username = ValidateInput::validateName($_POST['username']);
  $email = ValidateInput::validateEmail($_POST['email']);
  $password = ValidateInput::validatePassword($_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $token = UserAuthentication::createToken($email);
  $emailExist = DbSearchs::emailExist($email);
  
  if ($emailExist) {
    throw new \Exception(Responses::newInputMessage("emailerror", "Este email já existe!"));
  } 
  
  $data = [
    "username" => $username,
    "email" => $email,
    "password" => $password,
    "token" => $token
  ];

  $response = UserRequests::postRequest($data);
  $response = json_decode($response);

  if ($response->status == 200) {
    setcookie(
      "userToken",
      $token,
      time() + 60 * 60 * 24 * 60,
      "/"
    );

    header("location: http://walletyours.infinityfreeapp.com/");
    die;
  }

  
  throw new \Exception(Responses::newInputMessage("error", "Algo deu errado!"));


} catch (\Exception $error) {
  $errorData = $error->getMessage();

  setCookie(
    "signupError",
    $errorData,
    time() + 5,
    '/'
  );
  header("location: http://walletyours.infinityfreeapp.com/signup");
}
