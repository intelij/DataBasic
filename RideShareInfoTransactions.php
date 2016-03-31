<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    echo "Here's your RideShare Info " . $_SESSION['user'];
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
RideShare Passenger & Transaction Method:

<table border="black">
    <tr>
        <th>Passenger Name</th>
        <th>Price</th>
        <th>Payment Method</th>

    </tr>
    <?php
    $rideShareID = RideshareDB::getInstance()->get_rideshare_id();
    $result = RideshareDB::getInstance()->get_rideshare_transactions($rideShareID);
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . htmlentities($row['name']) . "</td>";
        echo "<tr><td>" . htmlentities($row['price']) . "</td>";
        echo "<td>" . htmlentities($row['type']) . "</td></tr>\n";

    }
    mysqli_free_result($result);
    ?>

</table>


</body>


</html>



