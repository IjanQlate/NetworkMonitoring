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
                <a href="networkdevices.php" class="nav-item nav-link active">Network Devices</a>
                <a href="networkmonitor.php" class="nav-item nav-link">Network Monitor</a>
                <a href="networkportscanner.php" class="nav-item nav-link">Port Scanner</a>
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
        <div class="card-header" style="border: none;">
            <h4>Network Devices</h4> 
        </div>
        <div class="card-body" >
            <form>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Host Address / Name</label>
                    <div class="col-sm-10">
                        <select name="networkdevice" id="networkdevice"  class="js-example-basic-single input-lg" style="width: 100%">
                            <option value="">Select Host Address / Name</option>
                            <option value="IP Configuration">IP Configuration</option>
                            <option value="Bluetooth">Bluetooth</option>
                            <option value="Wi-Fi">Wi-Fi</option>
                            <option value="Local Area Connection">Local Area Connection</option>
                            <option value="Ethernet adapter Local Area Connection">Ethernet adapter Local Area Connection</option>
                        </select>
                    </div>
                </div>
            </form>
            <pre class="anyClass" id="data_configuration">Output Command</pre>
        </div>
        <div class="card-footer text-center">
            <span>Develop By Tineswaran A/L Balakrishen for Network Monitoring For Final Year Project OUM</span>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="modalmessage">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Response Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                <p id="modalmsg"></p>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();

    $("#networkdevice").change(function () {

        $.ajax({
            url: "database/networkdevice.php",
            dataType: "text",
            type: "POST",
            data: {
                "function": $("#networkdevice").val()
            },
            success: function (data_response) {
                // console.log(data_response)
                if (data_response == "") { 
                    $("#modalmessage").modal("show");
                    $("#modalmsg").text("No Data Available. Please try another host address/name");
                    $("#data_configuration").text("Output Command");
                } else {
                    var result = data_response.split("'")
                    var text;
                    // console.log(result)
                    var final_result = [];
                    for (i = 0; i < result.length; i++) {
                        var n = result[i].search(":");
                        var m = result[i].search("a");
                        if(n >0 || m>0){
                            final_result.push(result[i])                  
                        }
                        else {
                            console.log(result[i])
                        }
                    }
                    console.log(final_result);
                    var x = document.getElementById("data_configuration");
                    var sentence = final_result.join();
                    var text = sentence.split(","); 
                    var str = text.join('</br>'); 
                    $("#data_configuration").html(str)

                }               
            }
        })

        
        

    });

});
</script>
</body>
</html>