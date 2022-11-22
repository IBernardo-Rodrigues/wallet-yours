<!DOCTYPE html>
<html lang="PT-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <base href="http://walletyours.infinityfreeapp.com/" target="_blank">
  <title>WalletYours - Entrar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="App/public/assets/css/default.css">
  <link rel="stylesheet" href="App/public/assets/css/signin.css">
</head>
<body >

  <main class="login bg-light rounded p-3">
    <h1 class="text-center">Entrar</h1>
    <form method="POST" action="App/processData/signin/processSignIn.php" target="_self">

      <div class="mb-3">
        <label for="" class="form-label">Email *</label>
        <input type="email" class="input-email form-control shadow-none" name="email" placeholder="Ex: joãosilva@gmail.com">
        <span class="email-error-message"></span>
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Senha *</label>
        <input type="password" class="input-password form-control shadow-none" name="password" placeholder="Sua senha">
        <span class="password-error-message"></span>
      </div>

      <span class="error-message d-block text-center invalid-feedback"></span>

      <button class="btn-send-data btn btn-success d-block mx-auto mt-3" type="submit">
        Adicionar
      </button>
    </form>

    <div class="text-center mt-2 mb-1">
      <a href="signup" target="_self" class="">
        Ainda não tem uma conta? Clique aqui!
      </a>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script type="module" src="App/public/assets/js/signin.js"></script>
</body>
</html>
