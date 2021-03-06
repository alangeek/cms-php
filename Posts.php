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
    <link rel="stylesheet" href="css/adminstyles.css">
    <title>Posts</title>
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
            <a target="_blank" href="Blog.php?page=1" class="nav-link text-info">Live Blog</a>
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
          <h1><i class="fas fa-blog" style="color: #27aae1;"></i> Blog Posts</h1>
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
          <a href="Admins.php" class="btn  btn-block" id="buttonAdmin">
            <i class="fas fa-user-plus"> Add Novo Admin</i>
          </a>
         </div>
         <div class="col-lg-3 mb-2">
          <a href="Comments.php" class="btn btn-block" id="buttonComments">
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
        <div class="col-lg-12">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?>
          <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Titulo</th>
              <th>Categoria</th>
              <th>Data & Hora</th>
              <th>Autor</th>
              <th>Banner</th>
              <th>Comentários</th>
              <th>Configurações</th>
              <th>Live Preview</th>
            </tr>
          </thead>
            <?php
              global $ConnectingDB;
              $sql  = "SELECT * FROM posts ORDER BY id DESC";
              $stmt = $ConnectingDB->query($sql);
              $Sr   = 0;
              while ($DataRows = $stmt->fetch()) {
              	$Id        = $DataRows["id"];
              	$DateTime  = $DataRows["datetime"];
              	$PostTitle = $DataRows["title"];
              	$Category  = $DataRows["category"];
              	$Admin     = $DataRows["author"];
              	$Image     = $DataRows["image"];
              	$PostText  = $DataRows["post"];
              	$Sr++;

           	?>
  <tbody>
      <tr>
        <td>
          <?php echo $Sr; ?></td>
        <td>
          <?php
      if (strlen($PostTitle) > 20) {$PostTitle = substr($PostTitle, 0, 15) . '..';}
      	echo $PostTitle;
      	?>
           </td>
        <td>
          <?php
      if (strlen($Category) > 8) {$Category = substr($Category, 0, 8) . '..';}
      	echo $Category;
      	?>
        </td>
        <td><?php
      if (strlen($DateTime) > 11) {$DateTime = substr($DateTime, 0, 11) . '..';}
      	echo $DateTime;?></td>
        <td>
          <?php
      if (strlen($Admin) > 6) {$Admin = substr($Admin, 0, 6) . '..';}
      	echo $Admin;
      	?></td>
        <td><img src="uploads/<?php echo $Image; ?>" width="70px;" height="50px;"></td>
        <td>
                      <?php $Total = ApproveCommentsAccordingtoPost($Id);
                      if ($Total>0) {
                        ?>
                       <span class="badge badge-success">
                       <?php
                        echo $Total; ?>
                      </span>
                      <?php } ?>
                    <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                      if ($Total>0) {
                        ?>
                       <span class="badge badge-danger">
                       <?php
                        echo $Total; ?>
                      </span>
                      <?php } ?>
                  </td>                  
                  <td>
                    <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning btn-sm text-white">Editar</span></a>
                    <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger btn-sm">Deletar</span></a>
                  </td>
                  <td>
                    <a href="FullPost.php?id=<?php echo $Id; ?>" target="__blank"><span class="btn btn-info btn-sm">Preview</span></a>
                  </td>
                </tr>
            </tbody>
          <?php }?>                  
          </table>
        </div>
      </div>
    </section>

    <!-- Main Area End -->


    <!-- FOOTER -->
    <footer class="bg-dark text-white"> <!---fixed-bottom--->
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