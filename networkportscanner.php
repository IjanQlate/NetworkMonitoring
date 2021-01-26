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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
body {background-color: #def3fa;}    
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
                <a href="networkportscanner.php" class="nav-item nav-link active">Port Scanner</a>
                <a href="networkping.php" class="nav-item nav-link">Ping</a>
                <a href="networktrace.php" class="nav-item nav-link">Network Trace</a>
                <a href="networklog.php" class="nav-item nav-link">Log</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="index.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>
</div>
<div class="container">


<div class="card">
  <div class="card-body" >
    <h4>Port Scanner</h4> 
    <div class="form-group row">
        <div class="col-sm-12">
            <form class="form-inline">
                <label for="text" class="mr-sm-2">Input Destination IP Address / Host Name:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Input Destination IP Address / Host Name" id="ipaddress_hostname">
                <label for="text" class="mr-sm-2">Option:</label>
                    <select name="scan_option" id="scan_option" class="form-control mb-2 mr-sm-2">
                        <option value="">Select Option</option>
                        <option value="Single">Single Port</option>
                        <option value="Range">Range Port</option>
                    </select>
            </form>
        </div>
        <div class="col-sm-12">
            <form class="form-inline">
                <label for="text" class="mr-sm-2">Port Start:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Port Start" id="portstart" readonly>
                <label for="text" class="mr-sm-2">Port End:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Port End" id="portend" readonly>
                <button type="button" id="BtnScan" class="btn btn-outline-primary mb-2" disabled>Scan Port</button>
            </form>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
        <pre class="anyClass" id="data_configuration">Output Command</pre>
        </div>
    </div>
  </div>
  <div class="card-footer text-center">
            <span>Develop By Tineswaran A/L Balakrishen for Network Monitoring For Final Year Project OUM</span>
  </div>
</div>
<div class="modal fade load-spinner" id="modalspinner" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {

    $("#scan_option").on("change", function() {
        if ($("#scan_option").val() == "Single") {
            $("#portstart").val("").attr("readonly", false);
            $("#portend").val("").attr("readonly", true);
            $("#BtnScan").text("Scan Port").attr("disabled", false);
        } else if ($("#scan_option").val() == "Range") {
            $("#portstart").val("").attr("readonly", false);
            $("#portend").val("").attr("readonly", false);
            $("#BtnScan").text("Scan Port").attr("disabled", false);
        } else {
            $("#portstart").val("").attr("readonly", true);
            $("#portend").val("").attr("readonly", true);
            $("#BtnScan").text("Scan Port").attr("disabled", true);
        }
    });


    $("#BtnScan").on("click", function () {

        if ($("#ipaddress_hostname").val()) {

            if ($("#scan_option").val()) {

                if ($("#scan_option").val() == "Single" && $("#portstart").val() == "") {
                    alert ("Please insert Port Start");
                } else if ($("#scan_option").val() == "Range" && $("#portstart").val() == "" && $("#portend").val() == "") {
                    alert ("Please insert Port Start & Port End");
                } else {

                    $("#data_configuration").html("Running.......");
                    $("#BtnScan").text("Please wait...").attr("disabled", true);

                    $("#modalspinner").modal("show");

                    $.ajax({
                        url: "database/networkportscanner.php",
                        dataType: "text",
                        type: "POST",
                        data: {
                            "ipaddress_hostname": $("#ipaddress_hostname").val(),
                            "scan_option": $("#scan_option").val(),
                            "portstart": $("#portstart").val(),
                            "portend": $("#portend").val()
                        },
                        success: function (data_response) {

                            console.log(data_response);

                            setTimeout(function() { 
                                $("#modalspinner").modal("hide");
                                $("#data_configuration").html("#######################Result:#######################\n\n"+data_response);
                                $("#BtnScan").text("Scan Port").attr("disabled", false);
                            }, 2000);

                        }

                    });

                }

            } else {
                alert ("Please select option");
            }

        } else {
            alert ("Please enter the ip address / host name");
        }

    });

});
</script>
</body>
</html>