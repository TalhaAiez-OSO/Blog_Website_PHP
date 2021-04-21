<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>
    <?php require_once __DIR__ . "\\Header_Footer\\Header.php"?>
    <?php
        $csrf = csrf("register.php");

        if(isset($_POST['submit-btn'])){
            if(hash_equals($csrf, $_POST['csrf'])){
                if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confpassword'])){
                    if(userRegister($_POST['password'], $_POST['confpassword'], $_POST['email'])){
                        $_SESSION['registered'] = true;
                        header("Location: /RedirectPages/RegisterRedirectPage.php");
                    }
                    else{
                        $_SESSION['registered'] = false;
                        header("Location: /RedirectPages/RegisterRedirectPage.php");
                    }
                }
            }
        }
    ?>
    <div class="container">
        <div class="button-box">
            <a href="Login.php"><button type="button" class="toggle-btn login-btn">Login</button></a>
            <a href="#"><button type="button" class="toggle-btn register-btn">Register</button></a>
        </div>
        <div class="login-form-container">
            <form class="login-form" action="/Register.php" method="POST">
                <input id="email" name="email" class="login-input" type="email" placeholder="Email Address" required>
                <input id="password" name="password" class="login-input" type="password" placeholder="Enter Password" required>
                <input id="confpassword" name="confpassword" class="login-input" type="password" placeholder="Confirm Password" required>
                <input type="hidden" name="csrf" value="<?php echo $csrf?>">
                <div><input id="rememberCheck" class="login-input" type="checkbox" value="remember"> <span>Remember Password</span></div>
                <input id="submit-btn" name="submit-btn" class="login-input" type="submit" value="Sign In">
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . "\\Header_Footer\\Footer.php"?>
</body>
</html>