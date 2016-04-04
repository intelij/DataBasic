<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    echo "Here's your RideShare Info " . $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}

require_once("db.php");

$RideID = $_GET['RideID'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    RideshareDB::getInstance()->create_participates($CPID, $RideID, $_POST['type']);
    echo " destination changed to " . $_POST['location'];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<table border="black">
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Driver Name</th>
        <th>Destination</th>
        <th>PickUp</th>
        <th>Price</th>
        <th>Seats</th>
        <th>Seats Left</th>
    </tr>

    <?php

    $result = RideshareDB::getInstance()->get_rideshare_byid($RideID);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
            echo "<td>" . htmlentities($row['rtime']) . "</td>";
            echo "<td>" . htmlentities($row['name']) . "</td>";
            echo "<td>" . htmlentities($row['destination']) . "</td>";
            echo "<td>" . htmlentities($row['address']) . "</td>";
            echo "<td>" . htmlentities($row['price']) . "</td>";
            echo "<td>" . htmlentities($row['seats']) . "</td>";
            echo "<td>" . htmlentities($row['seatsLeft']) . "</td></tr>\n";
        }
    } else {
        echo "0 results";
    }



    ?>



</table>


Change destination to:


<form name="updaterideshare" action="rideshareinfoTransactions.php?RideID=<?php echo $RideID; ?>" method="POST">
    <input type="text" name="location" value="<?php echo $Destination; ?>"/>
    <input type="submit" name="test" value="Update"/>
</form>

<br>
RideShare Passenger & Transaction Method:

<table border="black">
    <tr>
        <th>Passenger Name</th>
        <th>Price</th>
        <th>Payment Method</th>

    </tr>
    <?php

    $result = RideshareDB::getInstance()->get_rideshare_transactions($RideID);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlentities($row['name']) . "</td>";
            echo "<td>" . htmlentities($row['price']) . "</td>";
            echo "<td>" . htmlentities($row['Type']) . "</td></tr>\n";
        }
    } else {
        echo "no results";
    }
    // mysqli_free_result($result);
    ?>

</table>


</body>


</html>



