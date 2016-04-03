<!-- CreateRideShare (Driver View) -->

<?php

require_once("db.php");


// Debugging
// Plan Form -> Caller -> Handler -> INSERT
// Assign variables
// Convert variables where appropriate
// Echo variables
// call create_rideshare

$DID = '1';
$postalCode = 'V6T1Z4';
$destination = 'Whistler';
$price = '10';
$address = '2205 Lower Mall';
$rdate = 'December 25, 2010'; // format_date_for_sql()
$rtime = '11:05 AM';
$mySql_rtime = date('H:i:s',strtotime('11:05 AM'));
$seats = '4';
$seatsLeft = $seats;
$city = 'Vancouver';
$province = 'BC';

echo "<h3>DID: $DID </h3>";
echo "<h3>postalCode: $postalCode</h3>";
echo "<h3>destination: $destination</h3>";
echo "<h3>price: $price</h3>";
echo "<h3>address: $address</h3>";
echo "<h3>rdate: $rdate</h3>";
echo "<h3>rtime: $mySql_rtime</h3>";
echo "<h3>seats: $seats</h3>";
echo "<h3>seatsLeft: $seatsLeft</h3>";
echo "<h3>city: $city</h3>";
echo "<h3>province: $province</h3>";




//driver id is current session driver id
//get_driverid needs to be implemented in db.php
// get_driverid($_SESSION['user']);

// $Ctime = time();
// date_default_timezone_set('America/Vancouver');
// $CDate = date("y/m/d");
// set seatsLeft to initial value of seats
// $seatsLeft = $_POST['seats'];


if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // RID, DID, Ctime, Cdate, seatsLeft not on form.
    // These values need to be created upon submit
    /*RideshareDB::getInstance()->create_rideshare($DID,$_POST['destination'],
        $_POST['price'],$_POST['address'],
        $_POST['postalCode'],$_POST['province'],$_POST['city'],$_POST['rdate'], $_POST['rtime']
        ,$Ctime, $CDate,
        $_POST['seats'],$seatsLeft);*/

    RideshareDB::getInstance()->create_rideshare($DID, $postalCode,
        $destination, $price, $address, $rdate, $mySql_rtime, $seats, $seatsLeft,$city, $province);
    exit;

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>

    <title>Create a new rideshare</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="index.php">Rideshare App</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                </div>

            </nav>

            <div class = "jumbotron">

<form role = "form" name="createRideshare" action="createrideshare.php" method="POST">
    <h1>New RideShare</h1>

    <div class = "form-group">
        <label for = "Destination:">
            Destination:
        </label>
        <input class = "form-control" type="text" name = "destination"/>
    </div>

    <div class = "form-group">
        <label for = "Price:">
            Price:
        </label>
        <input class = "form-control" type="text" name="price"/>
    </div>

    <div class = "form-group">
        <label for = "Address:">
            Address:
        </label>
        <input class = "form-control" type="text" name="address"/>
    </div>

    <div class = "form-group">
        <label for = "Postal Code:">
            Postal Code:
        </label>
        <input class = "form-control" type="text" name="postalCode"/>
    </div>

    <div class = "form-group">
        <label for = "Province:">
            Province:
        </label>
        <input class = "form-control" type="text" name="province"/>
    </div>

    <div class = "form-group">
        <label for = "City:">
            City:
        </label>
        <input class = "form-control" type="text" name="city"/>
    </div>

    <div class = "form-group">
        <label for = "Departure Date:">
            Departure Date:
        </label>
        <input class = "form-control" type="text" name="rdate"/>
    </div>

    <div class = "form-group">
        <label for = "Departure Time:">
            Departure Time:
        </label>
        <input class = "form-control" type="time" name="rtime"/>
    </div>
        <!-- Ctime and Cdate shouldn't have input parameters -->
        <!-- Should be created upon submit-->


    <div class = "form-group">
        <label for = "Seats: ">
            Seats:
        </label>
        <input class = "form-control" type="text" name="seats"/>
    </div>

    <!-- SeatsLeft should be initialized using php to seats initially when rideshare is created-->
    <input type="submit" value="Create New Rideshare" class = "btn btn-dfault"><br>
</form>
</body>
</html>
