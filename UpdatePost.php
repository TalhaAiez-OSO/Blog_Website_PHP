<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
</head>
<body>
    <?php require_once("Header_Footer/Header.php"); ?>
    <?php
        $csrf = csrf("updatepost.php");
        if(isset($_POST['submit-btn'])){
            if(hash_equals($csrf, $_POST['csrf'])){
                update_Post($_POST['title'], $_POST['content'], $_POST['date']);
                header("Location: /AdminDash.php");
            }
        }
        $post = singlePost($_REQUEST['PostDate']);
    ?>
    <main class="main-container">
        <form class="create-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input id="title" class="postTitle" type="text" name="title" placeholder="Title..." value="<?php echo $post[0]['Title'] ?>" required>
            <textarea rows="4" cols="50" name="content" class="postContent" placeholder="Enter Post Here..."><?php echo $post[0]['Content']?></textarea>
            <input type="hidden" name="csrf" value="<?php echo $csrf?>">
            <input type="hidden" name="date" value="<?php echo $_REQUEST['PostDate']?>">
            <input id="create-btn" class="button createPost-btn" type="submit" name="submit-btn" value="Update Post">
        </form>
    </main>
</body>
</html>