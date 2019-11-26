<?php
/*
    connect.php - Establish a connection to the database.

    Ensure that title and description have at least 1 character in them.
    If the above is valid, sanitize the user's input and insert data into the database.
 */
    //Ensure the user is signed in
    if (!isset($_POST['command'])) {
        echo '<script language="javascript">';
        echo 'alert("You must be logged in to access this page.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
    include 'connect.php';
    $comment = $_POST['comment'];
    $id = $_POST['id'];
    $user = $_SESSION['UserId'];
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (strlen($comment) >= 1) {
        $query = "INSERT INTO comment (UserID, ReviewID, Content) values (:user, :id, :content)";
        $statement = $db->prepare($query);
        $statement->bindValue(':content', $comment);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':user', $user, PDO::PARAM_INT);
        $statement->execute();

        $CommentID = $db->lastInsertId();
    }
    else {
        print "Error: Comment must have at least 1 character.";
        exit;
    }
    header('Location: index.php');
    exit;
    
?>