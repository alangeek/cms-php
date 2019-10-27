<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php
if(isset($_GET["id"])) {
	$SearchQueryParamater = $_GET["id"];
	global $ConnectingDB;
	$Admin   = $_SESSION["AdminName"];
	$sql     = "UPDATE comments SET status='OFF', approvedby='$Admin' WHERE id='$SearchQueryParamater'";
	$Execute = $ConnectingDB->query($sql);
	if ($Execute) {
		$_SESSION["SuccessMessage"] = "Comentário Desaprovado com Sucesso !";
		header("Location: comments.php");
		exit();
	} else {
		$_SESSION["ErrorMessage"]   = "Algo deu errado. Tente novamente !";
		header("Location: comments.php");
		exit();
	}
}

?>