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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <!-- navbar-->
    <nav class="navbar navbar-light navbar-expand-sm fixed-top appointment-header">
        <div class="container">     
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="#">
                <img src="images/logo.png" height="50" width="130">
            </a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link  text-white" href="./index.html"><span class="fa fa-home fa-lg"></span>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="#"><span class="fa fa-info fa-lg"></span>Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="#"><span class="fa fa-info fa-lg"></span>Treatments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="#"><span class="fa fa-address-card fa-lg"></span>Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><span class="fa fa-info fa-lg"></span>About Us</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a class="text-white" href="logout.php"> <span class="fa fa-sign-out"></span> Logout </a>
                </span>
          
            </div>
        </div>
    </nav>
    <body class="gray">
    <div class="container row-content">
        <!--welcome header bar-->
        <div class="row" style="background-color: red; margin: 0 0 10px 0;">
            <div class="col-md-4 col-sm-4">
                <h5>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
            </div>
            <div class="col-md-1  col-sm-1 offset-md-5 text-center">
                <p class="d-inline"><span></span> Events</p>
            </div>
            <div class="col-md-1 col-sm-1 text-center">
                <p class="d-inline"><span class=""></span> Messages</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-8" style="margin: 0 0 10px 0;">
                    <div class="row">
                        <div class="col-12 appointment-header">
                            <p class="d-inline">Your Appointments</p>
                            <a href="#">View all</a>
                        </div>
                        <div class="col-12 appointment-body">
                            <div class="row">
                                <!-- appointment body starts here -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        Appointment for <span>{USER_NAME}</span>
                                                    </p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="d-inline">
                                                        appointment name/details
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
                                                <div class="col-4">
                                                    <p class="d-inline">
                                                        Appointment for <span>{USER_NAME}</span>
                                                    </p>
                                                </div>
                                                <div class="col-8">
                                                    <p class="d-inline">
                                                        appointment name/details
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
                        <div class="col-12 appointment-header">
                            <p class="d-inline">Something</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>