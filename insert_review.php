<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and content have at least 1 character in them.
    If the above is valid, sanitize the user's input and insert data into the database.
 */
    $movie = $_POST['movie'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stars = $_POST['stars'];
    $spoiler = $_POST['spoiler'];
    if (strlen($title) >= 1 && strlen($content) >= 1) {
        include 'connect.php';

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO reviews (Title, Content, MovieID, UserID, Stars, Spoiler) values (:title, :content, :movie, 1, :stars, :spoiler)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':movie', $movie);
        $statement->bindValue(':stars', $stars);
        $statement->bindValue(':spoiler', $spoiler);
        $statement->execute();

        $ReviewID = $db->lastInsertId();
    }
    else {
        print "Error: Title and Content must have at least 1 character.";
        exit;
    }
    header('Location: index.php');
    exit;
?>