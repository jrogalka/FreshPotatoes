<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and description have at least 1 character in them.
    If the above is valid, sanitize the user's input and insert data into the database.
 */
    $category = $_POST['category'];
    if (strlen($category) >= 1) {
        include 'connect.php';

        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO categories (Category) values (:category)";
        $statement = $db->prepare($query);
        $statement->bindValue(':category', $category);
        $statement->execute();

        $CategoryID = $db->lastInsertId();
    }
    else {
        print "Error: Title and description must have at least 1 character.";
        exit;
    }
    header('Location: index.php');
    exit;
?>