<?php
session_start();

require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: index.php");
    die();
}
$Authenticator = new Authenticator();

$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 1);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    die();
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authentication Successful</title>
    <style>
        body,html {
            height: 100%;
        }       
    </style>
</head>
<body>
    <hr>
        <div style="text-align: center;">
            <h1>Authentication Successful</h1>
        </div>
    <hr>    
</body>
</html>