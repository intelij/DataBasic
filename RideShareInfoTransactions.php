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
            echo "<td>" . htmlentities($row['type']) . "</td></tr>\n";
        }
    } else {
        echo "no results";
    }
    // mysqli_free_result($result);
    ?>

</table>


</body>


</html>



