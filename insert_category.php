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
    $category = $_POST['category'];
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $existsQuery = "SELECT Category FROM categories
                    WHERE Category = :category";
    $existsStatement = $db->prepare($existsQuery);
    $existsStatement->bindValue(':category', $category);
    $existsStatement->execute();

    if ($existsStatement->rowCount() > 0) {
        echo '<script language="javascript">';
        echo 'alert("Category Already Exists.");';
        echo 'window.location.href = "create_category.php";';
        echo '</script>';
    }
    else {
        if (strlen($category) >= 1) {
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
    }
    
?>