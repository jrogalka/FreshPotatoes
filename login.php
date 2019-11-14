<?php
    include 'connect.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);


        /*
            In the following query, I will use the COLLATE function to stop the query from converting all characters to lowercase.
            Wihtout this, the query would produce the following:
            Input: UserName, PassWord
            Value: username, password

            This can also be done at the database level in phpmyadmin.
        */
        $query = "SELECT * FROM users
                  WHERE Username = :username COLLATE Latin1_General_CS_AS && Password = :password COLLATE Latin1_General_CS_AS ";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $user = $statement->fetch();

        //Correct User
        if ($statement->rowCount() >= 1) {
            session_start();
            $_SESSION['UserId'] = $user['UserID'];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Password'] = $user['Password'];
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