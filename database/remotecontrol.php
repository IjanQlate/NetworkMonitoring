<?php

$ipaddress = $_POST['ipaddress'];

if ($_POST['function'] == "Shutdown") {

    $command = escapeshellcmd('python ../python/remotecontrol/shutdown.py '.$ipaddress);
    $output = shell_exec($command);
    echo $output;

} else if ($_POST['function'] == "Restart") {

    $command = escapeshellcmd('python ../python/remotecontrol/restart.py '.$ipaddress);
    $output = shell_exec($command);
    echo $output;

} else if ($_POST['function'] == "Log Off") {

    $command = escapeshellcmd('python ../python/remotecontrol/logout.py');
    $output = shell_exec($command);
    echo $output;

} else if ($_POST['function'] == "Abort") {

    $command = escapeshellcmd('python ../python/remotecontrol/abort.py '.$ipaddress);
    $output = shell_exec($command);
    echo $output;

}

?>
