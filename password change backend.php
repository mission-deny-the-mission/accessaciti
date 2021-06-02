<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'accessaciti');
$username = $_SESSION["username"];
$oldpassword = $_POST['old password'];
$newpassword = $_POST['new password'];
$verifypassword = $_POST['verify password'];
$result = $conn->query("SELECT password FROM users WHERE login='$username'");
if (!$result) {
        echo "Username entered does not exist";
} else if ($password != $conn->query($result, 0)) {
        echo "Incorrect password";
}
if ($newpassword = $verifypassword)
        $sql = $conn->query("UPDATE users SET password='$newpassword' where login='$username'");
if ($sql) {
        echo "Password Changed";
} else {
        echo "The new password and confirm new password fields must be the same";
}
