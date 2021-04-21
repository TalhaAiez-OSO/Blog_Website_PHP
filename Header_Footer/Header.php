<?php
session_start();
require_once __DIR__ . "\\..\\Functions\\DatabaseUtility.php";

if(isset($_SESSION['logged_in'])){
    $dashLink = "/AdminDash.php";
    $log = "Logout";
    $logLink = "../RedirectPages/LogoutRedirectPage.php";
}
else{
    $dashLink = "#";
    $log = "Login";
    $logLink = "/Login.php";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href=<?php echo "\\..\\CSS\\header.css" ?>>
<link rel="stylesheet" type="text/css" href=<?php echo "\\..\\CSS\\register.css" ?>>
<link rel="stylesheet" type="text/css" href=<?php echo "\\..\\CSS\\adminDash.css" ?>>
<link rel="stylesheet" type="text/css" href=<?php echo "\\..\\CSS\\createpost.css" ?>>
<link rel="stylesheet" type="text/css" href=<?php echo "\\..\\CSS\\post.css" ?>>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a class="home-button nav-button button" href="/Home.php">Home</a>
            <a class="logo-button nav-button button" href=<?php echo $dashLink?>>Dashboard</a>
            <a class="login-button nav-button button" href=<?php echo $logLink?>><?php echo $log?></a>
        </div>
    </nav>    
</body>
</html>