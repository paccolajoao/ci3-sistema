<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Login - ManyMinds Teste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
  </head>
  <body class="text-center">
  <div class="container">
    <main class="form-signin w-100 m-auto">
      <?php echo form_open(base_url("login/check_login")); ?>
        <img class="mb-4" src="<?= base_url("assets/img/logo.png") ?>" alt="">  
        <div class="form-floating">
          <input type="text" class="form-control" id="form-user" name="form-user" placeholder="Usuário">
          <label for="form-user">Usuário</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="form-password" name="form-password" placeholder="Senha">
          <label for="form-password">Senha</label>
        </div>
        <?php if (isset($_SESSION["fail_login"]) && ($_SESSION["fail_login"] == '1')): ?>
        <div class="col error-alert">
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;
            <div class="error-msg"> Usuário e/ou senha inválida</div>
          </div>
        </div>
        <?php $this->session->unset_userdata("fail_login"); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION["fail_login"]) && ($_SESSION["fail_login"] == '2')): ?>
        <div class="col error-alert">
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;
            <div class="error-msg"> Seu IP foi bloqueado devido ao excesso de tentativas.</div>
          </div>
        </div>
        <?php $this->session->unset_userdata("fail_login"); ?>
        <?php endif; ?>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
      <?php echo form_close(); ?>
    </main>
  </div>
  
  <script src="https://kit.fontawesome.com/602fcda4ef.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
</html>
