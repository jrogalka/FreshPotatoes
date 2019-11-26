<?php
/*
    connect.php - Establish conneciton to DB.
 */
    include 'connect.php';
    $query = "SELECT * FROM movie";
    $statement = $db->prepare($query);
    $statement->execute();
    $movies = $statement->fetchAll();

    //Ensure the user is signed in
    if (!isset($_SESSION['UserId'])) {
        echo '<script language="javascript">';
        echo 'alert("You must be logged in to access this page.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="images/logo.ico" type="image/ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>New Review</title>
</head>

<body>
    <div class="jumbotron">
        <img src="images/logo.png" alt="logo" width="150" height="150">
        <h1><a href="index.php" style="color: black; text-decoration: inherit;">Fresh Potatoes - New Review</a></h1>
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
                    <?php if(isset($_SESSION['UserId']) && $_SESSION['Role'] == 1) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_movie.php">New Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_category.php">New Category</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="create_review.php">New Review <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_users.php">All Users</a>
                        </li>
                    <?php elseif (isset($_SESSION['UserId'])) :?>
                        <li class="nav-item active">
                            <a class="nav-link" href="create_review.php">New Review <span class="sr-only">(current)</span></a>
                        </li>
                    <?php endif ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="all_movies.php">All Movies</a>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['UserId'])) :?>
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
                    <form action="insert_review.php" method="post">
                        <fieldset>
                            <legend>New Movie Review</legend>
                            <div class="form-group">
                              <label for="movie">Movie</label>
                              <select class="form-control" name="movie" id="movie">
                                    <?php for ($i=0; $i < count($movies); $i++) :?>
                                        <option value="<?=$movies[$i]['MovieID']?>"><?=$movies[$i]['Title']?></option>
                                    <?php endfor ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="title">Title</label>
                              <input class="form-control" name="title" id="title" />
                            </div>
                            <div class="form-group">
                              <label for="content">Content</label>
                              <textarea class="form-control" name="content" id="content" rows=10 cols=70></textarea>
                            </div>
                            <div class="form-group">
                              <label for="stars">Rating</label>
                              <input type="number" name="stars" id="stars" max=5 min=0 value=0>
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="command" value="Create" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-left py-4">
            FreshPotatoes - No Rights Reserved
        </div>
    </div>
</body>

</html>