<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    echo "Hello " . $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}

require_once("db.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<br>
<form action="/createrideshare.php">
    <input type="submit" value="Create New RideShare">
</form>

<br><br>
Here are Your Created RideShares:
<br>
<br>
Ongoing RideShares -
<table border="black">
    <tr>
        <th>Date</th>
        <th>Destination</th>
        <th>Price</th>
        <th>Seats Left</th>
        <th>Seats</th>
    </tr>
    <?php
    $driverID =  RideshareDB::getInstance()->get_driver_id_by_name($_SESSION['user']);
    $result = RideshareDB::getInstance()->get_current_drivers_rideshares($driverID);
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
        echo "<td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['price']) . "</td>";
        echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
        echo "<td>" . htmlentities($row['seats']) . "</td></tr>\n";

    }
    mysqli_free_result($result);
    ?>
</table>

<br><br>

Past RideShares -

<table border="black">
    <tr>
        <th>Date</th>
        <th>Destination</th>
        <th>Price</th>
        <th>Seats Filled</th>
        <th>Seats</th>
    </tr>
    <?php
    $driverID = RideshareDB::getInstance()->get_driver_id_by_name($_SESSION['user']);
    $result = RideshareDB::getInstance()->get_past_drivers_rideshares($driverID);
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
        echo "<td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['price']) . "</td>";
        echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
        echo "<td>" . htmlentities($row['seats']) . "</td></tr>\n";

    }
    mysqli_free_result($result);
    ?>
</table>

</body>


</html>


