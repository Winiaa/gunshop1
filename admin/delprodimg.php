<?php
session_start();
require_once '../config/connect.php';

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT thumb FROM products WHERE id=?";
    $stmt = mysqli_prepare($connection, $sql);

    // Here to use a prepare statment to make the code more secure
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $r = mysqli_fetch_assoc($res);

        if (file_exists($r['thumb']) && is_file($r['thumb'])) {
            if (unlink($r['thumb'])) {
                $delsql = "UPDATE products SET thumb='' WHERE id=?";
                $delstmt = mysqli_prepare($connection, $delsql);
        
                if ($delstmt) {
                    mysqli_stmt_bind_param($delstmt, "i", $id);
        
                    if (mysqli_stmt_execute($delstmt)) {
                        header("location: editproduct.php?id={$id}");
                        exit;
                    } else {
                        echo "Error updating thumb column: " . mysqli_error($connection);
                    }
        
                    mysqli_stmt_close($delstmt);
                } else {
                    echo "Error preparing delete statement: " . mysqli_error($connection);
                }
            } else {
                echo "Error deleting file: " . error_get_last()['message'];
            }
        } else {
            echo "File does not exist or is not a regular file.";
        }
        
    }
}
