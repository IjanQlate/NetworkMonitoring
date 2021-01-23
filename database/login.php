<?php
include 'dbconfig.php';

// Insert
if ($_POST['function'] == "login") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email_address = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            
            echo json_encode(array("status"=>"success", "message"=>"Valid your credentials."));        
            $_SESSION['table_userid'] = $row['id'];
            $_SESSION['email_address'] = $row['email_address'];
            $_SESSION['fullname'] = $row['fullname'];

        } else {
            echo json_encode(array("status"=>"failed", "message"=>"Invalid your credentials."));
        }   

    } else {
        echo json_encode(array("status"=>"failed", "message"=>"Your email address is not exist in system"));
    }
    $conn->close();

} else if ($_POST['function'] == "register") {

    $email      = strtolower(trim($_POST['email']));
    $password   = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $name       = ucwords(strtolower(trim($_POST['name'])));

    $sql = "SELECT * FROM users WHERE email_address = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows < 1) {
      // output data of each row
      $sql = "INSERT INTO users (email_address, password, fullname)
      VALUES ('$email', '$password', '$name')";
      
      if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status"=>"success", "message"=>"New record created successfully"));
      } else {
        echo json_encode(array("status"=>"failed", "message"=>"Error: " . $sql . "<br>" . $conn->error));
      }

    } else {
        echo json_encode(array("status"=>"failed", "message"=>"Your username already exist in system"));
    }
    $conn->close();



}