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
        $query = "SELECT * FROM movie
                  WHERE MovieID = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $movie = $statement->fetchAll();
    }
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
    <title>Fresh Potatoes - <?=$movie[0]['Title']?></title>
</head>
<body>
    <div class="jumbotron">
        <img src="images/logo.png" alt="logo" width="150" height="150">
        <h1><a href="index.php" style="color: black; text-decoration: inherit;">Fresh Potatoes - <?=$movie[0]['Title']?></a></h1>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Navigation</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_review.php">New Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_movie.php">New Movie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_category.php">New Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_movies.php">All Movies</a>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['UserId'])): ?>
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php else:?>
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.html">Register</a>
                            </li>
                        <?php endif ?>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col" style="border: 1px solid black; margin: 5px;">
                    <h1><?=$movie[0]['Title']?></h1>
                    <div>
                        <?=$movie[0]['Description']?>
                    </div>
                    <p style='margin-top: 5px;'><small>Added On: <?=$movie[0]['AddedOn']?></small></p>
                    <p><small><a href="edit_movie.php?id=<?=$movie[0]['MovieID']?>">Edit/Delete</a></small></p>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-left py-4">
            FreshPotatoes 2019 - No Rights Reserved
        </div>
    </div>
</body>
</html>