<?php
function Redirect_to($New_location) {
	header("Location" . $New_location);
	exit;
}

?>