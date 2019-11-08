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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navigaton</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">New Review</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newMovie.php">New Movie</a>
                    </li>
                </ul>
            </div>
        </nav>
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
        </div>
    </div> <!-- END div id="wrapper" -->
</body>
</html>
