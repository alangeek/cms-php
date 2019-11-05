<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<!-- Fetching Existing Data -->
<?php 
$SearchQueryParameter = $_GET["username"];
global $ConnectingDB;
$sql  = "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt = $ConnectingDB->prepare($sql);
$stmt->bindValue(':userName', $SearchQueryParameter);
$stmt->execute();
$Result = $stmt->rowcount();
if($Result == 1){
  while ($DataRows    = $stmt->fetch()) {
    $ExistingName     = $DataRows["aname"];
    $ExistingBio      = $DataRows["abio"];
    $ExistingImage    = $DataRows["aimage"];
    $ExistingHeadline = $DataRows["aheadline"];
  }
} else {
  $_SESSION["ErrorMessage"]="Ops Camarada Bad Request !";
  header("Location: Blog.php?page=1");
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/adminstyles.css">
    <title>Perfil</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="#" class="navbar-brand text-primary"> AlanGeek</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="Blog.php" class="nav-link text-info">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-info text-info">Sobre</a>
          </li>
          <li class="nav-item">
            <a href="Blog.php" class="nav-link text-info">Blog</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-info">Contato</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-info">Recursos</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <form class="form-inline d-none d-sm-block" action="Blog.php">
            <div class="form-group">
            <input class="form-control mr-2" type="text" name="Search" placeholder="Pesquisar aqui" value="">
            <button class="btn" id="button_go" name="SearchButton"><i class="fas fa-space-shuttle"></i></button>
            </div>
          </form>
        </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR-END-->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <h1><i class="fas fa-user mr-2"></i> <?php echo $ExistingName; ?></h1>
          <h3><?php echo $ExistingHeadline; ?></h3>
        </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-md-3">
          <img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9" style="min-height: 460px;">
          <div class="card">
            <div class="card-body">
              <p class=""><?php echo $ExistingBio; ?></p>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">&copy; <span id="year"></span> Alan Christian - All right reserved.</p>
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