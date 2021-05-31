<html>
    <head>
        <title>Log out page</title>
    </head>
    <body>
        <?php
        session_destroy();
        echo "You have successfully logged out"
        ?>
    </body>
<html>