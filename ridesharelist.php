<!-- RideShareList (Universal) -->

<?php
require_once("db.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
    <body>
    Avaialble RideShares
    <br>



    <table border="black">
        <tr>
            <th>Date</th>
            <th>Driver Name</th>
            <th>Destination</th>
            <th>Price</th>
            <th>Seats Left</th>
            <th>Link</th>
        </tr>
        <?php
        $result = RideshareDB::getInstance()->get_available_rideshares();
        while($row = mysqli_fetch_array($result)){
            echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
            echo "<td>" . htmlentities($row['name']) . "</td>";
            echo "<td>" . htmlentities($row['destination']) . "</td>";
            echo "<td>" . htmlentities($row['price']) . "</td>";
            echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
            echo "<td>" . htmlentities("http://localhost:8000/rideshareinfo.php". "/" . $row['RID']) . "</td></tr>\n";

        }
        mysqli_free_result($result);
        ?>

    </table>

    </body>
</html>


