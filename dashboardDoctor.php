<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Twinkling Smiles | Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        <nav class="navbar navbar-light navbar-expand-sm fixed-top appointment-header" style="border-bottom: 0.7px dashed black; background-color: azure; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">        
            <a class="navbar-brand mr-auto" href="#">
                <img src="images/logo.png" height="50" width="130">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="Navbar">
                <div class="container  justify-content-md-end text-center justify-content-center">
                <ul class="navbar-nav" style="text-align: center;">
                    <li class="nav-item active text-black">
                        <a class="nav-link " href="./dashboardDoctor.php"><span class="fa fa-home fa-lg"></span>Home</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link" href="./patientsDoctor.php"><span class="fa fa-user-circle"></span>Patients</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link" href="./treatmentsDoctor.php"><span class="fa fa-circle-o-notch"></span>Treatments</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./proceduresDoctor.php"><span class="fa fa-plus-square"></span>Procedures</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./reportsDoctor.php"><span class="fa fa-bar-chart"></span>Reports</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./logout.php"><span class="fa fa-sign-out"></span> Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <body>
    <div class="container">
        <!--welcome hea der bar-->
        <div class="row row-content">
            <div class="col-md-4 col-sm-4">
                <h5>Welcome, <span>{USER_NAME}</span></h5>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-8" style="margin: 0 0 10px 0;">
                    <div class="row">
                        <div class="col-md-10 appointment-header" style="background-color: #01a97c; color: white;">
                            <p class="d-inline">Appointments</p>
                            
                        </div>
                        <div class="col-md-2" style="background-color: #01a97c; color: white;"><a href="#">View all</a></div>
                        <div class="col-12 appointment-body">
                            <div class="row">
                                <!-- appointment body starts here -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4" >
                                                    <p class="d-inline">
                                                        <span>{USER_NAME}</span>
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment time
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- appointment body ends here -->
                                <!-- appointment body starts here -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4" >
                                                    <p class="d-inline">
                                                        <span>{USER_NAME}</span>
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment time
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- appointment body ends here -->                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3 offset-md-1 appointment-body">
                <div class="row">
                        <div class="col-md-12 appointment-header" style="background-color: #01a97c; color: white;">
                            <p class="d-inline">Appointments</p>
                            
                        </div>
                        <div class="col-12 appointment-body">
                            <div class="row">
                                <!-- appointment body starts here -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4" >
                                                    <p class="d-inline">
                                                        <span>{USER_NAME}</span>
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment time
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        appointment details
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- appointment body ends here -->
                </div>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>