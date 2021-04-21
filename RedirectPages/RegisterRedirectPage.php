<!DOCTYPE html>
<html lang="en">
<body>
    <?php require_once __DIR__ . "\\..\\Header_Footer\\Header.php"?>
    <h5 class="redirectPage">
    Registeration
    <?php
    echo ($_SESSION['registered'] ? "Successful" : "Failed");
    unset($_SESSION['registered']);
    ?> 
    <a class="button" href="../Home.php">@Home</a></h5>
</body>
</html>