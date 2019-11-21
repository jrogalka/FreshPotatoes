<?php
    include 'connect.php';
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $email = $_POST['email'];
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];

    if ($_POST['command'] == 'Update') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $first = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "UPDATE users SET Username = :username, Password = :password, Email = :email, FirstName = :firstname, LastName = :lastname WHERE UserID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue('email', $email);
        $statement->bindValue(':firstname', $first);
        $statement->bindValue(':lastname', $last);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    elseif ($_POST['command'] == 'Delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM users WHERE UserID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    header('Location: all_users.php');
    exit;
?>