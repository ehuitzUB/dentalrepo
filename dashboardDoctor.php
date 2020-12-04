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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-sm fixed-top appointment-header"
    style="border-bottom: 0.7px dashed black; background-color: azure; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
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
                    <a class="nav-link" href="./patientsDoctor.php"><span
                            class="fa fa-user-circle"></span>Patients</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./treatmentsDoctor.php"><span
                            class="fa fa-circle-o-notch"></span>Treatments</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./proceduresDoctor.php"><span
                            class="fa fa-plus-square"></span>Procedures</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./reportsDoctor.php"><span class="fa fa-bar-chart"></span>Reports</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./logout.php"><span class="fa fa-sign-out"></span> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row row-content text-center"> 
        <div class="col-md-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Procedure</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                   <!-- appointment body starts here -->
            <?php
            // Check connection
            if ($link->connect_error) {
              die("Connection failed: " . $link->connect_error);
            }
            $sql = "SELECT appointment.appointmentID AS aID, appointment.treatmentID AS atID, appointment.appointmentDate AS aDate, appointment.appointmentTime AS aTime, appointment.appointmentStatus as aStatus FROM appointment";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr>" .
                  "<td>" . $row["aID"] . "</td>" .
                  "<td>" . $row["atID"] . "</td>" .
                  
                  "<td>"  . $row["tp"] . "</td>" .
                  "<td>"  . $row["aDate"] . "</td>" .
                  "<td>"  . $row["aTime"] . "</td>" .
                  "<td>"  . $row["aStatus"] . "</td>" .
                  "<td><a href = '.php?GetID=" . $row["accID"] . "'>Edit</a></td>" .
                  "<td><a class=\"btn btn-danger\" >Edit</a></td>" .
                  "</tr>";
              }
            } else {
              echo "0 results";
            }
            //  $link->close();
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="footer" style="position: absolute; bottom: 0px; width: 100%;">
    <div class="container">
        <div class="row justify-content-center">
            <p>Copyright &copy; 2020 Twinkly Smiles Dentistry </p>
        </div>
    </div>
</footer>
<!--footer ends-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
<script type="text/javascript"
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>