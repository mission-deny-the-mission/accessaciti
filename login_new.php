<?php
ob_start();
session_start();



    $msg = '';
   if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
        require("connect to database.php");
        $conn = connect_to_database();

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $sql = "SELECT * FROM account WHERE username = '$username' OR email = '$username'";

        $users = $conn->query($sql);
        if ($users->num_rows == 1) {
            $user = $users->fetch_assoc();
            if (password_verify($password, $user["password_hash"])) {
                // password is correct you can log the user in now
                $_SESSION["valid"] = true;
                $_SESSION["timeout"] = time();
                $_SESSION["userid"] = $user["user_id"];
                $_SESSION["username"] = $user["username"];
                echo "Hello1";
                header('location: home.php');
                exit();
            } else {
                // password is not correct
                $msg = "The password is incorrect";
            }
        } else if ($users->num_rows > 1) {
            $msg = "Error: more than one user found with that username/email";
        } else {
            $msg = "Could not find a user associated with that username or email";
        }
    }
    ?>
