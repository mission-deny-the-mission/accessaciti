<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("connect to database.php");
    $conn = connect_to_database();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // TODO: find out if this is the best way to check for null
    if ($email == "")
    {
        $query = "INSERT INTO users (username, password_hash)
            VALUES ($username, $password_hash);";
    } else {
        $query = "INSERT INTO users (username, email, password_hash)
            VALUES ($username, $email, $password_hash";
    }

    // for debugging purposes
    echo $query;
} else {
    echo "You should not be here";
}

/*
$query = "INSERT INTO users (user_name, ";

if(!htmlspecialchars($_POST["email"]) == "")
{
    $query += "email, ";
    
}
$query += "password_hash) VALUES (";

$query += htmlspecialchars($_POST["user_name"]) + ", ";
if(!htmlspecialchars($_POST["email"]) == "")
{
    $query += htmlspecialchars($_POST)
}
*/
?>