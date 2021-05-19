<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("connect to database.php");
    $conn = connect_to_database();

    $username = mysql_real_escape_string($_POST['username']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // TODO: find out if this is the best way to check for null
    if ($email == "")
    {
        $query = "INSERT INTO users (username, firstname, lastname, password_hash)
            VALUES ($username, $firstname, $lastname, $password_hash);";
    } else {
        $query = "INSERT INTO users (username, firstname, lastname, email, password_hash)
            VALUES ($username, $firstname, $lastname, $email, $password_hash";
    }

    if ($conn->query($sql) === TRUE) {
        echo "query executed successfully\n";
    } else {
        echo "an error occured executing the query\n";
    }

    $conn->close();

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