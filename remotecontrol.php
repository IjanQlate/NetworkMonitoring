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
                <a href="remotecontrol.php" class="nav-item nav-link active">Remote Control</a>
                <a href="networkdevices.php" class="nav-item nav-link">Network Devices</a>
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
  <div class="card-header" style="border: none;"><h4>Remote Controller</h4> </div>
  <div class="card-body" >

    <form>
        <div class="form-row">
            <div class="col">
                <select name="" id=""  class="js-example-basic-single input-lg" style="width: 100%">
                    <option value="">Select Remote Controller</option>
                    <option value="Shutdown">Shutdown</option>
                    <option value="Restart">Restart</option>
                    <option value="Log Off">Log Off</option>
                    <option value="Abort">Abort</option>
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" id="email" placeholder="Input Destination IP Address and choose remote command" name="email">
            </div>
            <div class="col">
                <button type="button" class="btn btn-outline-primary">Remote Command</button>
            </div>
        </div>
    </form>

  </div>
  <div class="card-footer">
    <pre class="anyClass" id="data_configuration">Output Command</pre>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
</body>
</html>