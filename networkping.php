<?php 
include 'database/dbconfig.php'; 
if (empty($_SESSION['fullname'])){
  header("Location: http://localhost/NetworkMonitoring/index.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Network Monitoring</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.bs-example{
    margin: 20px;
}
pre {
    height:500px;
    overflow-y: auto;
    overflow-x: auto;
    background: black;
    color: #1CA6D1;
    padding: 9.5px;
    font-size: 14px;
}
.load-spinner .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(33% - 24px);
  }

  .load-spinner .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
  }
</style>
</head>
<body>
<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
        <a href="#" class="navbar-brand">Network Monitoring</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="remotecontrol.php" class="nav-item nav-link">Remote Control</a>
                <a href="networkdevices.php" class="nav-item nav-link">Network Devices</a>
                <a href="networkmonitor.php" class="nav-item nav-link">Network Monitor</a>
                <a href="networkportscanner.php" class="nav-item nav-link">Port Scanner</a>
                <a href="networkping.php" class="nav-item nav-link active">Ping</a>
                <a href="networktrace.php" class="nav-item nav-link">Network Trace</a>
                <a href="networklog.php" class="nav-item nav-link">Log</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
</div>
<div class="container">

    <div class="card">
        <div class="card-header" style="border: none;">
            <h4>Host Address / Name</h4> 
        </div>
        <div class="card-body" >
            <form>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Host Address / Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hostaddress" placeholder="Host Address / Name" name="hostaddress">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="BtnStartPing" class="btn btn-outline-primary">Ping</button>
                    </div>
                </div>
            </form>
            <pre class="anyClass" id="data_configuration">Output Command</pre>
        </div>
        <div class="card-footer text-center">
            <span>Develop By Tineswaran A/L Balakrishen for Network Monitoring For Final Year Project OUM</span>
        </div>
    </div>
</div>
<div class="modal fade load-spinner" id="modalspinner" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {

    $("#BtnStartPing").on("click", function () {

        if ($("#hostaddress").val()) {

            $("#data_configuration").html("Running.......");
            $("#BtnStartPing").text("Please wait...").attr("disabled", true);
            $("#modalspinner").modal("show");

            $.ajax({
                url: "database/ping.php",
                dataType: "text",
                type: "POST",
                data: {
                    "hostaddress": $("#hostaddress").val()
                },
                success: function (data_response) {

                    console.log(data_response);
                    setTimeout(function() { 
                        $("#modalspinner").modal("hide");
                        $("#data_configuration").html("#######################Result:#######################\n"+data_response);
                        $("#BtnStartPing").text("Ping").attr("disabled", false);
                    }, 2000);
                }

            });

        } else {
            alert ("Please enter host address / name");
        }

    });

});
</script>
</body>
</html>