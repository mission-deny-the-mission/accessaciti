<?php
session_start();
if (isset($_SESSION["valid"]) && $_SESSION["valid"]) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AccessaCita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="wrapper">
            <div class="logo">
                <img src="logo_small.png" alt="">
            </div>
            <ul class="nav-area">
                <li><a href="#">About</a></li>
                <li><a href="issues.php">List of issues</a></li>
                <li><a href="submit report.html">Submit bulding report</a></li>
                <?php
                if (!$loggedIn) {
                    echo "<li><a href='login.php'>Login</a></li>\n";
                    echo "<li><a href='Signup.html'>Sign Up</a></li>\n";
                } else {
                    echo "<li><a href='change password.php'>Change Password</a></li>\n";
                    echo "<li><a href='log out.php'>Logout</a></li>\n";
                }
                ?>
                <li><a href="Contact.html">Contact</a></li>
            </ul>
        </div>
        <div class="welcome-text">
            <h1>
                Here To <span>Help</span></h1>
            <a href="Contact.html">Contact US</a>
        </div>
    </header>

</body>

</html>