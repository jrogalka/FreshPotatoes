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
        $review_query = "SELECT reviews.ReviewID, reviews.Title, reviews.Content, AVG(reviews.Stars) AS Stars, reviews.CreatedOn, movie.Title AS movieTitle, movie.MovieID AS movieID FROM reviews
                     JOIN movie ON movie.MovieID = reviews.MovieID
                     WHERE reviews.ReviewID = :id";
        $review_statement = $db->prepare($review_query);
        $review_statement->bindValue(':id', $id, PDO::PARAM_INT);
        $review_statement->execute();
        $review = $review_statement->fetchAll();

        $commentQuery = "SELECT comment.CommentID, comment.UserID, comment.ReviewID, comment.Content, users.Username FROM comment
                         JOIN reviews ON reviews.ReviewID = comment.ReviewID
                         JOIN users ON users.UserID = comment.UserID
                         WHERE comment.ReviewID = :id
                         ORDER BY comment.CommentID DESC";
        $commentStatement = $db->prepare($commentQuery);
        $commentStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $commentStatement->execute();
        $comments = $commentStatement->fetchAll();

        $usersQuery = "SELECT users.* FROM users
                         JOIN reviews ON reviews.UserID = users.UserID";
        $usersStatement = $db->prepare($usersQuery);
        $usersStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $usersStatement->execute();
        $user = $usersStatement->fetch();
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
    <title>Fresh Potatoes - <?=$review[0]['Title']?></title>
</head>
<body>
    <div class="jumbotron">
        <img src="images/logo.png" alt="logo" width="150" height="150">
        <h1><a href="index.php" style="color: black; text-decoration: inherit;">Fresh Potatoes - <?=$review[0]['Title']?></a></h1>
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
                        <a class="nav-link" href="all_movies.php">All Movies</a>
                    </li>
                    <?php if(isset($_SESSION['UserId']) && $_SESSION['Role'] == 1) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_movie.php">New Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_category.php">New Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_review.php">New Review</a>
                        </li>
                        <li class="nav-item">
                            <a href="all_users.php" class="nav-link">All Users</a>
                        </li>
                    <?php elseif (isset($_SESSION['UserId'])) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_review.php">New Review</a>
                        </li>
                    <?php endif ?>
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
                    <h1><?=$review[0]['Title']?></h1>
                    <h5 style="border-bottom: 1px solid black; margin-bottom: 5px; padding-bottom: 5px;"><a href="show_movie.php?id=<?=$review[0]['movieID']?>"><?=$review[0]['movieTitle']?></a></h5>
                    <div style="padding-bottom: 10px;">
                        <?=$review[0]['Content']?>
                    </div>
                    <!-- Rating Image -->
                    <?php if($review[0]['Stars'] == 0) :?>
                        <img src="images/stars_0.png" alt="0 Stars" style="margin-bottom: 5px;">
                    <?php elseif($review[0]['Stars'] == 1) :?>
                        <img src="images/stars_1.png" alt="1 Stars" style="margin-bottom: 5px;">
                    <?php elseif($review[0]['Stars'] == 2) :?>
                        <img src="images/stars_2.png" alt="2 Stars" style="margin-bottom: 5px;">
                    <?php elseif($review[0]['Stars'] == 3) :?>
                        <img src="images/stars_3.png" alt="3 Stars" style="margin-bottom: 5px;">
                    <?php elseif($review[0]['Stars'] == 4) :?>
                        <img src="images/stars_4.png" alt="4 Stars" style="margin-bottom: 5px;">
                    <?php elseif($review[0]['Stars'] == 5) :?>
                        <img src="images/stars_5.png" alt="5 Stars" style="margin-bottom: 5px;">
                    <?php endif ?>
                    <p style='margin-top: 5px;'><small>Reviewed On: <?=$review[0]['CreatedOn']?></small></p>
                    <p><small>Reviewed by: <a href="show_user.php?id=<?=$user['UserID']?>"><?=$user['Username']?></a></small></p>
                    <?php if(isset($_SESSION['UserId'])) :?>
                        <?php if($_SESSION['Role'] == 1 || $_SESSION['UserId'] == $user['UserID']) :?>
                            <p><small><a href="edit_review.php?id=<?=$review[0]['ReviewID']?>">Edit/Delete</a></small></p>
                        <?php endif ?>
                        <p><small><a href="create_comment.php?id=<?=$review[0]['ReviewID']?>">Comment</a></small></p>
                    <?php endif ?>
                </div>
            </div>
            <?php for($i = 0; $i < count($comments); $i++) :?>
                <div class="row">
                    <div class="col" style="border: 1px solid black; margin: 5px;">
                    <p><?=$comments[$i]['Content']?></p>
                    <p><small><a href="show_user.php?id=<?=$comments[$i]['UserID']?>"><?=$comments[$i]['Username']?></a></small></p>
                    </div>
                </div>
            <?php endfor ?>
        </div>
        
        <div class="footer-copyright text-left py-4">
            FreshPotatoes 2019 - No Rights Reserved
        </div>
    </div>
</body>
</html>
