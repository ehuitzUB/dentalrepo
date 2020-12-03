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

$pID = $_GET['GetID'];
$sql = "SELECT procedureID, procedureName, procedureDescription, procedureCost FROM procedures WHERE procedureID= '".$pID."'";
$result = mysqli_query($link,$sql);

while($row=mysqli_fetch_assoc($result)){
    $proID=$row['procedureID'];
    $proName=$row['procedureName'];
    $proDesc=$row['procedureDescription'];
    $proCost=$row['procedureCost'];
}
$procedureName = $procedureDescription = $procedureCost = $procedureID = "";
$procedureName_err = $procedureDecription_err = $procedureCost_err = $procedureID_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

         
   
    // Check if name is empty
    
     if(empty(trim($_POST["procedureName"]))){
        $procedureName_err = "Please enter Procedure Name.";
    } else{
        $procedureName = trim($_POST["procedureName"]);
    }
    
    // Check if description is empty
    if(empty(trim($_POST["procedureDescription"]))){
        $procedureDecription_err = "Please enter Procedure Description.";
    } else{
        $procedureDescription = trim($_POST["procedureDescription"]);
    }
    // Check if cost is empty
    if(empty(trim($_POST["procedureCost"]))){
        $procedureCost_err= "Please enter Procedure Cost.";
    } else{
        $procedureCost= trim($_POST["procedureCost"]);
    }

    if(empty($procedureCost_err) && empty($procedureName_err)){

    $procedureID = mysqli_real_escape_string($link, $_REQUEST['procedureID']);
    $procedureName = mysqli_real_escape_string($link, $_REQUEST['procedureName']);
    $procedureDescription = mysqli_real_escape_string($link, $_REQUEST['procedureDescription']);
    $procedureCost = mysqli_real_escape_string($link, $_REQUEST['procedureCost']);
 
// Attempt insert query execution
    $updatesql = "UPDATE procedures SET procedureName = '".$procedureName."' , procedureDescription =  '".$procedureDescription."', procedureCost =  '".$procedureCost."' procedureID= '".$pID."'";
    if(mysqli_query($link, $updatesql)){
        header("location:proceduresDoctor.php");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
        mysqli_close($link);
    }


        // Close connection
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Twinkling Smiles | Procedures</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <!-- navbar-->
    <nav class="navbar navbar-light navbar-expand-sm fixed-top">
        <div class="container">     
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="#">
                <img src="images/logo.png" height="50" width="130">
            </a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto" >
                    <li class="nav-item  text-black">
                        <a class="nav-link " href="./dashboardDoctor.php"><span class="fa fa-home fa-lg"></span>Home</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link " href="./appointmentsDoctor.php"><span class="fa fa-calendar"></span>Appointments</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link" href="./patientsDoctor.php"><span class="fa fa-user-circle"></span>Patients</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link" href="./treatmentsDoctor.php"><span class="fa fa-circle-o-notch"></span>Treatments</a>
                    </li>
                    <li class="nav-item active text-black">
                        <a class="nav-link"  href="./proceduresDoctor.php"><span class="fa fa-plus-square"></span>Procedures</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./reportsDoctor.php"><span class="fa fa-bar-chart"></span>Reports</a>
                    </li>
                </ul>
                <span class="navbar-text ">
                <a class="text-black" href="logout.php" > <span class="fa fa-sign-out"></span> Logout </a>
                </span>
          
            </div>
        </div>
    </nav>
    <body class="gray">
    <div class="container row-content">
        <!--welcome header bar-->
        <div class="row" >
            <div class="col-md-4 col-sm-4">
                <h5>Procedures</h5>
            </div>
            
        </div>
        <div class="container">
            <div class="row">
               
                <div class="col-md-4 col-sm-3 offset-md-1 appointment-body">
                    <div class="row">
                        <div class="col-12 appointment-header intro">
                            <p class="d-inline">Create Procedure</p>

                               
                        </div>
                        <div class="row"> 
                            <div class="col-12">              
                                <form action="proceduresDoctor.php" method="post">
                                    <div class = "">
                                    <div>
                    
                                        <div>
                                            <label>Procedure Name</label>
                                            <input type="text" name="procedureName" class="form-control" value="<?php echo $proName; ?>">
                                            <span class="help-block"><?php echo $procedureName_err; ?></span>
                                        </div>    
                                        <div <?php echo (!empty($procedureDescription_err)) ? 'has-error' : ''; ?>>
                                            <label>Procedure Description</label>
                                            <input type="text" name="procedureDescription" class="form-control" value="<?php echo $proDesc; ?>">
                                            <span class="help-block"><?php echo $procedureDecription_err; ?></span>
                                        </div>
                                        <div <?php echo (!empty($procedureCost_err)) ? 'has-error' : ''; ?>>
                                            <label>Procedure Cost</label>
                                            <input type="text" name="procedureCost" class="form-control" value="<?php echo $proCost; ?>">
                                            <span class="help-block"><?php echo $procedureCost_err; ?></span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>