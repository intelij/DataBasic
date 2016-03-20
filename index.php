<!-- Login & Signup Page -->
<!-- Based off of https://netbeans.org/kb/docs/php/wish-list-lesson2.html -->

<?php
require_once("db.php");
$logonSuccess = false;

// verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (RideshareDB::getInstance()->verify_user_credentials($_POST['user'], $_POST['password']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: driverhomepage.php');
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
Don't have an account? <a href="createdriver.php">Create now</a>

<form name="logon" action="index.php" method="POST" >
    Username: <input type="text" name="user"/>
    Password  <input type="password" name="password"/>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!$logonSuccess)
            echo "Invalid name and/or password";
    }
    ?>

    <input type="submit" value="Login"/>
</form>
</body>
</html>