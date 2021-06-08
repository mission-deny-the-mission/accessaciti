<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>

<body>
    <h1>Welcome To Accessaciti</h1>
    <?php
    $error = false;
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
                $error = true;
            }
        } else if ($users->num_rows > 1) {
            $msg = "Error: more than one user found with that username/email";
            $error = true;
        } else {
            $msg = "Could not find a user associated with that username or email";
            $error = true;
        }
    }
    ?>
    <form url="login.php" method="POST">
        <br>
        <div class="col-md-6">
            <label for="fname"> Email Address/Username:</label><br>
            <input type="text" id="fname" name="username" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="fPassword">Password:</label><br>
            <input type="password" id="fPassword" name="password" class="form-control" required>
        </div>
        <?php
        if ($error) {
            echo "<br>";
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                </svg>';
            echo $msg;
            echo "<br>";
        }
        ?>
        <br>
        <button value="Submit" class="btn btn-primary">Sign In</button>
    </form>
    <br>
    <br>

    <body>

</html>