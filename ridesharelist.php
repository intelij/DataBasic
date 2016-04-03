<!-- RideShareList (Universal) -->

<?php
require_once("db.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/js/bootstrap.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="index.php">Rideshare App</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                </div>
            </nav>

            <div class="jumbotron">

            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Search</h3>
                    <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
                        <input type="text" class="form-control" placeholder="Search for...">
                    </div>


                </div>
                <div class="col-md-6">

                    <h3>Available RideShares</h3>
                    <br>

                    <table class= "table table-bordered" border="black">
                        <tr>
                            <th>Date </th>
                            <th>Driver Name </th>
                            <th>Destination </th>
                            <th>Price </th>
                            <th>Seats Left </th>
                            <th>Link </th>
                        </tr>
                        <?php
                        $result = RideshareDB::getInstance()->get_available_rideshares();
                        while($row = mysqli_fetch_array($result)){
                            $RideID = $row['RID'];
                            echo "<tr><td>" . htmlentities($row['rdate']) . "</td>";
                            echo "<td>" . htmlentities($row['name']) . "</td>";
                            echo "<td>" . htmlentities($row['destination']) . "</td>";
                            echo "<td>" . htmlentities($row['price']) . "</td>";
                            echo "<td>" . htmlentities($row['seatsLeft']) . "</td>";
                            echo "<td>" . htmlentities("") . "<a href=\"rideshareinfo.php?RideID=$RideID\">Go</a>"."</td>";

                        }
                        mysqli_free_result($result);
                        ?>
                    </table>
                </div>
            </div>

            <div/>
            <div/>
            <div/>
            <div/>

</body>
</html>


