<?php
$connection = mysqli_connect('localhost', 'root', '', 'ecomphp');
if (!$connection) {
    echo "Error: Unable to connect to database or MYSQL" . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
?>
