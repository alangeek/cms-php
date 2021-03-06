<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php 
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"]; 
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<?php
if (isset($_POST["Submit"])) {
	$Category    = $_POST["CategoryTitle"];
	$Admin       = $_SESSION["UserName"];
	date_default_timezone_set("America/Sao_Paulo");
	$CurrentTime = time();
	$DateTime    = strftime("%d-%B-%Y %H:%M:%S", $CurrentTime);

	if (empty($Category)) {
		$_SESSION["ErrorMessage"] = "Todos os campos devem ser preenchidos";
		header("Location: Categories.php");
		exit;
	} elseif (strlen($Category) < 3) {
		$_SESSION["ErrorMessage"] = "O título da categoria deve ter mais de 2 caracteres";
		header("Location: Categories.php");
		exit;
	} elseif (strlen($Category) > 49) {
		$_SESSION["ErrorMessage"] = "O título da categoria deve ser menos de 50 caracteres";
		header("Location: Categories.php");
		exit;
	} else {
		// Query to insert category in DB when everything is fine
		global $ConnectingDB;
		$sql = "INSERT INTO category(title,author,datetime)";
		$sql .= "VALUES(:categoryName,:adminName,:dateTime)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue('categoryName', $Category);
		$stmt->bindValue(':adminName', $Admin);
		$stmt->bindValue(':dateTime', $DateTime);
		$Execute = $stmt->execute();

		if ($Execute) {
			$_SESSION["SuccessMessage"] = "Categoria com id : " . $ConnectingDB->lastInsertId() . " Adcionada Com Sucesso";
			header("Location: Categories.php");
			exit;
		} else {
			$_SESSION["ErrorMessage"] = "Algo deu errado. Tente novamente !";
			header("Location: Categories.php");
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
          <h1><i class="fas fa-edit" style="color: #27aae1;"></i> Admin Categorias</h1>
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
          <form class="" action="Categories.php" method="POST">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-header">
                <h1>Adc Nova Categoria</h1>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"> <span class="FieldInfo"> Titulo da Categoria: </span></label>
                  <input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Digite o título aqui: " value="">
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <a href="Dashboard.php" class="btn btn-warning btn-block text-white"><i class="fas fa-hand-point-left"></i> Voltar para Dashboard</a>
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
          <h2>Categorias Existentes</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No. </th>
                <th>Data&Hora</th>
                <th>Nome da Categoria</th>
                <th>Nome do Criador</th>
                <th>Ação</th>
                <!-- <th>Reveter</th> -->
                <!-- <th>Deletar</th> -->
              </tr>
            </thead>
          <?php
          global $ConnectingDB;
          $sql = "SELECT * FROM category ORDER BY id DESC";
          $Execute = $ConnectingDB->query($sql);
          $SrNo = 0;
          while ($DataRows=$Execute->fetch()) {
            $CategoryId    = $DataRows["id"];
            $CategoryDate  = $DataRows["datetime"];
            $CategoryName  = $DataRows["title"];
            $CreatorName   = $DataRows["author"];
            $SrNo++;
            // if (strlen($CommenterName)>10) { $CommenterName = substr($CommenterName,0,10).'..';}
            // if (strlen($DateTimeOfComment)>10) { $DateTimeOfComment = substr($DateTimeOfComment,0,11).'..';}
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($CategoryDate); ?></td>
              <td><?php echo htmlentities($CategoryName); ?></td>
              <td><?php echo htmlentities($CreatorName); ?></td>
              <td><a href="DeleteCategory.php?id=<?php echo $CategoryId; ?>" class="btn btn-danger btn-sm">Deletar</a></td>
            </tr>            
          </tbody>
          <?php } ?>
          </table>

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