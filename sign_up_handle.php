<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include("connect to database.php");
    $conn = connect_to_database();

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // TODO: find out if this is the best way to check for null
    if ($email == "")
    {
        $query = "INSERT INTO user (username, firstname, lastname, password_hash)
            VALUES ('$username', '$firstname', '$lastname', '$password_hash');";
    } else {
        $query = "INSERT INTO user (username, firstname, lastname, email, password_hash)
            VALUES ('$username', '$firstname', '$lastname', '$email', '$password_hash');";
    }

    if ($conn->query($query) === TRUE) {
        echo "query executed successfully<br>";
    } else {
        echo $query;
        echo "<br>";
        echo "an error occured executing the query<br>";
        echo mysqli_error($conn);
    }

    $conn->close();

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