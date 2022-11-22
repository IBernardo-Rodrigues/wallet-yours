<?php
require_once('vendor/autoload.php');

use App\processData\UserAuthentication\UserAuthentication;

UserAuthentication::islogged();
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <base href="http://walletyours.infinityfreeapp.com/" target="_blank">
  
  <title>WalletYours - Perfil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="App/public/assets/css/default.css">
  <link rel="stylesheet" href="App/public/assets/css/profile.css">
</head>
<body>

  <header class="p-2">
    <a href="home" target="_self">
      <img src="App/public/assets/svg/go-back-icon.svg" alt="Voltar" class="icon">
    </a>
  </header>

  <main>
    <section class="user-data position-relative">
        <div class="d-flex justify-content-around align-items-center px-2">
          <div class="user-img">
            <div class="profile-img rounded-circle"></div>
          </div>

          <div class="user-info">
            <h2 class="username text-white"></h2>

            <div class="user-email d-flex align-items-center gap-2">
              <img src="App/public/assets/svg/email.svg" alt="Email" class="icon">
              <p class="email m-0"></p>
          </div>
        </div>
      </div>

      <div class="col-10 mx-auto mt-3">
        <div class="card card-total border-0">
          <div class="card-body">
            <h2 class="card-title">
              Total
            </h2>
            <p class="total-card card-text ms-3 fw-normal fs-1 opacity-75">R$ 0,00</p>
          </div>
        </div>
      </div>
    </section>

    <section class="options">
      <div class="col-10 mx-auto mt-3">
        <div class="card card-total border-0">
          <div class="card-body d-flex align-items-center">
            <img src="App/public/assets/svg/exit-icon.svg" alt="Sair" class="icon">
            <a href="logout" target="_self" class="text-dark fs-4 fw-semibold text-decoration-none ms-2">
              Sair
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p class="text-center">WalletYours</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script type="module" src="App/public/assets/js/profile.js"></script>
</body>
</html>
