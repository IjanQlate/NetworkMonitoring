<?php

$ipaddress_hostname = $_POST['ipaddress_hostname'];
$scan_option = $_POST['scan_option'];
$portstart = $_POST['portstart'];
$portend = $_POST['portend'];
if ($portend == "") { $portend = 0; }

$command = escapeshellcmd('python ../python/portscanner.py '.$ipaddress_hostname." ".$portstart." ".$portend." ".$scan_option);
$output = shell_exec($command);
echo $output;



?>