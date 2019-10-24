<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php Confirm_Login(); ?>
<?php
if (isset($_POST["Submit"])) {
	$PostTitle   = $_POST["PostTitle"];
	$Category    = $_POST["Category"];
	$Image       = $_FILES["Image"]["name"];
	$Target      = "uploads/" . basename($_FILES["Image"]["name"]);
	$PostText    = $_POST["PostDescription"];
	$Admin       = $_SESSION["UserName"];
	date_default_timezone_set("America/Sao_Paulo");
	$CurrentTime = time();
	$DateTime    = strftime("%d-%B-%Y %H:%M:%S", $CurrentTime);

	if (empty($PostTitle)) {
		$_SESSION["ErrorMessage"] = "O Título não pode estar vazio";
		header("Location: AddNewPost.php");
		exit;
	} elseif (strlen($PostTitle) < 5) {
		$_SESSION["ErrorMessage"] = "O Título do Post deve ter mais de 5 caracteres";
		header("Location: AddNewPost.php");
		exit;
	} elseif (strlen($PostText) > 9999) {
		$_SESSION["ErrorMessage"] = "A Descrição da Postagem deve ter menos de 1000 caracteres";
		header("Location: AddNewPost.php");
		exit;
	} else {
		// Query to insert Post in DB when everything is fine
		global $ConnectingDB;
		$sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
		$sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':dateTime', $DateTime);
		$stmt->bindValue(':postTitle', $PostTitle);
		$stmt->bindValue(':categoryName', $Category);
		$stmt->bindValue(':adminName', $Admin);
		$stmt->bindValue(':imageName', $Image);
		$stmt->bindValue(':postDescription', $PostText);
		$Execute = $stmt->execute();
		move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
		if ($Execute) {
			$_SESSION["SuccessMessage"] = "Post com id : " . $ConnectingDB->lastInsertId() . " Adcionada Com Sucesso";
			header("Location: AddNewPost.php");
			exit;
		} else {
			$_SESSION["ErrorMessage"] = "Algo deu errado. Tente novamente !";
			header("Location: AddNewPost.php");
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

    <title>Categorias</title>
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
          <h1><i class="fas fa-edit" style="color: #27aae1;"></i> Adc Novo Post</h1>
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
          <form class="" action="AddNewPost.php" method="POST" enctype="multipart/form-data">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"> <span class="FieldInfo"> Titulo do Post: </span></label>
                  <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Digite o título aqui: " value="">
                </div>
                <div class="form-group">
                  <label for="CategoryTitle"> <span class="FieldInfo"> Selecionar Categoria: </span></label>
                  <select class="form-control" id="CategoryTitle" name="Category">
<?php
//Fetchinng all the categories from category table
global $ConnectingDB;
$sql = "SELECT id, title  FROM category";
$stmt = $ConnectingDB->query($sql);
while ($DateRows = $stmt->fetch()) {
	$Id = $DateRows["id"];
	$categoryName = $DateRows["title"];
	?>
                    <option> <?php echo $categoryName; ?></option>
<?php }?>
                  </select>
                </div>
                <div class="form-group mb">
                    <div class="custom-file">
                      <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                      <label for="imageSelect" class="custom-file-label">Selecionar Imagem</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Post"> <span class="FieldInfo"> Post: </span></label>
                    <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"></textarea>

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