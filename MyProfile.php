<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
 // Fetchinng the Existing Admin Data
$AdminId = $_SESSION["UserId"];
global $ConnectingDB;
$sql    = "SELECT * FROM admins WHERE id='$AdminId'";
$stmt   = $ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $ExistingName     = $DataRows['aname'];
  $ExistingUsername = $DataRows['username'];
  $ExistingHeadline = $DataRows['aheadline'];
  $ExistingBio      = $DataRows['abio'];
  $ExistingImage    = $DataRows['aimage'];

}
 // Fetchinng the Existing Admin Data End
if (isset($_POST["Submit"])) {
	$AName       = $_POST["Name"];
	$AHeadline   = $_POST["Headline"];
  $ABio        = $_POST["Bio"];
	$Image       = $_FILES["Image"]["name"];
	$Target      = "images/".basename($_FILES["Image"]["name"]);

	if (strlen($AHeadline) > 12) {
		$_SESSION["ErrorMessage"] = "Título deve ter menos de 12 caracteres";
		header("Location: MyProfile.php");
		exit;
	} elseif (strlen($ABio) > 500) {
		$_SESSION["ErrorMessage"] = "A Descrição da Postagem deve ter menos de 500 caracteres";
		header("Location: MyProfile.php");
		exit;
	} else {
		// Query to update Admin in DB when everything is fine
    global $ConnectingDB;
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE admins
              SET aname='$AName', Aheadline='$AHeadline', abio='$ABio', aimage='$Image'
              WHERE id='$AdminId'";
    } else {
      $sql = "UPDATE admins
              SET aname='$AName', Aheadline='$AHeadline', abio='$ABio'
              WHERE id='$AdminId'";
    }

    $Execute = $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
		if ($Execute) {
			$_SESSION["SuccessMessage"] = "Detalhes Atualizado com Sucesso";
			header("Location: MyProfile.php");
			exit;
		} else {
			$_SESSION["ErrorMessage"] = "Algo deu errado. Tente novamente !";
			header("Location: MyProfile.php");
			exit;
		}
	}
} // Ending of Submit Button is-Condition

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
    <title>Meu Perfil</title>
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
            <a href="Blog.php?page=1" class="nav-link text-info">Live Blog</a>
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
          <h1><i class="fab fa-earlybirds"></i>@<?php echo $ExistingUsername; ?></h1>
          <small><?php echo $ExistingHeadline; ?></small>
        </div>
        </div>
      </div>
    </header>


    <!-- HEADER END -->

    <!-- Main Area -->
    <section class="container py-2 mb-4">
      <div class="row">
        <!-- Left Area -->
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-dark text-light text-center">
              <h3><?php echo $ExistingName; ?></h3>
            </div>
            <div class="card-body">
              <img src="images/<?php echo $ExistingImage; ?>" class="block img-fluid mb-3" alt="">
              <div class="">
                <?php echo $ExistingBio; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Right Area -->
        <div class="col-md-9" style="min-height:400px;">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?>
          <form class="" action="MyProfile.php" method="POST" enctype="multipart/form-data">
            <div class="card bg-dark text-light">
              <div class="card-header text-light" id="bgProfile">
                <h4>Editar Perfil <i class="fas fa-wrench"></i></h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" type="text" name="Name" id="title" placeholder="Seu nome " value="">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" id="title" placeholder="Título" name="Headline">
                  <small class="text-muted">Adicione um título profissional como "Enginner" ou "Architect"</small>
                  <span class="text-danger">Não mais que 12 caracteres</span>
                </div>
                <div class="form-group">
                    <textarea placeholder="Bio" class="form-control" id="Post" name="Bio" rows="8" cols="80"></textarea>
                  </div>
                <div class="form-group">
                    <div class="custom-file">
                      <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                      <label for="imageSelect" class="custom-file-label">Selecionar Imagem</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 mb-2">
                      <a href="Dashboard.php" class="btn btn-warning btn-block text-white"><i class="fas fa-hand-point-left"></i> Voltar para Dashboard</a>
                    </div>
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                      <i class="fas fa-rocket"></i> Atualizar
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