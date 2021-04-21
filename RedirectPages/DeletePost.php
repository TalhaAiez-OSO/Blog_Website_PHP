<?php
require_once __DIR__ . "\\..\\Header_Footer\\Header.php";
delete($_REQUEST['postDate']);
header("Location: ../AdminDash.php");
?>