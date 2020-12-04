<?php 
session_start();
include_once "../config.php";
$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "delete") {
  deletePatient($link, mysqli_real_escape_string($link, $_POST["id"]));
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
?>