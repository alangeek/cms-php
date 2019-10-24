<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
if (isset($_POST["Submit"])) {
  $UserName        = $_POST["Username"];
  $Name            = $_POST["Name"];
  $Password        = $_POST["Password"];
  $ConfirmPassword = $_POST["ConfirmPassword"];
  $Admin           = $_SESSION["UserName"];
  date_default_timezone_set("America/Sao_Paulo");
  $CurrentTime     = time();
  $DateTime        = strftime("%d-%B-%Y %H:%M:%S", $CurrentTime);

  if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
    $_SESSION["ErrorMessage"]= "Todos os campos devem ser preenchidos";
    header("Location: Admins.php");
    exit;
  } elseif (strlen($Password) < 4) {
    $_SESSION["ErrorMessage"] = "A Senha deve ter mais de 3 caracteres";
    header("Location: Admins.php");
    exit;
  } elseif ($Password !== $ConfirmPassword) {
    $_SESSION["ErrorMessage"] = "Senha e Confirmar senha devem corresponder";
    header("Location: Admins.php");
    exit;
  } elseif (CheckUserNameExistsOrNot($UserName)) {
    $_SESSION["ErrorMessage"] = "O nome de usuário já existe. Tente outro! ";
    header("Location: Admins.php");
    exit;
    
  } else {
    // Query to insert category new Admin in DB when everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
    $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':userName',$UserName);
    $stmt->bindValue(':password',$Password);
    $stmt->bindValue(':aName',$Name);
    $stmt->bindValue(':adminName',$Admin);
    $Execute=$stmt->execute();
    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Novo Admin com o nome de ".$Name." Adcionado com Sucesso";
      header("Location: Admins.php");
      exit;
    } else {
      $_SESSION["ErrorMessage"] = "Algo deu errado. Tente novamente !";
      header("Location: Admins.php");
      exit;
    }
  }
} // Ending of Submit Button is-Condition

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

    <title>Admin Page</title>
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
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="MyProfile.php" class="nav-link text-info"> <i class="fas fa-user"></i> Meu Perfil</a>
          </li>
          <li class="nav-item">
            <a href="Dashboard.php" class="nav-link text-info">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="Posts.php" class="nav-link text-info text-info">Posts</a>
          </li>
          <li class="nav-item">
            <a href="Categories.php" class="nav-link text-info">Categorias</a>
          </li>
          <li class="nav-item">
            <a href="Admins.php" class="nav-link text-info">Gerencidor admins</a>
          </li>
          <li class="nav-item">
            <a href="Comments.php" class="nav-link text-info">Comentarios</a>
          </li>
          <li class="nav-item">
            <a href="Blog.php?page=1" class="nav-link text-info">Live Blog</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link btn btn-outline-secondary"> <i class="fas fa-user-times"></i> Logout</a></li>
        </ul>
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
          <h1><i class="fas fa-user" style="color: #27aae1;"></i> Gerenciador Admin</h1>
        </div>
        </div>
      </div>
    </header>


    <!-- HEADER END -->

    <!-- Main Area -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height:457px;">
          <?php
echo ErrorMessage();
echo SuccessMessage();
?>
          <form class="" action="Admins.php" method="POST">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-header">
                <h1>Adc Novo Admin</h1>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="username"> <span class="FieldInfo"> Nome de Usuário: </span></label>
                  <input class="form-control" type="text" name="Username" id="username" value="">
                </div>
                <div class="form-group">
                  <label for="Name"> <span class="FieldInfo"> Nome: </span></label>
                  <input class="form-control" type="text" name="Name" id="Name" value="">
                  <small class="text-muted">*Opcional</small>
                </div>
                <div class="form-group">
                  <label for="Password"> <span class="FieldInfo"> Senha: </span></label>
                  <input class="form-control" type="password" name="Password" id="Password" value="">
                </div>
                <div class="form-group">
                  <label for="ConfirmPassword"> <span class="FieldInfo"> Confirmar Senha: </span></label>
                  <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="">
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-hand-point-left"></i> Voltar para Dashboard</a>
                  </div>
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                      <i class="fas fa-rocket"></i> Publicar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>

    </section>





    <!-- End Main Area -->

    <!-- FOOTER -->
    <footer class="bg-dark text-white">
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