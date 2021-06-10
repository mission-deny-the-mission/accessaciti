<?php
session_start();
// Create connection
$conn = new mysqli('localhost', 'root', '', 'accessaciti');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["valid"]) && $_SESSION["valid"]) :

    $user_id = $_SESSION['username'];
    $newpassword = $_POST['password'];
    $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);
    $conn_check = $conn->query("SELECT password_hash FROM user = '$password_hash' WHERE username ='user_id'");
    
    if (password_verify($newpassword, $conn_check['password_hash'])) :
        $fetch = $conn->query("DELETE FROM users WHERE user_id='$user_id'");
        if ($fetch === True) 
        {
            header ("location: DeleteAccSuccessful.html");
           exit();
        } else 
        {
            echo "Error deleting record: " . $conn->error;
            
    }endif;

else:
echo "You are not logged in";
endif;
