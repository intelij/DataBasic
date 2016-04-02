<?php

require_once("db.php");

$passwordIsValid = true;
$passwordIsEmpty = false;
$password2IsEmpty = false;


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
        RideshareDB::getInstance()->create_passenger($_POST['user'],
            $_POST['email'],$_POST['phoneNum'],$_POST['password']);

        header('Location: index.php');
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

<h3>User Information</h3>

<form name="addPass" action="createpassenger.php" method="POST">

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

    <br/>

    <input type="submit" name="savePass" value="Save Changes"/>
</form>
</body>
</html>
