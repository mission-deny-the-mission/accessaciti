<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>

<body>
    <h1>Welcome To Accessaciti</h1>
    <?php
    $msg = '';
    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
        require("connect to database.php");
        $conn = connect_to_database();

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $sql = "SELECT * FROM USER
WHERE username = '$username' OR email = '$username'";

        $users = $conn->query($sql);
        if ($users->num_rows == 1) {
            $user = $users->fetch_assoc();
            if (password_verify($password, $user["password_hash"])) {
                // password is correct you can log the user in now
                $_SESSION["valid"] = true;
                $_SESSION["timeout"] = time();
                $_SESSION["userid"] = $user["user_id"];
                $_SESSION["username"] = $user["username"];
                header("Location: index.php");
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
    <form url="login.php" method="POST">
        <br>
        <label> Email Address/Username:</label><br>
        <input type="text" id="fname" name="username"><br>
        <br>
        <label>Password:</label><br>
        <input type="password" id="fPassword" name="password">
        <br><br>
        <?php
        echo $msg;
        echo "<br>";
        ?>
        <button value="Submit">Sign In</button>
    </form>
    <br>
    <br>

    <body>

</html>