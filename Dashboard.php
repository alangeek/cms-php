<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"]; 
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Dashboard</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <div style="height: 1px; background: #27aae1;"></div>
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
            <a href="Blog.php?page=1" class="nav-link text-info" target="_blanck">Live Blog</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link btn btn-outline-secondary"> <i class="fas fa-user-times"></i> Logout</a></li>
        </ul>
        </div>
      </div>
    </nav>
    <div style="height: 1px; background: #000;"></div>
    <!-- NAVBAR-END-->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-user-cog" style="color: #27aae1;"></i> Dashboard</h1>
         </div>
         <div class="col-lg-3 mb-2">
          <a href="AddNewPost.php" class="btn btn-primary btn-block">
            <i class="far fa-newspaper"> Add Nova Postagem</i>
          </a>
         </div>
         <div class="col-lg-3 mb-2">
          <a href="Categories.php" class="btn btn-info btn-block">
            <i class="fas fa-newspaper"> Add Nova Categoria</i>
          </a>
         </div>
         <div class="col-lg-3 mb-2">
          <a href="Admins.php" class="btn btn-default btn-block" style="background-color: #f04f24;color: #fff;">
            <i class="fas fa-user-plus"> Add Novo Admin</i>
          </a>
         </div>
         <div class="col-lg-3 mb-2">
          <a href="Comments.php" class="btn btn-default btn-block" style="background-color: #2ecc71;color: #fff;">
            <i class="fas fa-comments"> Aprovar Comentários</i>
          </a>
         </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

    <!-- Main Area -->
    <section class="container py-2 mb-4">
      <div class="row">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?>
          <!-- Left Side Area Start -->
        <div class="col-lg-2 d-md-block">
          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Posts</h1>
              <h4 class="display-5">
                <i class="fab fa-readme"></i>
                 <?php TotalPosts(); ?>
              </h4>
            </div>
          </div>

          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Categorias</h1>
              <h4 class="display-5">
                <i class="fas fa-folder"></i>
                <?php TotalCategories(); ?>
              </h4>
            </div>
          </div>

          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Admins</h1>
              <h4 class="display-5">
                <i class="fas fa-users"></i>
                <?php TotalAdmins(); ?>
              </h4>
            </div>
          </div>

          <div class="card text-center bg-dark text-white mb-3">
            <div class="card-body">
              <h1 class="lead">Comentários</h1>
              <h4 class="display-5">
                <i class="fas fa-comments"></i>
                <?php TotalComments(); ?>
              </h4>
            </div>
          </div>   

        </div>
          <!-- Left Side Area End -->
          <!-- Right Side Area Star -->
          <div class="col-lg-10">
            <h1>Top Posts</h1>
            <table class="table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>No. </th>
                  <th>Titulo</th>
                  <th>Data&Hora</th>
                  <th>Autor</th>
                  <th>Comentários</th>
                  <th>Detalhes</th>
                </tr>
              </thead>
              <?php 
              $SrNo = 0;
              global $ConnectingDB;
              $sql  = "SELECT * FROM posts ORDER BY id DESC LIMIT 0,5";
              $stmt = $ConnectingDB->query($sql);
              while ($DataRows = $stmt->fetch()) {
                $PostId   = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $Author   = $DataRows["author"];
                $Title    = $DataRows["title"];
                $SrNo++;
              ?>
              <tbody>
                <tr>
                  <td><?php echo $SrNo; ?></td>                  
                  <td><?php echo $Title; ?></td>                  
                  <td><?php echo $DateTime; ?></td>                  
                  <td><?php echo $Author ?></td>                  
                  <td>
                    <span class="badge badge-success">00</span>
                    <span class="badge badge-danger">00</span>
                  </td>                  
                  <td><span class="btn btn-info btn-sm">Preview</span></td>                  

                </tr>
              </tbody>
             <?php } ?>

            </table>
          </div>
          <!-- Right Side Area End -->


      </div>
    </section>

    <!-- Main Area End -->


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