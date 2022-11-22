<?php
namespace App\utils;

class ValidateInput {
  public static function validateName($name) {

    if (!empty(trim($name))) {
      $regex = '/^[a-zA-Zà-ùÀ-Ù" "]+$/';
      $isValid = preg_match($regex, $name);

      if ($isValid) {
        return filter_var(
          $name,
          FILTER_SANITIZE_SPECIAL_CHARS
        );
      }

      throw new \Exception(Responses::newInputMessage("nameerror", "Use apenas letras e espaços"));
    }

    throw new \Exception(Responses::newInputMessage("nameerror", "Preencha seu nome"));

  }

  public static function validateEmail($email) {
    if (!empty(trim($email))) {

      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      if ($email) {
        return $email;
      }

      throw new \Exception(Responses::newInputMessage("emailerror", "Email inválido"));
    }

    throw new \Exception(Responses::newInputMessage("emailerror", "Preencha seu email"));
  }

  public static function validatePassword($password) {
    if (!empty(trim($password))) {
      $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

      return $password;
    }

    throw new \Exception(Responses::newInputMessage("passworderror", "Preencha sua senha"));
  }
}