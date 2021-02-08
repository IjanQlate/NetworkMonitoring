<?php

include 'dbconfig.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

$id = $_POST['iddisplay'];

$sql = "SELECT * FROM log WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();

    $fileName = "../log/".$row["logfile"];
    echo readfile($fileName);

} else {
  echo "0 results";
}
$conn->close();

?>