<?php
session_start();
try
{
    if ($_SESSION["valid"])
    {
        echo "You have logged in successfully<br>";
        echo "Your username is " . $_SESSION["username"];
    }
    else
    {
        echo "You are not logged in";
    }
}
catch (Exception $e)
{
    echo "You are deffo not logged in";
}
?>