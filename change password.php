<?php
session_start();

if (!$_SESSION["valid"]) {
    header("Location: change password not logged in.html");
    exit();
}
?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title>Change password</title>
    </head>
    <body>
        <h1>Change password:</h1>
        <form>
            <label for="old password">Old password</label><br>
            <input type="text" name="old password" id="old password"><br>
            <label for="new password">New password</label><br>
            <input type="password" name="new password" id="new password"><br>
            <label for="repeat password">Verify password:</label><br>
            <input type="password" name="verify password" id="verify password"><br>
            <input type="submit" name="Change password">
        </form>
    </body>
</html>