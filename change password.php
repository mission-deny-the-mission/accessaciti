<?php
session_start();

if (!(isset($_SESSION["valid"]) && $_SESSION["valid"])) {
    header("Location: change password not logged in.html");
    exit();
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Change password</title>
    </head>
    <body>
        <h1>Change password:</h1>
        <form method="POST" action="password change backend.php">
            <div class="form-group">
                <label for="old password">Old password</label><br>
                <input type="password" name="oldpassword" id="old password" class="form-control"
                placeholder="Old Password" required><br>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="new password">New password</label><br>
                    <input type="password" name="newpassword" id="new password" class="form-control" placeholder="Password" required><br>
                </div>
                <div class="form-group col">
                    <label for="repeat password">Verify password:</label><br>
                    <input type="password" name="verifypassword" id="verify password" class="form-control" placeholder="Verify Password" required><br>
                </div>
            </div>
            <input type="submit" name="Change password" class="btn btn-primary">
        </form>
    </body>
</html>