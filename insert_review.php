<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and content have at least 1 character in them.
    If the above is valid, sanitize the user's input and insert data into the database.
 */
    //Ensure the user is signed in
    if (!isset($_POST['command'])) {
        echo '<script language="javascript">';
        echo 'alert("This page cannot be accessed.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
    include 'connect.php';
    $movie = $_POST['movie'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stars = $_POST['stars'];
    $user = $_SESSION['UserId'];
    if (strlen($title) >= 1 && strlen($content) >= 1) {
        if (filter_input(INPUT_POST, 'stars', FILTER_VALIDATE_INT)) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $stars = filter_input(INPUT_POST, 'stars', FILTER_SANITIZE_NUMBER_INT);

            $query = "INSERT INTO reviews (Title, Content, MovieID, UserID, Stars) values (:title, :content, :movie, :user, :stars)";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':content', $content);
            $statement->bindValue(':movie', $movie);
            $statement->bindValue(':user', $user);
            $statement->bindValue(':stars', $stars);
            
            $statement->execute();

            $ReviewID = $db->lastInsertId();
        }
        else {
            echo('Stars must be numeric');
        }
        
    }
    else {
        print "Error: Title and Content must have at least 1 character.";
        exit;
    }
    header('Location: index.php');
    exit;
?>