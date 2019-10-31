<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php
if(isset($_GET["id"])) {
	$SearchQueryParamater = $_GET["id"];
	global $ConnectingDB;
	$sql     = "DELETE FROM category WHERE id='$SearchQueryParamater'";
	$Execute = $ConnectingDB->query($sql);
	if ($Execute) {
		$_SESSION["SuccessMessage"] = "Categoria Deletada com Sucesso !";
		header("Location: Categories.php");
		exit();
	} else {
		$_SESSION["ErrorMessage"]   = "Algo deu errado. Tente novamente !";
		header("Location: Categories.php");
		exit();
	}
}

?>