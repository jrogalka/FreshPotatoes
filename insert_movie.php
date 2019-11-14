<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and description have at least 1 character in them.
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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $existsQuery = "SELECT Title FROM movie
              WHERE Title = :title";
    $existsStatement = $db->prepare($existsQuery);
    $existsStatement->bindValue(':title', $title);
    $existsStatement->execute();

    if ($existsStatement->rowCount() > 0) {
        echo '<script language="javascript">';
        echo 'alert("Movie Already Exists.");';
        echo 'window.location.href = "create_movie.php";';
        echo '</script>';
    }
    else {
        if (strlen($title) >= 1 && strlen($description) >= 1) {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            $query = "INSERT INTO movie (Title, Description, Category) values (:title, :description, :category)";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':category', $category);
            $statement->execute();
    
            $MovieID = $db->lastInsertId();
        }
        else {
            print "Error: Title and description must have at least 1 character.";
            exit;
        }
        header('Location: index.php');
        exit;
    }
    
?>