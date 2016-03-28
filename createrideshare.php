<!-- CreateRideShare (Driver View) -->

<?php

require_once("db.php");

$link = mysqli_connect('databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com', 'DataBasicTeam', 'CPSC304!');
if (!mysqli_ping($link)) {
    die('Not connected : ' . mysqli_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // RID, DID, Ctime, Cdate, seatsLeft not on form.
    // These values need to be created upon submit

        RideshareDB::getInstance()->create_rideshare($_POST['RID'],$_POST['DID'],$_POST['destination'],
            $_POST['price'],$_POST['address'],
            $_POST['postalCode'],$_POST['province'],$_POST['city'],$_POST['rdate'], $_POST['rtime'],$_POST['Ctime'],$_POST['CDate'],
            $_POST['seats'],$_POST['seatsLeft']);


        exit;

}




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Create a new rideshare</title>
    <h1>New RideShare</h1>
</head>
<body>



<form name="createRideshare" action="createrideshare.php" method="post">
    Destination:<br>
    <!-- RID should get be created upon submit -->
    <!-- DID should get the logged on user's driver id -->
    <input type="text" name = destination value="<?php echo $rideshare['destination'];?>"><br>
    Price:<br>
    <input type="text" name="price" value="<?php echo $rideshare['price'];?>"><br>
    Address:<br>
    <input type="text" name="address" value="<?php echo $rideshare['address'];?>"><br>
    Postal Code:<br>
    <input type="text" name="postalCode" value="<?php echo $rideshare['postalCode'];?>"><br>
    Province:<br>
    <input type="text" name="province" value="<?php echo $rideshare['province'];?>"><br>
    City:<br>
    <input type="text" name="city" value="<?php echo $rideshare['city'];?>"><br>
    Departure Date:<br>
    <input type="date" name="rdate" value="<?php echo $rideshare['rdate'];?>"><br>
    Departure Time:<br>
    <input type="time" name="rtime" value="<?php echo $rideshare['rtime'];?>"><br>

    <!-- Ctime and Cdate shouldn't have input parameters -->
    <!-- Should be created upon submit-->

    Seats: <br>
    <input type="text" name="seats" value="<?php echo $rideshare['seats'];?>"><br>

    <!-- SeatsLeft should be initialized using php to seats initially when rideshare is created-->
    <input type="submit" value="Create New Rideshare"><br>
</form>


</body>


</html>
