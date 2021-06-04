<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    if (isset($_SESSION["valid"]) && $_SESSION["valid"])
    {
        require("connect to database.php");
        $conn = connect_to_database();
        $email = mysqli_real_escape_string($conn, $_POST["new_email"]);

        $queryString = "UPDATE user SET email = '$email' WHERE user_id = " . $_SESSION["userid"] . ";";
        if ($conn->query($queryString) === True)
        {
            header("location: change email success.html");
            exit();
        }else
        {
            echo "Could not run the query";
        }
    } else
    {
        header("location: change email not logged in.html");
        exit();
    }
}
?>