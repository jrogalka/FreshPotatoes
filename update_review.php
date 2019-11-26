<?php
/*
    connect.php - Establishes a connection to the database.

    Sanitize user data.
    Depending on user selection, either update or delete the post which corresponds to the
    id GET parameter.
 */
    include 'connect.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stars = $_POST['stars'];

    if ($_POST['command'] == 'Update') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (strlen($title) >= 1 && strlen($content) >= 1) {
            

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $stars = filter_input(INPUT_POST, 'stars', FILTER_SANITIZE_NUMBER_INT);


            $query = "UPDATE reviews SET Title = :title, Content = :content, Stars = :stars WHERE ReviewID = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':content', $content);
            $statement->bindValue(':stars', $stars);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        else {
            print "Error: Title and Content must have at least 1 character.";
            exit;
        }
    }
    elseif ($_POST['command'] == 'Delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $commentQuery = "DELETE FROM comment
                         WHERE comment.ReviewID = :id";
        $commentStatement = $db->prepare($commentQuery);
        $commentStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $commentStatement->execute();

        $query = "DELETE FROM reviews WHERE ReviewID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        
    }
    header('Location: index.php');
    exit;
?>