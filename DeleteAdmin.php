<?php require_once "Includes/DB.php";?>
<?php require_once "Includes/Functions.php";?>
<?php require_once "Includes/Sessions.php";?>
<?php
if(isset($_GET["id"])) {
	$SearchQueryParamater = $_GET["id"];
	global $ConnectingDB;
	$sql     = "DELETE FROM admins WHERE id='$SearchQueryParamater'";
	$Execute = $ConnectingDB->query($sql);
	if ($Execute) {
		$_SESSION["SuccessMessage"] = "Administrador Removido com Sucesso !";
		header("Location: Admins.php");
		exit();
	} else {
		$_SESSION["ErrorMessage"]   = "Algo deu errado. Tente novamente !";
		header("Location: Admins.php");
		exit();
	}
}

?>