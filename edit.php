<?php
/*
    authenticate.php - Calls the script for HTTP validation.
    connect.php - Calls the script to connect to the database.

    Query the database for all data from posts with the matching ID as the GET parameter.
    If the id parameter is not an int, redirect to the home page.
 */
    require 'authenticate.php';
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
    <title>Fresh Potatoes - Edit Post</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>Fresh Potatoes - Edit Review <?=$review[0]['Title']?></h1>
        </div> <!-- END div id="header" -->
        <ul id="menu">
            <li><a href="index.php" >Home</a></li>
            <li><a href="create.php" >New Post</a></li>
            <li><a href="newMovie.php">New Movie</a></li>
        </ul> <!-- END div id="menu" -->
        <div id="all_blogs">
            <form action="update.php" method="post">
                <fieldset>
                    <legend>Edit Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title" value="<?=$review[0]['Title']?>" />
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content" rows=10 cols=70><?=$review[0]['Content']?></textarea>
                    </p>
                    <p>
                        <input type="hidden" name="id" value="<?=$review[0]['ReviewID']?>" />
                        <input type="submit" name="command" value="Update" />
                        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
                    </p>
                </fieldset>
            </form>
        </div>
        <div id="footer">
            FreshPotatoes 2019 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>