<?php
require_once('vendor/autoload.php');

use App\processData\UserAuthentication\UserAuthentication;

UserAuthentication::islogged();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <base href="http://walletyours.infinityfreeapp.com/" target="_blank">
  <!-- <base href="#" target="_blank"> -->
  <title>WalletYours - Historic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="App/public/assets/css/default.css">
  <link rel="stylesheet" href="App/public/assets/css/historic.css">
</head>
<body>
  <header class="position relative">
    <a href="home" target="_self" class="mt-3 ms-3 position-absolute top-0 start-0">
      <img src="App/public/assets/svg/go-back-icon.svg" alt="Voltar" class="icon">
    </a>
    <h1 class="text-center text-white mt-2">Histórico</h1>
  </header>

  <main class="bg-light">
    <section class="transactions">

    </section>

    <section class="modals">
      <section class="modal-transaction-info">
        <div class="modal fade" id="modal-transaction-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  Transação
                </h5>
                <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p class="info-description">Descrição: </p>
                <p class="info-price">Preço: </p>
                <p class="info-date">Data: </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
  </main>

  <footer>
    <p class="text-center">WalletYours</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script type="module" src="App/public/assets/js/historic.js"></script>
</body>
</html>
