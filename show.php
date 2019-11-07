<?php
/*
    connect.php - Establish a connection to the database.

    Display the full contents of a blog post.
    Retrieve the full contents through the id GET parameter.
    If the id parameter is not an int, redirect to the home page.
 */
    include 'connect.php';
    if (filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) == false){
        header('Location: index.php');
        exit;
    }
    else {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE PostId = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $post = $statement->fetchAll();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Joel's Blog - <?=$post[0]['PostTitle']?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Joel's Blog - <?=$post[0]['PostTitle']?></a></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
            <li><a href="index.php" >Home</a></li>
            <li><a href="create.php" >New Post</a></li>
        </ul> <!-- END div id="menu" -->
        <div id="all_blogs">
            <div class="blog_post">
                <h2><?=$post[0]['PostTitle']?></h2>
                <p>
                    <small>
                        <?=$post[0]['PostDate']?>
                        <a href="edit.php?id=<?=$post[0]['PostId']?>">edit</a>
                    </small>
                </p>
                <div class='blog_content'>
                    <?=$post[0]['PostContent']?>
                </div>
            </div>
        </div>
        <div id="footer">
            Copywrong 2019 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
