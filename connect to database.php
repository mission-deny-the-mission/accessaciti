<?php
function connect_to_database() {
    $serveraddr = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($serveraddr, $username, $password);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>