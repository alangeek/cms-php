<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php Confirm_Login(); ?>
<?php
$SarchQueryParameter = $_GET['id'];
// Fetching Existing Content according to our
global $ConnectingDB;
$sql = "SELECT * FROM posts WHERE id='$SarchQueryParameter'";
$stmt = $ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $TitleToBeDeleted    = $DataRows['title'];
  $CategoryToBeDeleted = $DataRows['category'];
  $ImageToBeDeleted    = $DataRows['image'];
  $PostToBeDeleted     = $DataRows['post'];

}
// echo $ImageToBeDeleted;
if (isset($_POST["Submit"])) {
		// Query to delete Post in DB when everything is fine
		global $ConnectingDB;
    $sql = "DELETE FROM posts WHERE id='$SarchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
    // var_dump ($Execute);
		if ($Execute) {
      $Target_Path_To_DELETE_Image = "uploads/$ImageToBeDeleted";
      unlink($Target_Path_To_DELETE_Image);/*unlink — Apaga um arquivo*/
			$_SESSION["SuccessMessage"] = "Post DELETADO Com Sucesso";
			header("Location: Posts.php");
			exit;
		} else {
			$_SESSION["ErrorMessage"] = "Algo deu errado. Tente novamente !";
			header("Location: Posts.php");
			exit;
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

    <title>Deletar Post</title>
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
          <h1><i class="fas fa-edit" style="color: #27aae1;"></i> Deletar Post</h1>
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
          <form class="" action="DeletePost.php?id=<?php echo $SarchQueryParameter; ?>" method="POST" enctype="multipart/form-data">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"> <span class="FieldInfo"> Titulo do Post: </span></label>
                  <input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Digite o título aqui: " value="<?php echo $TitleToBeDeleted; ?>">
                </div>
                <div class="form-group">
                  <span class="FieldInfo">Categoria Existente: </span>
                  <?php echo $CategoryToBeDeleted; ?>
                  <br>
                  
                </div>
                <div class="form-group">
                  <span class="FieldInfo">Imagem Existente: </span>
                  
                  </div>
                  <div class="form-group">
                    <label for="Post"> <span class="FieldInfo"> Post: </span></label>
                    <textarea disabled class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                      <?php echo $PostToBeDeleted; ?>
                    </textarea>

                  </div>

                  <div class="row">
                    <div class="col-lg-6 mb-2">
                      <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-hand-point-left"></i> Voltar para Dashboard</a>
                    </div>
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-danger btn-block">
                      <i class="fas fa-trash"></i> Deletar
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