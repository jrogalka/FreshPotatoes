<?php
    include 'connect.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = $_POST['password2'];
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstname = $_POST['firstname'];
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = $_POST['lastname'];
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);

        $existsQuery = "SELECT * FROM users
                        WHERE Username = :username";
        $existsStatement = $db->prepare($existsQuery);
        $existsStatement->bindValue(':username', $username);
        $existsStatement->execute();

        //Check if user exists
        if ($existsStatement->rowCount() > 0) {
            echo '<script language="javascript">';
            echo 'alert("Username Already Exists.");';
            echo 'window.location.href = "register.html";';
            echo '</script>';
        }
        else {
            //Ensure data is entered. 
            if (strlen($username) < 1) {
                echo '<script language="javascript">';
                echo 'alert("Username must have at least 1 character.");';
                echo 'window.location.href = "register.html";';
                echo '</script>';
            }
            if (strlen($password) < 1) {
                echo '<script language="javascript">';
                echo 'alert("Password must have at least 1 character.");';
                echo 'window.location.href = "register.html";';
                echo '</script>';
            }
            if ($password != $password2) {
                echo '<script language="javascript">';
                echo 'alert("Passwords must match.");';
                echo 'window.location.href = "register.html";';
                echo '</script>';
            }
            if (strlen($email) < 1) {
                echo '<script language="javascript">';
                echo 'alert("Email must have at least 1 character.");';
                echo 'window.location.href = "register.html";';
                echo '</script>';
            }
            if (strlen($firstname) < 1) {
                echo '<script language="javascript">';
                echo 'alert("First name must have at least 1 character.");';
                echo 'window.location.href = "register.html";';
                echo '</script>';
            }
            if (strlen($lastname) < 1) {
                echo '<script language="javascript">';
                echo 'alert("Last name must have at least 1 character.");';
                echo 'window.location.href = "register.hmtl";';
                echo '</script>';
            }
            else {
                $query = "INSERT INTO users (Username, Password, Email, FirstName, LastName) VALUES (:username, :password, :email, :firstname, :lastname)";
                $statement = $db->prepare($query);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $password);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':firstname', $firstname);
                $statement->bindValue(':lastname', $lastname);
                $statement->execute();

                $UserID = $db->lastInsertId();
                
                $_SESSION['UserId'] = $UserID;
                $_SESSION['Username'] = $username;
                $_SESSION['Password'] = $password;
                $_SESSION['Role'] = 0;

                header('Location: index.php');
            }
        }
    }
    else {
        echo '<script language="javascript">';
        echo 'alert("This page cannot be accessed.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }
        
?>