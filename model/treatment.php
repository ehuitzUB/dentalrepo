<?php 
session_start();
include_once "../config.php";
$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "cancelAppointment"){
  cancelAppointment($link, mysqli_real_escape_string($link, $_POST["id"]));
}

function cancelAppointment($link, $id){
  $data["state"] = "success";
  $sql = "UPDATE appointment SET appointmentStatus = \"Close\" WHERE appointmentID = $id;";
  if(mysqli_query($link, $sql)){
    $data["state"] = "success";
    $data["message"] = "Appointment $id has been deleted.";
  } else {
    $data["state"] = "error";
    $data["message"] = "An error occurred while trying to delete appointment #$id.";
  }
  echo json_encode($data);
}
?>
