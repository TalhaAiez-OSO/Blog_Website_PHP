<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <?php require_once __DIR__ . "\\Header_Footer\\Header.php"?>
    <?php
        $csrf = csrf("Login.php");

        if(isset($_POST['submit-btn'])){
            if(hash_equals($csrf, $_POST['csrf'])){
                if(isset($_POST['email']) && isset($_POST['password']))
                    userLogin($_POST['email'], $_POST['password']);
                    header("Location: /RedirectPages/LoginRedirectPage.php");
            }
        }
    ?>
    <div class="container">
        <div class="button-box">
            <a href="#"><button type="button" class="toggle-btn login-btn">Login</button></a>
            <a href="Register.php"><button type="button" class="toggle-btn register-btn">Register</button></a>
        </div>
        <div class="login-form-container">
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <input id="email" class="login-input" type="email" name="email" placeholder="Email Address" required>
                <input id="password" class="login-input" type="password" name="password" placeholder="Enter Password" required>
                <input type="hidden" name="csrf" value="<?php echo $csrf?>">
                <div><input id="rememberCheck" class="login-input" type="checkbox" name="rememberCheck" value="remember"> <span>Remember Password</span></div>
                <input id="submit-btn" class="login-input" type="submit" name="submit-btn" value="Login">
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . "\\Header_Footer\\Footer.php"?>
</body>
</html>