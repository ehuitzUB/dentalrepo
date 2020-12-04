<?php 
session_start();
include_once "../config.php";
$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "delete") {
  deletePatient($link, mysqli_real_escape_string($link, $_POST["id"]));
} else if ($action == "addPatient") {
  $patient = mysqli_real_escape_string($link, $_POST["bucket"]);
  addPatient($link, $patient);
}

function deletePatient($link, $id) {
  $data["state"] = "success";
  
  $sql = "UPDATE account SET account.accountStatus = \"Inactive\" WHERE account.accountID = $id;";
  if(mysqli_query($link, $sql)){
    $data["state"] = "success";
    $data["message"] = "Account $id has been deleted.";
  } else {
    $data["state"] = "error";
    $data["message"] = "An error occured while trying to delete account $id";
  }
  echo json_encode($data);
}




function addPatient($link, $patient){
  $data = [];
  $sql = "INSERT INTO account (firstname, lastname, telephone, accountType, DOB) VALUES (\'".$patient['patientFName']."\', \'".$patient["patientLName"]."\', \'".$patient["patientPhone"]."\', 3, \'".$patient["patientDOB"]."\');";
  if(mysqli_query($link, $sql)){
    $accid = mysqli_insert_id($link);
    $sql = "INSERT INTO patient (accountID) VALUES ($accid);";
    if(mysqli_query($link, $sql)){
      $password = password_hash($patient['userpasswd'], PASSWORD_DEFAULT);
      $username = substr($patient["patientFName"], 0, 3) . substr($patient["patientLName"], 0, 3);
      $sql = "INSERT INTO users (username, password) VALUES ($username, $password);";
      if (mysqli_query($link, $sql)) {
        $logid = mysqli_insert_id($link);
        $sql = "UPDATE account set loginID=$logid where accountID = $accid";
        if(mysqli_query($link, $sql)) {
          $data["state"] = "success";
        } else {
          $data["errors"] = "Added account, inserted patient and inserted login credentials but failed to update account with proper login";
          $data["state"] = "failure";
        }
      } else {
        $data["errors"] = "Added account, inserted patient but failed to insert login credentials and failed to update account with proper login";
        $data["state"] = "failure";
      }
    } else {
      $data["errors"] = "Added account but failed to insert patient, failed to insert login credentials and failed to update account with proper login";
      $data["state"] = "failure";
    }
  } else {
    $data["errors"] = "Failed to add account, failed to insert patient, failed to insert login credentials and failed to update account with proper login";
    $data["state"] = "failure";
  }
  echo json_encode($data);
}
?>