<?php

session_start();
include "../connect-db.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);

    if (empty($username) && empty($password)) {
        header("Location: ../index.php?error=Please enter your login information!");
    } 
    else if (empty($username)) {
        header("Location: ../index.php?error=Please enter username!");
    }else if (empty($password)) {
        header("Location: ../index.php?error=Please enter password!");
    }else {
        //Password hashing: MD5 hash generator is useful for encoding passwords
        $password = md5($password);

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connect, $sql);

        echo $password;
        if (mysqli_num_rows($result) === 1) { 
            $row = mysqli_fetch_assoc($result);
            
            if ($row['password'] === $password && $row['role'] == $role) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['date_of_birth'] = $row['date_of_birth'];

                header("Location: ../home.php");

            }else {
                header("Location: ../index.php?error=Incorrect username or password!");
            }

        }else {
            header("Location: ../index.php?error=Incorrect username or password!");
        }
    }
}
else {
    header("Location: ../index.php");
}

