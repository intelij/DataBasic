<!-- CreateRideShare (Driver View) -->

<?php
require_once("db.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    RideshareDB::getInstance()->insert_Car($_POST['icenseNum'], $_POST['type'], $_POST['color']);
        exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
$car = array("licenseNum" => $_POST['licenseNum'],
"type" => $_POST['type'],
"color" => $_POST['color']);
?>

<form name="addCar" action="createrideshare.php" method="POST">
     Num:
    <input type="text" name="licenseNum" value="<?php echo $car['licenseNum']; ?>" />
    Type:
    <input type="text" name="type"  value="<?php echo $car['type']; ?>" />
    Color:
    <input type="text" name="color"  value="<?php echo $car['color']; ?>" />
    <br/>

    <input type="submit" name="saveCar" value="Save Changes"/>
</form>
</body>
</html>
