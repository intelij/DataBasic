<!-- CreateRideShare (Driver View) -->

<?php

require_once("db.php");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Create a new rideshare</title>
    <h1>New RideShare</h1>
</head>
<body>

<?php

$link = mysqli_connect('databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com', 'DataBasicTeam', 'CPSC304!');
if (!mysqli_ping($link)) {
    die('Not connected : ' . mysqli_error());
}

?>

<form name="createRideshare" action="createrideshare.php" method="post">
    Destination:<br>
    <input list="destination">
    <datalist id="destination">
        <option value="Whistler">
        <option value="Kelowna">
        <option value="Squamish">
        <option value="Pemberton">
    </datalist><br>
    Price:<br>
    <input type="text" name="price"><br>
    Address:<br>
    <input type="text" name="address"><br>
    Postal Code:<br>
    <input type="text" name="postalCode"><br>
    Province:<br>
    <input type="text" name="province" value="BC"><br>
    City:<br>
    <input type="text" name="city" value="Vancouver"><br>
    Departure Date:<br>
    <input type="date" name="rdate"><br>
    Departure Time:<br>
    <input type="time" name="rtime"><br>
    <input type="submit" value="Create New Rideshare"><br>
</form>


</body>


</html>
