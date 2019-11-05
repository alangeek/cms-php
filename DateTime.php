<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$CurrentTime = time();
$DateTime = strtotime("%d/%m/%Y %H:%M:%S", $CurrentTime);
echo $DateTime;


?>