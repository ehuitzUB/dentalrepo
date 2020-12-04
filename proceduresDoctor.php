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

$procedureName = $procedureDescription = $procedureCost = "";
$procedureName_err = $procedureDecription_err = $procedureCost_err = "";

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

    $procedureName = mysqli_real_escape_string($link, $_REQUEST['procedureName']);
    $procedureDescription = mysqli_real_escape_string($link, $_REQUEST['procedureDescription']);
    $procedureCost = mysqli_real_escape_string($link, $_REQUEST['procedureCost']);
 
// Attempt insert query execution
    $sql = "INSERT INTO procedures (procedureName, procedureDescription, procedureCost) VALUES ('$procedureName', '$procedureDescription', '$procedureCost')";
    if(mysqli_query($link, $sql)){
        header("location:proceduresDoctor.php");
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
        <title>Twinkling Smiles | Procedures</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <!-- navbar-->
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
                        <a class="nav-link"  href="./proceduresDoctor.php"><span class="fa fa-plus-square"></span>Procedures</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./reportsDoctor.php"><span class="fa fa-bar-chart"></span>Reports</a>
                    </li>
                    <li class="nav-item text-black">
                        <a class="nav-link"  href="./logout.php"><span class="fa fa-sign-out"></span> Logout</a>
                    </li>
                </ul>
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
                <div class="col-md-7 col-sm-8" style="margin: 0 0 10px 0;">
                    <div class="row">
                        <div class="col-10 appointment-header intro">
                            <p class="d-inline">All Procedures</p>
                        </div>
                        <div class="col-2 appointment-header intro">
                            <a href="#">[Search]</a>
                        </div>
                        <div class="col-12 appointment-body">
                            <div class="row">
                                <table class = "customers">
                                <theader>
                                    <tr>
                                        <th>Procedure ID</th>
                                        <th>Procedure Name</th>
                                        <th>Procedure Cost</th>
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
                                        $sql = "SELECT procedureID, procedureName, procedureCost FROM procedures ORDER BY procedureName asc";
                                        $result = $link->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        echo "<tr>".
                                        "<td>" . $row["procedureID"]. "</td>".
                                        "<td>" . $row["procedureName"] . "</td>".
                                        "<td>"  . $row["procedureCost"]. "</td>".
                                        "<td><a href = 'editProceduresDoctor.php?GetID=".$row["procedureID"]."'>Edit</a></td>".
                                        "<td><a href = 'deleteProceduresDoctor.php?GetID=".$row["procedureID"]."'>Delete</a></td>". 

                                        "</tr>";
                                        }
                                        } else { echo "0 results"; }
                                        $link->close();
                                        ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
               
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
                                            <label class="ml-3">Procedure Name</label>
                                            <input type="text" name="procedureName" class="form-control ml-3">
                                            <span class="help-block"><?php echo $procedureName_err; ?></span>
                                        </div>    
                                        <div <?php echo (!empty($procedureDescription_err)) ? 'has-error' : ''; ?>>
                                            <label class="ml-3">Procedure Description</label>
                                            <input type="text" name="procedureDescription" class="form-control ml-3">
                                            <span class="help-block"><?php echo $procedureDecription_err; ?></span>
                                        </div>
                                        <div <?php echo (!empty($procedureCost_err)) ? 'has-error' : ''; ?>>
                                            <label class="ml-3">Procedure Cost</label>
                                            <input type="text" name="procedureCost" class="form-control ml-3">
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