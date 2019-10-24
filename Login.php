<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php 
if (isset($_POST["Submit"])) {
  $UserName = $_POST["Username"];
  $Password = $_POST["Password"];
  if (empty($UserName)||empty($Password)) {
    $_SESSION["ErrorMessage"] = "Todos os campos devem ser preenchidos";
    header("Location: Login.php");
    exit();
  } else {
    // code for checking username and passwrod from Database
    $Found_Account = Login_Attempt($UserName,$Password);
    if($Found_Account) {
      $_SESSION["UserId"]     = $Found_Account["id"];
      $_SESSION["UserName"]   = $Found_Account["username"];
      $_SESSION["AdminName"]  = $Found_Account["aname"];

      $_SESSION["SuccessMessage"] = "Bem Vindo ".$_SESSION["AdminName"]."!";
      header("Location: Dashboard.php");
      exit();
    } else {
      $_SESSION["ErrorMessage"] = "Usuário ou Senha Incorretos";
      header("Location: Login.php");
      exit(); 
    }

  }
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/adminstyles.css">
    <title>Login</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <div style="height: 3px; background: #27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand text-primary"> AlanGeek</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
        </div>
      </div>
    </nav>
    <div style="height: 3px; background: #27aae1;"></div>
    <!-- NAVBAR-END-->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

        </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <!-- Main Area Start -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6">
          <br><br><br><br>
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?>
          <div  id="bg-person" class="card  text-light">
            <div class="card-header">
              <div class="card-body" id="bg-person-card">
              <h4>Bem Vindo de volta !</h4>
              </div>
              <form class="" action="Login.php" method="POST">
                <div class="form-group">
                  <label for="username"><span class="color-password">Nome de Usuário</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white" id="bg-person-card"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="Username" id="username" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="color-password">Senha</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white" id="bg-person-card"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="Password" id="password" value="">
                  </div>
                </div>
                <input type="submit" name="Submit" class="btn btn-block" id="bt-login" value="Logar">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Area End -->
    
    <!-- FOOTER -->
    <footer class="bg-dark text-white fixed-bottom">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Tema Feito Por | AlanGeek | <span id="year"></span> &copy; ----Todos os Direitos Reservados.----</p>
        </div>
        </div>
      </div>
    </footer>
    <!-- FOOTER END-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
      $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>