<?php
session_start();
// Create connection
$conn = new mysqli('localhost', 'root', '', 'accessaciti');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["valid"]) && $_SESSION["valid"]){

    $user_id = $_SESSION['userid'];
    $newpassword = $_POST['password'];
    $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);
    $conn_check = $conn->query("SELECT password_hash FROM account WHERE user_id = $user_id");

    if (password_verify($newpassword, $conn_check->fetch_assoc()['password_hash'])) {
        $fetch = $conn->query("DELETE FROM FavoriteIssues WHERE user_id = $user_id");
        $fetch2 = $conn->query("DELETE FROM account WHERE user_id = $user_id");
        if ($fetch === True && $fetch2 === True)
        {
            session_destroy();
            header ("location: home.php");
            exit();
        } else
        {
            echo "Error deleting record: " . $conn->error;
        }
    }

} else {
    echo "You are not logged in";
}
