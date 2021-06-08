<?php
session_start();

if (!(isset($_SESSION["valid"]) && $_SESSION["valid"])) {
    header("Location: change email not logged in.html");
    exit();
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Change email address</title>
    </head>
    <body>
        <h1>Change email:</h1>
        <form method="POST" action="change email handle.php">
            <div class="form-group">
                <label for="new_email">New Email</label></br>
                <input type="email" name="new_email" class="form-control" placeholder="Email" required><br>
            </div>
            <input type="submit" name="Save" class="btn btn-primary">
        </form>
    </body>
</html>