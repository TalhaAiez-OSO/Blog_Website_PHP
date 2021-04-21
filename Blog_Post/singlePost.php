<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <?php 
    require_once("../Header_Footer/Header.php"); 
    ?>
    <?php
    if(!isset($_SESSION['post']) && isset($_REQUEST['postdate']))
    {
        $_SESSION['post'] = singlePost($_REQUEST['postdate']);
        updateViewed($_SESSION['post'][0]['Date'], $_SESSION['post'][0]['ViewCount']);
    }
    else if(isset($_SESSION['post']) && isset($_REQUEST['postdate']))
    {
        $_SESSION['post'] = singlePost($_REQUEST['postdate']);
        updateViewed($_SESSION['post'][0]['Date'], $_SESSION['post'][0]['ViewCount']);
    }
    ?>
    <main class="post-main-container main-container">
        <div class="post-container">
            <h2><?php echo $_SESSION['post'][0]['Title'] ?></h2>
            <hr>
            <pre><p><?php echo $_SESSION['post'][0]['Content'] ?></p></pre>
            <hr>
            <div class="post-info">
                <p><span>Author:            </span><?php echo $_SESSION['post'][0]['Author'] ?></p>
                <p><span>Views:             </span><?php echo $_SESSION['post'][0]['ViewCount'] ?></p>
                <p><span>Published/Updated: </span><?php echo $_SESSION['post'][0]['Date'] ?></p>
            </div>
        </div>
    </main>
</body>
</html>