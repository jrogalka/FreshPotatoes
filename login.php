<?php
    include 'connect.php';
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);

        
        $query = "SELECT * FROM users
                  WHERE Username = :username && Password = :password";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $user = $statement->fetch();

        if ($statement->rowCount() == 1) {
            $_SESSION['UserId'] = $user['UserID'];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Password'] = $user['Password'];
            header('Location: index.php');
            die();
        }
    }
?>