<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title>Log out page</title>
    </head>
    <body>
        <?php
        session_start();
        session_destroy();
        echo "You have successfully logged out"
        ?>
        <button onclick="document.location='/'">Back to home page</button>
    </body>
<html>