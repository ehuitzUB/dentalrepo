<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$patientName = $treatmentDescription = "";
$patientName_err = $treatmentDescription_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

         
    // Check if name is empty
    
     if(empty(trim($_POST["patientName"]))){
        $patientName_err = "Please Select Patient.";
    } else{
        $patientName = trim($_POST["patientName"]);
    }
    
    // Check if description is empty
    if(empty(trim($_POST["treatmentDescription"]))){
        $treatmentDecription_err = "Please enter Treatment Description.";
    } else{
        $treatmentDescription = trim($_POST["treatmentDescription"]);
    }
  

    if(empty($patientName_err) && empty($treatmentDescription_err)){

    $patientName = mysqli_real_escape_string($link, $_REQUEST['patientName']);
    $treatmentDescription = mysqli_real_escape_string($link, $_REQUEST['patientDescription']);
 
// Attempt insert query execution
    $sql = "INSERT INTO treatment (patientID, treatmentDesc) VALUES ('$patientName', '$treatmentDescription')";
    if(mysqli_query($link, $sql)){
        header("location:treatmentsDoctor.php");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
        //mysqli_close($link);
    }


        // Close connection
        //mysqli_close($link);
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Twinkling Smiles | Treatments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .table thead{
            background-color:#74D2C8;
        }
    </style>
</head>
<!-- navbar-->
<nav class="navbar navbar-light navbar-expand-sm fixed-top appointment-header" style="border-bottom: 0.7px dashed black; background-color: azure; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
    <a class="navbar-brand mr-auto" href="./dashboardDoctor.php">
        <img src="images/logo.png" height="50" width="130">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="Navbar">
        <div class="container  justify-content-md-end text-center justify-content-center">
            <ul class="navbar-nav" style="text-align: center;">
                <li class="nav-item text-black">
                    <a class="nav-link " href="./dashboardDoctor.php"><span class="fa fa-home fa-lg"></span>Home</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./patientsDoctor.php"><span class="fa fa-user-circle"></span>Patients</a>
                </li>
                <li class="nav-item active text-black">
                    <a class="nav-link" href="./treatmentsDoctor.php"><span class="fa fa-circle-o-notch"></span>Treatments</a>
                </li>
                <li class="nav-item text-black">
                    <a class="nav-link" href="./proceduresDoctor.php"><span class="fa fa-plus-square"></span>Procedures</a>
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

<body class="gray" style="background: url(./images/backgroungimg.png) no-repeat center fixed; background-size:cover;">
    <div class="container row-content">
        <!--welcome header bar-->
        <div class="row row-content d-flex justify-content-center">
            <h3>Treatments</h3>
            <div class="col-md-12 table-responsive">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createTreatment">Create Treatment</button>
                <!-- sql goes here -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Name</th>
                            <th>Date Begin</th>
                            <th>Date End</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- appointment body starts here -->
                        <?php
                        // Check connection
                        if ($link->connect_error) {
                            die("Connection failed: " . $link->connect_error);
                        }
                        $sql = "SELECT treatment.treatmentID AS tID, patient.patientID AS pID, 
                        concat(account.firstName, ' ',account.lastname) AS fullname, treatment.treatmentDesc as tDesc , DATE(treatment.treatmentDateBegin) AS tBegin, DATE(treatment.treatmentDateEnd) AS tEnd, treatment.treatmentStatus AS tStatus 
                        FROM treatment 
                        LEFT JOIN patient on patient.patientID=treatment.patientID
                        INNER JOIN account on account.accountID=patient.accountID";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>" .
                                    "<td>" . $row["tID"] . "</td>" .
                                    "<td>" . $row["tDesc"] . "</td>" .
                                    "<td>"  . $row["fullname"] . "</td>" .
                                    "<td>"  . $row["tBegin"] . "</td>" .
                                    "<td>"  . $row["tEnd"] . "</td>" .
                                    "<td>"  . $row["tStatus"] . "</td>" .
                                    "<td><a href = '.php?GetID=" . $row["tID"] . "'>Edit</a></td>" .
                                    "</tr>";
                            }
                        } else {
                            echo "0 results". mysqli_error($link);
                        }
                        //$link->close();
                        ?>
                    </tbody>
                </table>
                <!-- sql ends here -->
            </div>
        </div>
    </div>
      <!-- Create treatment Modal -->
    <div class="modal fade" id="createTreatment" tabindex="-1" role="dialog" aria-labelledby="createAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="createAppointmentLabel">Create Treatment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row"> 
                            <div class="col-12 text-center">              
                                <form action="treatmentsDoctor.php" method="post">
                                    <div class = "">
                                        <div>
                                            <label class="ml-3">Patient Name</label><br>
                                            <select name="patientName">
                                            <option></option>
                                            <?php
                                            if ($link->connect_error) {
                                                die("Connection failed: " . $link->connect_error);
                                            }
                                              $sqlpatient = "SELECT accountID, concat(firstName, ' ',lastname) AS fullname FROM account WHERE accountStatus='Active' AND accountType = '3' ";
                                              $results = $link->query($sqlpatient);
                                              if ($results->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $results->fetch_assoc()){
                                                    echo "<option value='".$row['accountID']."'>".$row['fullname']. "</option>";
                                                   
                                                    }
                                                } else {
                                                    echo "0 results";
                                                    }
                                                ?>
                                            </select>
                                        </div>    
                                        <div <?php echo (!empty($treatmentDescription_err)) ? 'has-error' : ''; ?>>
                                            <label class="ml-3">Treatment Descritpion</label>
                                            <input type="text" name="treatmentDescription" class="form-control ml-3">
                                            <span class="help-block"><?php echo $treatmentDescription_err; ?></span>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>  
                        </div> 
                    </div>
                </div>

                
                </div>
            </div>
        </div>
    </div>
<!-- modal end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>