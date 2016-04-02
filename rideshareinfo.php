<!-- RideShareInfo (Driver/Passenger View) -->
<!-- Will display "Join" for passenger, and list transactions for Driver. -->

<?php
require_once("db.php");

header('Location: index.php ' );

$link = mysqli_connect('databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com', 'DataBasicTeam', 'CPSC304!');
if (!mysqli_ping($link)) {
    die('Not connected : ' . mysqli_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // TODO

    RideshareDB::getInstance()->create_participates($_POST['PID'], $_POST['RID'], $_POST['type']
    );

    exit;

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

header('Location: index.php' + / RID );
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<h3>Rideshare Info</h3>

<?php

$con = mysqli_connect('databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com', 'DataBasicTeam', 'CPSC304!');
$rid = 1;
$sql = "SELECT $rid FROM RideShare";
$result = $con->query($sql);

$result = RideshareDB::getInstance()->get_available_rideshares();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
        echo "<td>" . htmlentities($row['name']) . "</td>";
        echo "<td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['price']) . "</td>";
        echo "<td>" . htmlentities($row['seatsLeft']) . "</td></tr>\n";
    }
} else {
    echo "0 results";
}
$con->close();
?>

<form name="joinRideshare" action="rideshareinfo.php" method="post">
    Select payment type: <br>
    <select>
        <option value="cash">Cash</option>
        <option value="paypal">PayPal</option>
    </select> <br>
    <input type="submit" value="Join"><br>

</form>

</body>

</html>


