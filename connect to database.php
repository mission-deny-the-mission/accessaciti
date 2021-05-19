<?php
function connect_to_database() {
    $serveraddr = "localhost";
    $username = "root";
    $password = "";
    $database = "accessaciti";

    $conn = new mysqli($serveraddr, $username, $password, $database);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>