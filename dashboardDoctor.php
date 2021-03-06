<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $treatmentID = mysqli_real_escape_string($link, $_REQUEST['patienttreatment']);
  $appointmentDate = mysqli_real_escape_string($link, $_REQUEST['appDate']);
  $appointmentTime = mysqli_real_escape_string($link, $_REQUEST['appTime']);
  $appointmentComments = mysqli_real_escape_string($link, $_REQUEST['appComments']);


  $sql = "INSERT INTO appointment (treatmentID, appointmentDate, appointmentTime, appointmentComments) VALUES ('$treatmentID', '$appointmentDate', '$appointmentTime ', '$appointmentComments' )";
    if(mysqli_query($link, $sql)){
        header("location:dashboardDoctor.php");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
        //mysqli_close($link);
    }


        // Close connection
        //mysqli_close($link);
    


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Twinkling Smiles | Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/main.css">
</head>

<body style="background: url(./images/backgrounddash.png) no-repeat center fixed; background-size:cover;">
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
  <div class="container">
    <div class="row row-content d-flex justify-content-center">
      <div class="col-md-12"><h4 class="d-block">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h4> <br></div>
      <h3 class="d-block">Appointments for Today</h3>
      <div class="col-md-12 table-responsive">
        <button class="btn btn-primary" data-toggle="modal" data-target="#createAppointment">Create Appointment</button>
        <table class="table text-center">
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
            $sql = "SELECT appointment.appointmentID AS aID,  concat(account.firstName, ' ',account.lastname) AS fullname, appointment.appointmentComments AS aComments, appointment.appointmentDate AS aDate, appointment.appointmentTime AS aTime, appointment.appointmentStatus as aStatus 
            FROM appointment 
            LEFT JOIN treatment ON treatment.treatmentID=appointment.treatmentID
            LEFT JOIN patient ON patient.patientID=treatment.patientID
            LEFT JOIN account ON account.accountID=patient.accountID
            WHERE appointment.appointmentStatus = 'Open'
            ORDER BY appointment.appointmentDate ASC, appointment.appointmentTime ASC ";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr>" .
                  "<td>" . $row["aID"] . "</td>" .
                  "<td>" . $row["fullname"] . "</td>" .
                  "<td>"  . $row["aComments"] . "</td>" .
                  "<td>"  . $row["aDate"] . "</td>" .
                  "<td>"  . $row["aTime"] . "</td>" .
                  "<td>"  . $row["aStatus"] . "</td>" .
                  "<td><a href = '.php?GetID=" . $row["aID"] . "'>Edit</a></td>" .
                  "<td><a class=\"btn btn-danger\" onclick=\"cancelAppointmentDoctor(" . $row["aID"] . ")\" >Cancel</a></td>" .
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

    <div class="alert_window">
      <div id="cancel_appointment_success" class="alert alert-success show" role="alert">
      </div>
      <div id="cancel_appointment_failure" class="alert alert-danger show" role="alert">
      </div>
    </div>
    <!-- Create Patients Modal -->
    <div class="modal fade" id="createAppointment" tabindex="-1" role="dialog" aria-labelledby="createAppointmentLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="createAppointmentLabel">Create Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <form class="form" action="dashboardDoctor.php" method="post">
              <div class="form-group">
                <label class="ml-3">Patient - Treatment</label>
                <select name="patienttreatment" id="treatmentIDvalue">
                  <option></option>
                  <?php
                  if ($link->connect_error) {
                    die("Connection failed: " . $link->connect_error);
                  }
                  $sqlpatient = "SELECT treatment.treatmentID, concat(account.firstName, ' ',account.lastname) AS fullname, treatment.treatmentDesc FROM treatment LEFT JOIN patient ON patient.patientID=treatment.treatmentID LEFT JOIN account ON account.accountID=patient.accountID ";
                  $results = $link->query($sqlpatient);
                  if ($results->num_rows > 0) {
                    // output data of each row
                    while ($row = $results->fetch_assoc()) {
                      echo "<option value='" . $row['treatmentID'] . "'>" . $row['fullname'] . " - " . $row['treatmentDesc'] . "</option>";
                    }
                  } else {
                    echo "0 results";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label class="ml-3">AppointmentDate</label>
                <input type="text" name="appDate" class="form-control ml-3">
                <span class="help-block"></span>
              </div>
              <div class="form-group">
                <label class="ml-3">Appointment Time</label>
                <input type="time" name="appTime" class="form-control ml-3 " step="2" min="8:00" max="17:00">
                <span class="help-block"></span>
              </div>
              <div class="form-group">
                <label class="ml-3">Appointment Comments</label>
                <input type="text" name="appComments" class="form-control ml-3">
                <span class="help-block"></span>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- modal end -->
    <!--footer ends-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="controller/treatments.js"></script>
</body>

</html>