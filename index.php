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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Fresh Potatoes</title>
</head>
<body>

<div class="jumbotron">
    <img src="images/logo.png" alt="logo" width="150px" height="150px">
    <h1>Fresh Potatoes</h1>
</div>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Navigaton</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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

    <div class='container'>
        <?php foreach ($reviews as $current): ?>
            <div class="row">
                <div class="col-lg" style="border: 1px solid black; margin: 5px;">
                    <h2><a href="show.php?id=<?=$current['ReviewID']?>"><?=$current['Title']?></a></h2>
                    <h3>Placeholder for movie title. Movie ID: <?=$current['MovieID']?></h3>
                    <p><small><a href="edit.php?id=<?=$current['ReviewID']?>">Edit/Delete</a></small></p>
                    <p><?=$current['Content']?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
</body>
</html>