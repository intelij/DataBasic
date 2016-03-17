<!-- CreateRideShare (Driver View) -->

<?php

require_once("db.php");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<?php

$link = mysqli_connect('databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com', 'DataBasicTeam', 'CPSC304!');
if (!mysqli_ping($link)) {
    die('Not connected : ' . mysqli_error());
}

?>

</body>
</html>
