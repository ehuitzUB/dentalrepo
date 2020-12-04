<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";

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
        <style>
            .appointment-calendar-style{
                background-color: rgb(182, 248, 248);
                border-radius: 20%;
            }
            .appointment-btn{
                font-size: small;
                border-radius: 50%;
            }
        </style>
    </head>
<body>
<nav class="navbar navbar-light navbar-expand-sm fixed-top appointment-header" style="border-bottom: 0.7px dashed black; background-color: azure; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">        
    <a class="navbar-brand mr-auto" href="./dashboardClient.php">
        <img src="images/logo.png" height="50" width="130">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="Navbar">
        <div class="container  justify-content-md-end text-center justify-content-center">
        <ul class="navbar-nav" style="text-align: center;">
            <li class="nav-item active">
                <a class="nav-link e" href="./dashboardClient.php"><span class="fa fa-home fa-lg"></span>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><span class=""></span>Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./logout.php"><span class=""></span>Logout</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
        
<div class="container">
    <div class="row row-content">
        <div class="col-md-12 table-responsive">
            <!-- Table Start -->
            <h3 class="h3 text-center">Appointments</h3>
            <table class="table text-center" style="font-size: small;"> 
                <thead class="thead-dark">
                    <tr>
                        <th>AppID</th>
                        <th>TreatID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- appointment body starts here -->
                        <?php
                            // Check connection
                            if ($link->connect_error) {
                            die("Connection failed: " . $link->connect_error);
                            }
                            $sql = "SELECT appointment.appointmentID AS appID, concat(account.firstName, ' ',account.lastname) AS fullname, appointment.appointmentDate AS appDate, appointment.appointmentTime AS appTime, appointment.appointmentStatus AS appStatus 
                            FROM appointment
                            LEFT JOIN treatment ON treatment.treatmentID=appointment.treatmentID
                            LEFT JOIN patient ON patient.patientID=treatment.patientID
                            LEFT JOIN account ON account.accountID=patient.accountID
                            LEFT JOIN users ON users.loginID=account.loginID
                            WHERE users.username = '".$_SESSION["username"]."' 
                            AND appointment.appointmentStatus = 'Open'
                            ORDER BY appointment.appointmentDate ASC, appointment.appointmentTime ASC";
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                            echo "<tr>".
                            "<td>" . $row["appID"]. "</td>".
                            "<td>" . $row["fullname"] . "</td>".
                            "<td>"  . $row["appDate"]. "</td>".
                            "<td>"  . $row["appTime"]. "</td>".
                            "<td>"  . $row["appStatus"]. "</td>".

                            "<td><a class=\"btn btn-danger\" onclick=\"cancelAppointmentDoctor(" . $row["appID"] . ")\" >Cancel</a></td>" .
                            "</tr>";
                            }
                            } else { echo "0 results"; }
                            $link->close();
                        ?>
                    </tr>
                </tbody>
            </table>
            <!-- Table End-->
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
</script>
<script src="controller/treatments.js"></script>
</body>
</html>