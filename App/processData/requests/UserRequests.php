<?php
namespace App\processData\requests;

class UserRequests {
  public static function postRequest($data) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://walletyours.infinityfreeapp.com/api/user');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    return $response;
  }
}
