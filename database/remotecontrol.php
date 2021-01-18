<?php
// echo "hey";
$command = escapeshellcmd('python ../python/logout.py');
$output = shell_exec($command);
echo $output;

?>
