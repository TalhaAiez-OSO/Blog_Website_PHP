<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php require_once("Header_Footer/Header.php"); ?>
    <main class="main-container">
        <h1>
            <?php
            for($i = 0; $i < strlen($_SESSION['logged_in']['Email']); $i++){
                if($_SESSION['logged_in']['Email'][$i] === '@')
                    break;
                echo strtoupper($_SESSION['logged_in']['Email'][$i]);
            }
            ?>'s Dashboard
        </h1>
        <a href = "/CreatePost.php" class = "button button-CP">Create Post</a>
        <?php $posts = posts($_SESSION['logged_in']['Email']);?>
        <table class = "PostConfig">
            <tr>
                <th class="title">Post Title</th>
                <th class="title">Author</th>
                <th class="title">Update</th>
                <th class="title">Delete</th>
            </tr>
            <?php
            foreach($posts as $post)
            {
                $date=$post['Date'];
                echo "
                <tr>
                    <th>".$post['Title']."</th>
                    <th>".$post['Author']."</th>
                    <th><a href='/UpdatePost.php?PostDate=$date' class='button edit-btn'>Edit</a></th>
                    <th><a href='/RedirectPages/DeletePost.php?postDate=$date' class='button delete-btn'>Delete</a></th>
                </tr>
                ";
            }
            ?>
        </table>
    </main>
</body>
</html>