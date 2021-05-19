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

    $previous_usernames = $conn->query("SELECT username FROM user;");

    if ($previous_usernames->num_rows > 0)
    {
        while ($row = $previous_usernames->fetch_assoc())
        {
            if ($row["username"] === $username)
            {
                echo "That username is taken.";
                $conn->close();
                exit();
            }
        }
    }

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
        echo "Sign up was successful<br>";
        header("Location: sign_up_complete.html");
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
?>