<?php

include 'dbconfig.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
$email_add = $_SESSION['email_address'];

$activity = $_POST['activity'];
$datetime = date("Y-m-d h-i-s-a");
$logfile = $_POST['activity']."_".$datetime.".txt";

$result = $_POST['result'];


$sql = "INSERT INTO log (activity, logfile, date_time, user)
VALUES ('$activity', '$logfile', NOW(), '$email_add')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$myfile = fopen("../log/".$logfile, "w") or die("Unable to open file!");
fwrite($myfile, $result);
fclose($myfile);