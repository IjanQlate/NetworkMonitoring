<?php

$function = $_POST['function'];

$command = escapeshellcmd('python ../python/networkdevice/ipconfig.py '.$function);
$output = shell_exec($command);
echo $output;



?>