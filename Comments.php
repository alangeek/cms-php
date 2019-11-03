<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php $_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
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
    <title>Comentários</title>
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
            <a href="Blog.php?page=1" target="_blanck" class="nav-link text-info">Live Blog</a>
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
          <h1><i class="fas fa-comments" style="color: #27aae1;"></i> Admin Comentários</h1>
        </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <!-- Main Area Start -->
    <section class="container py-2 mb-4">
      <div class="row" style="min-height: 30px;">
        <div class="col-lg-12" style="min-height: 400px;">
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?>
          <h2>Comentários não aprovados</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No. </th>
                <th>Data&Hora</th>
                <th>Nome</th>
                <th>Comentário</th>
                <th>Aprovar</th>
                <th>Deletar</th>
                <th>Detalhes</th>
              </tr>
            </thead>
          <?php
          global $ConnectingDB;
          $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id DESC";
          $Execute = $ConnectingDB->query($sql);
          $SrNo = 0;
          while ($DataRows=$Execute->fetch()) {
            $CommentId         = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName     = $DataRows["name"];
            $CommentContent    = $DataRows["comment"];
            $CommentPostId     = $DataRows["post_id"];
            $SrNo++;
            // if (strlen($CommenterName)>10) { $CommenterName = substr($CommenterName,0,10).'..';}
            // if (strlen($DateTimeOfComment)>10) { $DateTimeOfComment = substr($DateTimeOfComment,0,11).'..';}
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfComment); ?></td>
              <td><?php echo htmlentities($CommenterName); ?></td>
              <td><?php echo htmlentities($CommentContent); ?></td>
              <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-success btn-sm">Aprovar</a></td>
              <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger btn-sm">Deletar</a></td>
              <td style="min-width: 140px;"><a class="btn btn-primary btn-sm" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blanck">Live Preview</a></td>
            </tr>            
          </tbody>
          <?php } ?>
          </table>
          <h2>Comentários aprovados</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No. </th>
                <th>Data&Hora</th>
                <th>Nome</th>
                <th>Comentário</th>
                <th>Reveter</th>
                <th>Deletar</th>
                <th>Detalhes</th>
              </tr>
            </thead>
          <?php
          global $ConnectingDB;
          $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id DESC";
          $Execute = $ConnectingDB->query($sql);
          $SrNo = 0;
          while ($DataRows=$Execute->fetch()) {
            $CommentId         = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName     = $DataRows["name"];
            $CommentContent    = $DataRows["comment"];
            $CommentPostId     = $DataRows["post_id"];
            $SrNo++;
            // if (strlen($CommenterName)>10) { $CommenterName = substr($CommenterName,0,10).'..';}
            // if (strlen($DateTimeOfComment)>10) { $DateTimeOfComment = substr($DateTimeOfComment,0,11).'..';}
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfComment); ?></td>
              <td><?php echo htmlentities($CommenterName); ?></td>
              <td><?php echo htmlentities($CommentContent); ?></td>
              <td style="min-width: 140px;"><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-warning btn-sm text-white">Desaprovar</a></td>
              <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger btn-sm">Deletar</a></td>
              <td style="min-width: 140px;"><a class="btn btn-primary btn-sm" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blanck">Live Preview</a></td>
            </tr>            
          </tbody>
          <?php } ?>
          </table>
        </div>
      </div>
    </section>
    <!-- Main Area End -->
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

