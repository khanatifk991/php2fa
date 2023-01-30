<?php
session_start();
require "Authenticator.php";


$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}


$qrCodeUrl = $Authenticator->getQR('AtifKhan', $_SESSION['auth_secret']);


if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>2 Factor Authentication in PHP</title>
    <style>
        body,html {
            height: 100%;
        }       
    </style>
</head>
<body>
    <h1>2 Factor Authentication in PHP</h1>
           
        <form action="check.php" method="post">
                  
            <?php if ($_SESSION['failed']): ?>
                <div class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> Invalid Code.
                </div>
                <?php   
                    $_SESSION['failed'] = false;
                ?>
                <script>
                  console.log("Invalid Code");
                </script>
            <?php endif ?>
                            
                <img style="text-align: center;;" src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>        
                <input type="text" class="form-control" name="code" placeholder="******"><br> <br>    
                <button type="submit" style="width: 200px;border-radius: 0px;">Verify</button>
        </form>
           
        
</body>
</html>