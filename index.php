<?php
    include 'connect.php';
    $query = "SELECT * FROM reviews ORDER BY ReviewID DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $reviews = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fresh Potatoes</title>
</head>
<body>
<div id="wrapper">
    <h1>Fresh Potatoes</h1>
    <p>Welcome to Fresh Potatoes, the world's greatest satirical movie review site.</p>
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="create.php">New Post</a></li>
        <li><a href="newMovie.php">New Movie</a></li>
    </ul> <!-- END ul id="menu" -->
    <div id='all_reviews'>
        <?php foreach ($reviews as $current): ?>
            <h2><a href="show.php?id=<?=$current['ReviewID']?>"><?=$current['Title']?></a></h2>
            <h3>Placeholder for movie title. Movie ID: <?=$current['MovieID']?></h3>
            <p><small><a href="edit.php?id=<?=$current['ReviewID']?>">Edit/Delete</a></small></p>
            <div>
                <?=$current['Content']?>
            </div>
        <?php endforeach ?>
    </div> <!-- END of div id="all_reviews" -->
</div> <!-- END div id="wrapper" -->
</body>
</html>