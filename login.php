<?php
    include 'connect.php';

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

        //Correct User
        if ($statement->rowCount() >= 1) {
            $_SESSION['UserId'] = $user['UserID'];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Role'] = $user['Role'];
            header('Location: index.php');
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Login Credentials.");';
            echo 'window.location.href = "login.html";';
            echo '</script>';
        }
    }
?>