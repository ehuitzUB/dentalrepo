<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
require_once "config.php";

$patientFName = $patientLName = $patientPhone = $patientDOB =$password= "";
$patientFName_err = $patientLName_err = $patientPhone_err = $patientDOB_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // Check if FName is empty

  if (empty(trim($_POST["patientFName"]))) {
    $patientFName_err = "Please enter First Name.";
  } else {
    $patientFName = trim($_POST["patientFName"]);
  }

  // Check if LName is empty
  if (empty(trim($_POST["patientLName"]))) {
    $patientLName_err = "Please enter Last Name.";
  } else {
    $patientLName = trim($_POST["patientLName"]);
  }
  // Check if phone is empty
  if (empty(trim($_POST["patientPhone"]))) {
    $patientPhone_err = "Please enter Phone.";
  } else {
    $patientPhone = trim($_POST["patientPhone"]);
  }
  // Check if phone is empty
  if (empty(trim($_POST["patientDOB"]))) {
    $patientDOB_err = "Please enter DOB.";
  } else {
    $patientDOB = trim($_POST["patientDOB"]);
  }

  if (empty($patientFName_err) && empty($patientLName_err)) {

    $patientFName = mysqli_real_escape_string($link, $_REQUEST['patientFName']);
    $patientLName = mysqli_real_escape_string($link, $_REQUEST['patientLName']);
    $patientPhone = mysqli_real_escape_string($link, $_REQUEST['patientPhone']);
    $patientDOB = mysqli_real_escape_string($link, $_REQUEST['patientDOB']);
    $password = mysqli_real_escape_string($link, $_REQUEST['userpasswd']);
    $patient_password = password_hash($password, PASSWORD_DEFAULT);
    //$patientUserName=strtolower($patientFName[0,2].$patientLName[0,2]);
 
// Attempt insert query execution
    $sql = "INSERT INTO account (firstname, lastname, telephone, accountType, DOB) VALUES ('$patientFName', '$patientLName', '$patientPhone', 3, '$patientDOB');SELECT @last := LAST_INSERT_ID();INSERT INTO patient (accountID) VALUES (@last); INSERT INTO users (username, password) VALUES ('$patientUserName', '$patient_password'); SELECT @userid := LAST_INSERT_ID(); UPDATE account SET loginID=@userid WHERE accountID=@last;";
    if(mysqli_multi_query($link, $sql)){
        header("location:patientsDoctor.php");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
        //mysqli_close($link);
    }
    //mysqli_close($link);

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
  <title>Twinkling Smiles | Patients</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<!-- navbar-->

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
    <!--welcome header bar-->
    <div class="row row-content d-flex justify-content-center">
      <h5>Patients</h5>
      <div class="col-md-12 table-responsive">
      <button class="btn btn-primary" data-toggle="modal" data-target="#createPatients">Create Patient</button>
        <table class="table text-center">
          <caption></caption>
          <theader>
            <tr>
              <th>Patient ID</th>
              <th>Patient Name</th>
              <th>Patient Telephone</th>
              <th>Patient DOB</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </theader>
          <tbody>
            <!-- appointment body starts here -->
            <?php
            // Check connection
            if ($link->connect_error) {
              die("Connection failed: " . $link->connect_error);
            }
            $sql = "SELECT patient.accountID as accID, concat(account.firstName, ' ',account.lastname) AS fullname, account.telephone AS tp, account.DOB as dateb FROM account LEFT JOIN patient ON patient.accountID=account.accountID WHERE account.accountType=3 AND account.accountStatus= 'Active'";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr>" .
                  "<td>" . $row["accID"] . "</td>" .
                  "<td>" . $row["fullname"] . "</td>" .
                  "<td>"  . $row["tp"] . "</td>" .
                  "<td>"  . $row["dateb"] . "</td>" .
                  "<td><a href = 'editPatientsDoctor.php?GetID=" . $row["accID"] . "'>Edit</a></td>" .
                  "<td><a class=\"btn btn-danger\" onclick=\"deletePatient(" . $row["accID"] . ")\">Delete</a></td>" .
                  "</tr>";
              }
            } else {
              echo "0 results";
            }
            //  $link->close();
            ?>
          </tbody>
        </table>
        <div class="alert_window">
          <div id="delete_patient_success" class="alert alert-success" role="alert">
          </div>
          <div id="delete_patient_failure" class="alert alert-danger" role="alert">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Create Patients Modal -->
<div class="modal fade" id="createPatients" tabindex="-1" role="dialog" aria-labelledby="createPatientsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPatientsLabel">Create Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" action="patientsDoctor.php" method="post">
            <div class="form-group">
              <label class="ml-3">Patient First Name</label>
              <input type="text" name="patientFName" class="form-control ml-3">
              <span class="help-block"><?php echo $patientFName_err; ?></span>
            </div>
            <div class="form-group" <?php echo (!empty($patientLName_err)) ? 'has-error' : ''; ?>>
              <label class="ml-3">Patient Last Name</label>
              <input type="text" name="patientLName" class="form-control">
              <span class="help-block"><?php echo $patientLName_err; ?></span>
            </div>
            <div class="form-group"<?php echo (!empty($patientPhone_err)) ? 'has-error' : ''; ?>>
              <label class="ml-3">Patient Phone</label>
              <input type="text" name="patientPhone" class="form-control">
              <span class="help-block"><?php echo $patientPhone_err; ?></span>
            </div>
            <div class="form-group"<?php echo (!empty($patientDOB_err)) ? 'has-error' : ''; ?>>
              <label class="ml-3">Patient DOB</label>
              <input type="text" name="patientDOB" class="form-control">
              <span class="help-block"><?php echo $patientDOB_err; ?></span>
            </div>
            <div>
              <label class="ml-3">User Password</label>
              <input type="text" name="userpasswd" class="form-control">
              <span class="help-block"></span>
            </div>
            <div>
              <label class="ml-3">Confirm Password</label>
              <input type="text" name="confirmuserpasswd" class="form-control">
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
<!-- modal end -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="controller/patients.js"></script>
</body>
</html>