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
<form action="/ridesharelist.php">
    <input type="submit" value="Find a RideShare">
</form>

<br><br>
Here are Your Participated RideShares:
<br>
<br>
Your Participated RideShares -
<table border="black">
    <tr>
        <th>Date</th>
        <th>Destination</th>
        <th>Price</th>
        <th>Seats Left</th>
    </tr>
    <?php
    $passengerID =  RideshareDB::getInstance()->get_passenger_id($_SESSION['user']);
    $result = RideshareDB::getInstance()->get_current_passengers_rideshares($passengerID);
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
        echo "<td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['price']) . "</td>";
        echo "<td>" . htmlentities($row['seatsLeft']) . "</td></tr>\n";

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
    </tr>
    <?php
    $passengerID =  RideshareDB::getInstance()->get_passenger_id($_SESSION['user']);
    $result = RideshareDB::getInstance()->get_past_passengers_rideshares($passengerID);
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
        echo "<td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['price']) . "</td></td></tr>\n";
    }
    mysqli_free_result($result);
    ?>
</table>

</body>


</html>
