<?php
function connect_to_database()
{
    if (file_exists("../watIndex.html") || file_exists("watIndex.html")){
        $serveraddr = "stu-db.aet.leedsbeckett.ac.uk:3306";
        $username = "";
        $password = "";
        $database = "";
    } else {
        $serveraddr = "localhost";
        $username = "root";
        $password = "";
        $database = "accessaciti";
    }

    $conn = new mysqli($serveraddr, $username, $password, $database);

    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>