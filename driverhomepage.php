<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    //echo "Hello " . $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}

require_once("db.php");

if (RideshareDB::getInstance()->get_user_type($_SESSION['user'])){
    header('Location: passengerhomepage.php');
    exit;
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Rideshare App</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">


                        <li>
                            <a href="/driverhomepage.php">Home</a>
                        </li>
                        <li>
                            <a href="/ridesharelist.php">Rideshare List</a>
                        </li>
                </div>
            </nav>

            <div class="jumbotron">

                <h2><?php echo "Hello " . $_SESSION['user'];?>!</h2>

                <a href="createrideshare.php" class="btn btn-primary">Create Rideshare</a>

            </div>
            <div class="col-md-12">
                <h3>Ongoing RideShares: </h3>
                <table class="table table-bordered" border="black">
                    <tr>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Seats Left</th>
                        <th>Seats</th>
                        <th>Link</th>
                    </tr>
                    <?php
                    $driverID = RideshareDB::getInstance()->get_driver_id_by_name($_SESSION['user']);
                    $result = RideshareDB::getInstance()->get_current_drivers_rideshares($driverID);
                    while ($row = mysqli_fetch_array($result)) {
                        $RideID = $row['RID'];
                        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
                        echo "<td>" . htmlentities($row['destination']) . "</td>";
                        echo "<td>" . htmlentities($row['price']) . "</td>";
                        echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
                        echo "<td>" . htmlentities($row['seats']) . "</td>";
                        echo "<td>" . htmlentities("") . "<a href=\"rideshareinfoTransactions.php?RideID=$RideID\">Go</a>" . "</td>";

                        //echo "<td>" . htmlentities("") . "<a href=\"rideshareinfoTransactions.php?RideID=$RideID\">Edit</a>" . "</td>";

                    }
                    mysqli_free_result($result);
                    ?>
                </table>


                <h3>Past RideShares: </h3>

                <table class="table table-bordered" border="black">
                    <tr>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Seats Filled</th>
                        <th>Seats</th>
                        <th>Link</th>
                    </tr>
                    <?php
                    $driverID = RideshareDB::getInstance()->get_driver_id_by_name($_SESSION['user']);
                    $result = RideshareDB::getInstance()->get_past_drivers_rideshares($driverID);
                    while ($row = mysqli_fetch_array($result)) {
                        $RideID = $row['RID'];
                        echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
                        echo "<td>" . htmlentities($row['destination']) . "</td>";
                        echo "<td>" . htmlentities($row['price']) . "</td>";
                        echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
                        echo "<td>" . htmlentities($row['seats']) . "</td>";
                        echo "<td>" . htmlentities("") . "<a href=\"rideshareinfoTransactions.php?RideID=$RideID\">Go</a>" . "</td>";

                    }
                    mysqli_free_result($result);
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>


</body>


</html>


