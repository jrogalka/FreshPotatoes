<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and description have at least 1 character in them.
    If the above is valid, sanitize the user's input and insert data into the database.
 */
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    if (strlen($title) >= 1 && strlen($description) >= 1) {
        include 'connect.php';

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
?>