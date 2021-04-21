<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <?php require_once("Header_Footer/Header.php"); ?>
    <?php
        $csrf = csrf("creatpost.php");

        if(isset($_POST['submit-btn'])){
            if(hash_equals($csrf, $_POST['csrf'])){
                create_Post($_POST['title'], $_POST['content'], $_SESSION['logged_in']['Email']);
                header("Location: /AdminDash.php");
            }
        }
    ?>
    <main class="main-container">
        <form class="create-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input id="title" class="postTitle" type="text" name="title" placeholder="Title..." required>
            <textarea rows="4" cols="50" name="content" class="postContent" placeholder="Enter Post Here..."></textarea>
            <input type="hidden" name="csrf" value="<?php echo $csrf?>">
            <input id="create-btn" class="button createPost-btn" type="submit" name="submit-btn" value="Create Post">
        </form>
    </main>
</body>
</html>