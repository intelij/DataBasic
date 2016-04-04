<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    //echo "Hello " . $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}

require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $minormax = $_POST['maxormin'];
    echo $minormax;
}
?>
<table class="table table-bordered" border="black">
    <tr>
        <th>Destination</th>
        <th>Average Seats by Location</th>
    </tr>
    <?php
    $result2 = RideshareDB::getInstance()->get_destination_ave_maximum_seats($minormax);
    while ($row = mysqli_fetch_array($result2)) {
        echo "<tr><td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['avgSeats']) . "</td></tr>\n";
    }
    mysqli_free_result($result2);
    ?>

</table>



<table class="table table-bordered" border="black">
    <?php
        $result = RideshareDB::getInstance()->get_destination_ave_seats();
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . htmlentities($row['destination']) . "</td>";
        echo "<td>" . htmlentities($row['avgSeats']) . "</td></tr>\n";
    }
    mysqli_free_result($result);
    ?>
</table>