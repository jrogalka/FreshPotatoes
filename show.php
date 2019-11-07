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
        $query = "SELECT * FROM reviews WHERE ReviewID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $review = $statement->fetchAll();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fresh Potatoes - <?=$review[0]['Title']?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>FreshPotatoes - <?=$review[0]['Title']?></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
            <li><a href="index.php" >Home</a></li>
            <li><a href="create.php" >New Post</a></li>
            <li><a href="newMovie.php">New Movie</a></li>
        </ul> <!-- END div id="menu" -->
        <div id="all_blogs">
            <div class="blog_post">
                <h2><?=$review[0]['Title']?></h2>
                <p>
                    <small>
                        <a href="edit.php?id=<?=$review[0]['ReviewID']?>">Edit/Delete</a>
                    </small>
                </p>
                <div class='blog_content'>
                    <?=$review[0]['Content']?>
                </div>
            </div>
        </div>
        <div id="footer">
            FreshPotatoes 2019 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
