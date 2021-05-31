<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title>Log out page</title>
    </head>
    <body>
        <?php
        session_destroy();
        echo "You have successfully logged out"
        ?>
        <button onclick="document.location='index.html'">Back to home page</button>
    </body>
<html>