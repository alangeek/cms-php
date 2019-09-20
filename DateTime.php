<?php
date_default_timezone_set("America/Sao_Paulo");
$CurrentTime = time();
$DateTime = strftime("%d-%B-%Y %H:%M:%S", $CurrentTime);
echo $DateTime;
?>