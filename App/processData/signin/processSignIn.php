<?php
require_once('../../../vendor/autoload.php');

use App\database\DbSearchs;
use App\utils\ValidateInput;
use App\utils\Responses;
use App\processData\requests\UserRequests;
use App\processData\UserAuthentication\UserAuthentication;

try {
  $email = ValidateInput::validateEmail($_POST['email']);
  $password = ValidateInput::validatePassword($_POST['password']);

  $user = DbSearchs::emailExist($email);

  if ($user) {
    $userPass = $user['password'];
    $passVerify = password_verify($password, $userPass);

    if ($passVerify) {
        $token = $user['token'];

        setcookie(
          "userToken",
          $token,
          time() + 60 * 60 * 24 * 60,
          "/"
        );

        header("location: http://walletyours.infinityfreeapp.com/");
        die;
    }

      throw new \Exception(Responses::newInputMessage("error", "Email ou Senha incorretos"));
  } 

  throw new \Exception(Responses::newInputMessage("error", "Email ou Senha incorretos"));
} catch (\Exception $error) {
  $errorData = $error->getMessage();

  setCookie(
    "signinError",
    $errorData,
    time() + 3,
    '/'
  );
  header("location: http://walletyours.infinityfreeapp.com/signin");
}
