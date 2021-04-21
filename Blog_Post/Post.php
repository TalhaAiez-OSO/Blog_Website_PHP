<!DOCTYPE html>
<html lang="en">
<?php

$post = posts();
$post = array_chunk($post, 5);
$totalNumberOfPages = count($post);
$activePageNumber = 0;
?>
<body>
    <main class="main-container">
        <div class="blog-container">
            <?php
            if(isset($_POST['page']))
                $activePageNumber = $_POST['page'] - 1;
            if(!($totalNumberOfPages === 0))
            {
                foreach ($post[$activePageNumber] as $key => $value) {
                    $date = $value['Date'];
                    $title = $value['Title'];
                    $content = $value['Content'];
                    echo "<div class='blog-post'>";
                        echo "<div class='blog-content'>";
                            echo "<p class='title'>{$title}</p>";
                            echo "<hr>";
                            echo "<p class='content'>{$content}</p>";
                        echo "</div>";
                        echo "<a class=\"learn-btn button\" href=\"/Blog_Post/singlePost.php?postdate={$date}\">Learn More</a>";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <div class="pagination">
        <form action="/Home.php" method="POST">
            <?php
                if(isset($_POST['page']))
                    $activePageNumber = (int)$_POST['page'];
                echo "<a class='page-arrow'>&laquo;</a>";
                if(!($totalNumberOfPages === 0))
                {
                    for($x = 1; $x <= $totalNumberOfPages; $x++) 
                    {
                        echo "<input type='submit' name='page' class='activePage page-number' value={$x}>";
                    }
                }
                else{
                    echo "<input type='submit' name='page' class='activePage page-number' value=1>";
                }
                echo "<a class='page-arrow'>&raquo;</a>";
            ?>
        </form>
        </div>
    </main>
</body>
</html>