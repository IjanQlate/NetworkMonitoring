<?php

$hostaddress = $_POST['hostaddress'];

$command = escapeshellcmd('python ../python/ping.py ping '.$hostaddress);
$output = shell_exec($command);
echo $output;



?>