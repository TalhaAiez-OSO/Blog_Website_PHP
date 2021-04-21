<?php
require_once __DIR__ . "\\..\\Header_Footer\\Header.php";
$csrf = csrf("updatepost.php");
if(isset($_POST['submit-btn'])){
    if(hash_equals($csrf, $_POST['csrf'])){

        update_Post($_POST['title'], $_POST['content'], $_Post['date']);
        header("Location: /../AdminDash.php");
    }
}
?>