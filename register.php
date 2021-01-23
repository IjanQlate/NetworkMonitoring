<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Monitoring</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme9.css">
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Network Monitoring</h3>
                    <p>Access to the most powerfull tool in the entire design and web industry.</p>
                    <img src="images/graphic5.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="index.html">
                                <div class="logo">
                                    <!-- <img class="logo-size" src="images/logo-light.svg" alt=""> -->
                                </div>
                            </a>
                        </div>
                        <div class="page-links">
                            <a href="index.php">Login</a><a href="register.php" class="active">Register</a>
                        </div>
                        <form id="formRegister" action="database/login.php" method="Post">
                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                            <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="BtnRegister" type="button" class="ibtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- Jquery validate -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
// Call the dataTables jQuery plugin
$(document).ready(function() {

    var form = $("#formRegister");
    form.validate();

    $("#BtnRegister").on("click", function() {

        if (form.valid()) {
  
            $.ajax({
                url: form.attr("action"),
                dataType: "json",
                type: form.attr("method"),
                data: form.serialize()+"&function=register",
                success: function(dataresponse) {

                    console.log(dataresponse);
                    alert (dataresponse.message);
                    if (dataresponse.status == "success") {
                        window.location.replace("http://localhost/NetworkMonitoring/");
                    }

                }
            });

        }

    });

});
</script>
</body>
</html>