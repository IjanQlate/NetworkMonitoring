<?php

$ipaddress = $_POST['ipaddress'];
$hoststart = $_POST['hoststart'];
$hostend = $_POST['hostend'];

$command = escapeshellcmd('python ../python/networkmonitor.py '.$ipaddress." ".$hoststart." ".$hostend);
$output = shell_exec($command);
echo $output;



?>