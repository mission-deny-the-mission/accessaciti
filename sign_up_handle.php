<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("connect to database.php");
    $conn = connect_to_database();

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($username == "" || $firstname == "" || $lastname == "" || $password == "") {
        header("Location: required_field_is_blank.html");
        exit();
    }

    if (!($password == $confirm_password)) {
        header("Location: passwords_dont_match.html");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $previous_usernames = $conn->query("SELECT username FROM account WHERE username = '$username'");

    if ($previous_usernames->num_rows > 0) {
        header("Location: username_already_exists.html");
        $conn->close();
        exit();
    }

    // TODO: find out if this is the best way to check for null
    if ($email == "") {
        $query = "INSERT INTO account (username, firstname, lastname, password_hash)
            VALUES ('$username', '$firstname', '$lastname', '$password_hash');";
    } else {
        $query = "INSERT INTO account (username, firstname, lastname, email, password_hash)
            VALUES ('$username', '$firstname', '$lastname', '$email', '$password_hash');";
    }

    if ($conn->query($query) === TRUE) {
        echo "Sign up was successful<br>";
        header("Location: home.php");
        $conn->close();
        exit();
    } else {
        echo $query;
        echo "<br><br>";
        echo "an error occured executing the query<br><br>";
        echo mysqli_error($conn);
    }

    $conn->close();
} else {
    echo "You should not be here";
}
