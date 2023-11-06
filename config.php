<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "shop_db";

try {
    $conn = new mysqli($servername, $username, $password, $database);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}

