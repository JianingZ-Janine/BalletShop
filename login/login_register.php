<?php

session_start();
require_once '../Includes/connect_db.php';

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'] ;
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $link->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        $link->query("INSERT INTO users (first_name,last_name,email,pass,reg_date,role) VALUES ('$first_name','$last_name','$email','$pass',NOW(),'$role')");
    }

    header('Location: login.php');
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $result = $link->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();
        if (password_verify($pass, $users['pass'])) {
            $_SESSION['first_name'] = $users['first_name'];
            $_SESSION['last_name'] = $users['last_name'];
            $_SESSION['email'] = $users['email'];
            $_SESSION['user_id'] = $users['user_id'];

            if ($users['role'] === 'admin') {
                header('Location: ../admin/read.php');
            } else {
                header('Location: ../Includes/user.php');
            }
            exit();
        }
    }
    
    $_SESSION['login_error'] = 'Invalid email or password';
    $_SESSION['active_form'] = 'login';
    header('Location: login.php');
    exit();
}

?>