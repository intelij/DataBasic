<!-- CreateDriver (Driver View) -->

<?php

require_once("db.php");

/**other variables */
$passwordIsValid = true;
$passwordIsEmpty = false;
$password2IsEmpty = false;


/*if ($_SERVER['REQUEST_METHOD'] == "POST") {
    RideshareDB::getInstance()->insert_Car($_POST['licenseNum'], $_POST['type'], $_POST['color']);
    exit;
}*/

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if ($_POST['user']==""){
        $userIsEmpty = true;
    }

    if ($_POST['password']=="")
        $passwordIsEmpty = true;
    if ($_POST['password2']=="")
        $password2IsEmpty = true;
    if ($_POST['password']!=$_POST['password2']) {
        $passwordIsValid = false;
    }

    if (!$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        RideshareDB::getInstance()->create_driver($_POST['user'],
            $_POST['email'],$_POST['phoneNum'], $_POST['licenseNum'],$_POST['password']);
        RideshareDB::getInstance()->insert_Car($_POST['licenseNum'], $_POST['type'], $_POST['color']);

  //      session_start();
    //    $_SESSION['user'] = $_POST['user'];
        //header('Location: editWishList.php' ); //Where do we redirect it?
        exit;
    }
}
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

<h3>User Information</h3>

<form name="addDriver" action="createdriver.php" method="POST">

    User name: <input type="text" name="user"/><br/>
    Email:  <input type="text" name="email"/><br/>
    Phone Number: <input type="text" name="phoneNum"/><br/>
    <br/>
    Password: <input type="password" name="password"/><br/>
    <?php
    if ($passwordIsEmpty) {
        echo ("Enter the password, please");
        echo ("<br/>");
    }
    ?>

    Please confirm your password: <input type="password" name="password2"/><br/>

    <?php
    if ($password2IsEmpty) {
        echo ("Confirm your password, please");
        echo ("<br/>");
    }
    if (!$password2IsEmpty && !$passwordIsValid) {
        echo ("<div>The passwords do not match!</div>");
        echo ("<br/>");
    }
    ?>

    <h3>Car Information</h3>
    Num: <input type="text" name="licenseNum" value="<?php echo $car['licenseNum']; ?>" /><br/>
    Type:
    <input type="text" name="type"  value="<?php echo $car['type']; ?>" /><br/>
    Color:
    <input type="text" name="color"  value="<?php echo $car['color']; ?>" /><br/>

    <br/>

    <input type="submit" name="saveDriver" value="Save Changes"/>
</form>
</body>
</html>
