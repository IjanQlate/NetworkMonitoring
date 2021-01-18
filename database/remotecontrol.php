<?php
// echo "hey";
$command = escapeshellcmd('python ../python/logout.py');
// $command = escapeshellcmd('python get_tmsoa.py '.$_POST['service_number']);
$output = shell_exec($command);
echo $output;

?>
