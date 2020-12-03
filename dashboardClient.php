<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Twinkling Smiles | Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <style>
            .appointment-calendar-style{
                background-color: rgb(182, 248, 248);
                border-radius: 20%;
            }
            .appointment-btn{
                font-size: small;
                border-radius: 50%;
            }
        </style>
    </head>
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
                    <li class="nav-item active">
                        <a class="nav-link e" href="./index.html"><span class="fa fa-home fa-lg"></span>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class=""></span>Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php"><span class=""></span>Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        
    <div class="container row-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="table-responsive">
                            <h3 id="Month" class="text-center"></h3>
                            <button id="previous" class="btn btn-primary">Previous</button>
                            <button id="next" class="btn btn-primary">Next</button>
                            <table class="table table-condensed table-hver">
                                <thead class="text-center">
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tues</th>
                                    <th>Wed</th>
                                    <th>Thur</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </thead>
                                <tbody id="tbody" class="text-center">
                                        <tr>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><p>2</p></td>
                                        <td><p>3</p></td>
                                        <td><p>4</p></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                    </tr>
                                    <tr>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><p>2</p></td>
                                        <td><p>3</p></td>
                                        <td><p>4</p></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                        <td><button class="btn appointment-btn btn-primary">1</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                  
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 ">
                <!-- Table Start -->
                <h3 class="h3 text-center">Appointments</h3>
                <table class="table text-center"> 
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Molar Removal</td>
                            <td>09 December 2020</td>
                            <td>2:15 PM</td>
                            <td>Active</td>
                        </tr>
                        
                    </tbody>
                </table>
                <!-- Table End-->
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    //creating the date for the calendar
    var counter = 1;
    var date = new Date();
    var month = date.getMonth();
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var year = date.getFullYear();
    $("#Month").html(months[month]+" "+year.toString())
    //setting first and last day of particular month
    var firstDay = new Date(date.getFullYear(), date.getMonth(),1);
    var lastDay = new Date(date.getFullYear(), date.getMonth()+1,0);

    var table = document.getElementById("tbody");
    console.log(table);
    let tablerow = document.createElement("tr");
   /* for (let index = 0; index < lastDay.getDate(); index++) {
            if()
            for (let s = 0; s < 7; s++) {
                let item = document.createElement("td");
                let button = document.createElement("button");
                button.className = "btn appointment-btn btn-primary";
                //button.innerText = counter;
                counter++;
                item.appendChild(button);
                tablerow.appendChild(item)
            }  
            table.appendChild(tablerow);
    }
    counter = 0;
    //getting all the client appointments from the database
    
    //loading the days and events for the days
    for (let index = 0; index < lastDay.getDate(); index++) {
        
    }
    //calendar year/month navigation
    $("#next").click(function(){
        if(month == 11)
        {
            year +=1;
            month = 0;
            $("#Month").html(months[month]+" "+year.toString())
        }
        else 
        {
            month +=1;
            $("#Month").html(months[month]+" "+year.toString())
        }       
        for (let index = 0; index < lastDay.getDate(); index++) {
            let tablerow = document.createElement("tr");
            for (let s = 0; s < 7; s++) {
                let item = document.createElement("td");
                let button = document.createElement("button");
                button.addClass("btn appointment-btn btn-primary");
                button.innerText = counter;
                counter++;
                tablerow.appendChild(button);
            }  
            table.appendChild(tablerow);
        }
        
    });
    $("#previous").click(function(){
        if(month == 0)
        {
            month = 11;
            year -= 1;
            $("#Month").html(months[month]+" "+year.toString())
        }
        else{
            month -= 1;
            $("#Month").html(months[month]+" "+year.toString())
        }
    });*/
});
</script>
</body>
</html>