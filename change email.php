<?php
session_start();

if (!(isset($_SESSION["valid"]) && $_SESSION["valid"])) {
    header("Location: change email not logged in.html");
    exit();
}
?>

<html>
    <head>
        <title>Change email address</title>
    </head>
    <body>
        <h1>Change email:</h1>
        <form method="POST" action="change email handle.php">
            <label for="old_email">New Email</label></br>
            <input type="text" name="new_email"><br>
            <input type="submit" name="Save">
        </form>
    </body>
</html>