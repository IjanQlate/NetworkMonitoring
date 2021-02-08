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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css.css">
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
.dataTables_wrapper .myfilter .dataTables_filter {
    float:left
}
.dataTables_wrapper .mylength .dataTables_length {
    float:right
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
                <a href="networkping.php" class="nav-item nav-link">Ping</a>
                <a href="networktrace.php" class="nav-item nav-link active">Network Trace</a>
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
                        <button type="button" id="BtnTrace" class="btn btn-outline-primary">Trace</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <table id="" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Hop</th>
                                    <th>Host</th>
                                    <th>Hostname</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <pre class="anyClass" id="data_configuration">Output Command</pre> -->
            </form>
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
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    
    var table = $('#example').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        dom:"<'myfilter'f><'mylength'l>t"
    });


    $("#BtnTrace").on("click", function () {

        if ($("#hostaddress").val()) {

            $("#data_configuration").html("Running.......");
            $("#BtnTrace").text("Please wait...").attr("disabled", true);
            $("#modalspinner").modal("show");

            $.ajax({
                url: "database/networktrace.php",
                dataType: "text",
                type: "POST",
                data: {
                    "hostaddress": $("#hostaddress").val()
                },
                success: function (data_response) {

                    setTimeout(function() { 
                        $("#modalspinner").modal("hide");
                        if (data_response.indexOf("Unable to resolve target system name") >= 0) {
                            $("#modalmessage").modal("show");
                            $("#modalmsg").text(data_response);
                        } else {

                            // console.log(data_response);
                            // $("#data_configuration").html("#######################Result:#######################\n"+data_response);
                            $("#BtnTrace").text("Trace").attr("disabled", false);

                            $.ajax({
                                url: "database/savelog.php",
                                dataType: "text",
                                data: {
                                    "activity": "Network Trace",
                                    "result": data_response
                                },
                                type: "POST",
                                success: function(response) {
                                    console.log(response);
                                }
                            });


                            var fruits = [];
                            var ks = data_response.split("\n");

                            for (var i=0; i<ks.length; i++) {
                                if (i > 3 && i <ks.length-3 ) {
                                    fruits.push(ks[i]);
                                }
                                
                            }

                            var table;
                            tableBody = $("table tbody");
                            tableBody.empty();

                            $.each(fruits, function(index, value){
                                // console.log(index + ": " + value);
                                datasplit = value.split(" ");
                                console.log(datasplit);
                                console.log(datasplit.length);
                                if (datasplit.length == 25) {

                                    datasecond = datasplit[23].substring(1);
                                    datasecond = datasecond.slice(0, -1);
                                    table += "<tr><td>"+datasplit[2]+"</td><td>"+datasecond+"</td><td>"+datasplit[22]+"</td><td>"+datasplit[7]+" ms</td></tr>";
                                } else if (datasplit.length == 24) {
                                    if (datasplit[7] == "ms") { datatime = datasplit[6];  } else { datatime = datasplit[7];}
                                    if (datasplit[23] == "") { datahostname = datasplit[21]; } else { datahostname = datasplit[23]; }
                                    datasecond = datasplit[22].substring(1);
                                    datasecond = datasecond.slice(0, -1);
                                    table += "<tr><td>"+datasplit[2]+"</td><td>"+datasecond +"</td><td>"+datahostname+"</td><td>"+datatime+" ms</td></tr>";
                                } else if (datasplit.length == 23) {
                                    if (datasplit[7] == "ms") { datatime = datasplit[6];  } else { datatime = datasplit[7];}
                                    if (datasplit[20] == "") { datahostname = ""; } else { datahostname = datasplit[20]; }
                                    datasecond = datasplit[21].substring(1);
                                    datasecond = datasecond.slice(0, -1);
                                    table += "<tr><td>"+datasplit[2]+"</td><td>"+datasecond+"</td><td>"+datahostname+"</td><td>"+datatime+" ms</td></tr>";
                                }
                                
                            });
                            tableBody.append(table); 



                        }

                    }, 2000);

                }

            });

        } else {
            alert ("Please enter host address / name");
        }

    });

} );
</script>
</body>
</html>