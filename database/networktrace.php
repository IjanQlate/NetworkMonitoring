<?php

$hostaddress = $_POST['hostaddress'];

$command = escapeshellcmd('python ../python/networktrace.py tracert '.$hostaddress);
$output = shell_exec($command);
echo $output;



?>