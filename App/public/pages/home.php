<?php
require_once('vendor/autoload.php');

use App\processData\UserAuthentication\UserAuthentication;

UserAuthentication::islogged();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <base href="http://walletyours.infinityfreeapp.com/" target="_blank">

  <title>WalletYours - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="App/public/assets/css/default.css">
  <link rel="stylesheet" href="App/public/assets/css/home.css">
</head>
<body class="bg-light">
  <header class="navbar">
    <div class="container-fluid">
      <a href="" class="navbar-brand text-white fw-semibold">
        WalletYours
      </a>
      <button class="btn" type="button">
        <a href="profile" rel="alternate" target="_self" class="">
          <img src="App/public/assets/svg/user-icon.svg" alt="Perfil" class="icon">
        </a>
      </button>
    </div>
  </header>

  <main>
    <section class="graph p-2 p-md-5">
      <canvas id="money-flow"></canvas>

      <select name="graph-select" class="graph-select form-select d-block mx-auto text-white my-5">
        <option value="expense" selected>Gastos</option>
        <option value="income">Ganhos</option>
      </select>

      <button class="btn-add-money btn d-block mx-auto text-white my-5" data-bs-toggle="modal" data-bs-target="#modal-add-transaction">
        Adicionar
      </button>

    </section>
    <section class="cards row g-2">
      <div class="col-10 mx-auto">
        <div class="card card-total border-0">
          <div class="card-body">
            <h2 class="card-title">
              Total
            </h2>
            <p class="total-card card-text ms-3 fw-semibold fs-2">R$ 0,00</p>
          </div>
        </div>
      </div>
      <div class="col-10 mx-auto">
        <div class="card card-total border-0">
          <div class="card-body">
            <h2 class="card-title">
              Entradas
            </h2>
            <p class="income-card card-text ms-3 fw-semibold fs-2">R$ 0,00</p>
          </div>
        </div>
      </div>
      <div class="col-10 mx-auto">
        <div class="card-total card border-0">
          <div class="card-body">
            <h2 class="card-title">
              Saidas
            </h2>
            <p class="expense-card card-text ms-3 fw-semibold fs-2">R$ 0,00</p>
          </div>
        </div>
      </div>
    </section>

    <button class="btn-historic btn d-block mx-auto text-white mt-5 mb-3">
      <a href="historic" target="_self" class="text-white text-decoration-none">
        Ver histórico
      </a>
    </button>

  <section class="modals">
    <section class="modal-add-transaction">
      <div class="modal fade" id="modal-add-transaction">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                Nova transação
              </h5>
              <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="something" class="form-new-transaction">
                <div class="mb-3">
                  <label for="" class="form-label">Descrição</label>
                  <input type="text" class="input-description form-control" name="description" placeholder="Ex: Parcela do financiamento" required>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Preço</label>
                  <input type="text" class="input-price form-control" name="price" placeholder="R$ 0,00" required>
                </div>
                <div class="mb-3">
                  <input type="radio" name="is-negative" value="positive" checked>
                  <label for="">Entrada</label>
                  <input type="radio" name="is-negative" value="negative">
                  <label for="">Saida</label>
                </div>

                <button class="btn-send-data btn btn-success d-block mx-auto mt-3" type="submit" data-bs-dismiss="modal">
                  Adicionar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="modal-success">
      <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <img src="App/public/assets/svg/success-icon.svg" alt="sucesso" class="icon-success d-block mx-auto mt-1 mb-1">
              <p class="fs-3 d-block mb-5 text-center">Transação adicionada com sucesso!</p>

              <button class="btn btn-success d-block mx-auto" data-bs-dismiss="modal">
                fechar
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="modal-error">
      <div class="modal fade" id="modal-error">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <img src="App/public/assets/svg/error-icon.svg" alt="Erro" class="icon-error d-block mx-auto mt-1 mb-1">
              <p class="fs-3 d-block mb-5 text-center">
                Algo deu errado!
              </p>

              <button class="btn btn-danger d-block mx-auto" data-bs-dismiss="modal">
                Fechar
              </button>
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
  <script type="module" src="App/public/assets/js/home.js"></script>
</body>
</html>
