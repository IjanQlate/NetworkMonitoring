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
    float:right
}
.dataTables_wrapper .mylength .dataTables_length {
    float:left
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
                <a href="networkmonitor.php" class="nav-item nav-link active">Network Monitor</a>
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
            <h4>Network Monitor</h4> 
            <div class="form-group row">
                <div class="col-sm-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Activity</th>
                                <th>Log File</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <span>Develop By for OUM PROJECT</span>
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
    $('#example').DataTable({
        "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    dom:"<'myfilter'f><'mylength'l>t"
    });
} );
</script>
</body>
</html>