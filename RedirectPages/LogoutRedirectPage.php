<!DOCTYPE html>
<html lang="en">
<body>
    <?php require_once __DIR__ . "\\..\\Header_Footer\\Header.php"?>
    <?php unset($_SESSION['logged_in']);?>
    <?php header("Location: ../Home.php");?>
</body>
</html>