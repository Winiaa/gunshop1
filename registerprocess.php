<?php
session_start();
require_once 'config/connect.php';

if (isset($_POST) && !empty($_POST)) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($result) {
        $_SESSION['customer'] = $email;
        $_SESSION['customerid'] = mysqli_insert_id($connection);
        // Registration successful, you might want to redirect to a different page
        header("location:checkout.php");
        // echo "User registered successfully!";
    } else {
        // Registration failed
        // echo "Registration failed!";
        header('location: login.php?message=2');
    }
}
?>
