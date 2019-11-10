<?php
/*
    require.php - Enables HTTP authentication to the page.
 */
    require 'authenticate.php';
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

    <title>New Review</title>
</head>

<body>
    <div class="jumbotron">
        <img src="images/logo.png" alt="logo" width="150" height="150">
        <h1><a href="index.php" style="color: black; text-decoration: inherit;">Fresh Potatoes - New Review</a></h1>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Navigaton</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="create.php">New Review <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newMovie.php">New Movie</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col" style="border: 1px solid black; margin: 5px;">
                    <form action="insert.php" method="post">
                        <fieldset>
                            <legend>New Movie Review</legend>
                            <div class="form-group">
                              <label for="movie">Movie</label>
                              <select class="form-control" name="movie" id="movie">
                                  <option value="0" disabled selected>Please select a movie..</option>
                                  <option value="1">Lion King</option>
                                  <option value="2">Joker</option>
                                  <option value="3">John Wick Chapter 3</option>
                                  <option value="4">Blade Runner</option>
                                  <option value="5">Avengers: Endgame</option>
                                  <option value="6">Mission Impossible: Fallout</option>
                                  <option value="7">What We Do In The Shadows</option>
                                  <option value="8">A Dog's Purpose</option>
                                  <option value="9">Inglorious Bastards</option>
                                  <option value="10">Nightmare Before Christmas</option>
                                  <option value="11">Speed</option>
                                  <option value="12">Baby Driver</option>
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
                              <label class="form-check-label" for="spoiler">Contains Spoilers?</label>
                              <input type="checkbox" name="spoiler" id="spoiler">
                            </div>
                            <div>
                              <label for="stars">Rating</label>
                              <input type="number" name="stars" id="stars" max=5 min=0>
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="command" value="Create" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            FreshPotatoes - No Rights Reserved
        </div>
    </div>
</body>

</html>