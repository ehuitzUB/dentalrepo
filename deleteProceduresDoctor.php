<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$procedureID = $_GET['GetID'];
$deletesql = "DELETE FROM procedures WHERE procedureID= '$procedureID'";
$result = mysqli_query($link,$deletesql);

if(mysqli_query($link, $deletesql)){
    header("location: proceduresDoctor.php");
} else{
    echo "ERROR: Could not able to execute $deletesql. " . mysqli_error($link);
}
?>
