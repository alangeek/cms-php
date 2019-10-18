<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
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
    <title>Blog Page</title>
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
            <button class="btn" id="button_go" name="SearchButton">Ir <i class="fab fa-searchengin"></i></button>
            </div>
          </form>
        </ul>
        </div>
      </div>
    </nav>
    <div style="height: 3px; background: #27aae1;"></div>
    <!-- NAVBAR-END-->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start -->
        <div class="col-sm-8">
          <h1>O Blog da Informação</h1>
          <h1 class="lead">Fique Antenado sobre as Últimas Noticias Mundiais</h1>
          <?php
echo ErrorMessage();
echo SuccessMessage();
?>
          <?php
global $ConnectingDB;
//SQL query when Search button is active
if (isset($_GET["SearchButton"])) {
	$Search = $_GET["Search"];
	$sql = "SELECT * FROM posts
  WHERE datetime LIKE :search
  OR title LIKE :search
  OR category LIKE :search
  OR post LIKE :search";
	$stmt = $ConnectingDB->prepare($sql);
	$stmt->bindValue(':search', '%' . $Search . '%');
	$stmt->execute();
}
// The default SQL query
else {
	$sql = "SELECT * FROM posts ORDER BY id DESC";
	$stmt = $ConnectingDB->query($sql);
}
while ($DataRows = $stmt->fetch()) {

	$PostId = $DataRows["id"];
	$DateTime = $DataRows["datetime"];
	$PostTitle = $DataRows["title"];
	$Category = $DataRows["category"];
	$Admin = $DataRows["author"];
	$Image = $DataRows["image"];
	$PostDescription = $DataRows["post"];
	?>
          <div class="card">
            <img src="uploads/<?php echo htmlentities($Image); ?>" style="max-height: 450px;" class="img-fluid card-img-top" />
            <div class="card-body">
              <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted">Escrito Por <?php echo htmlentities($Admin); ?> Em <?php echo htmlentities($DateTime); ?></small>
              <span style="float: right;" class="badge badge-dark text-light">Comentários 20</span>


              <hr>
              <p class="card-text">
                <?php if (strlen($PostDescription) > 150) {$PostDescription = substr($PostDescription, 0, 150) . "...";}
	echo htmlentities($PostDescription);?></p>
                <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float: right;">
                  <span class="btn btn-info">Leia Mais >></span>
                </a>
            </div>
          </div>
          <br>
<?php }?>

        </div>

        <!-- Main Area End -->




        <!-- Side Area Start -->
        <div class="col-sm-4" style="min-height: 40px;background-color: red;">

        </div>
        <!-- Side Area End -->


      </div>
    </div>
    <!-- HEADER END -->
    <br>
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