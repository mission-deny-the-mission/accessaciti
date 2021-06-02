<?php
session_start();

if (isset($_SESSION["valid"]) && $_SESSION["valid"]) {
    echo "You have logged in successfully<br>";
    echo "Your username is " . $_SESSION["username"];
} else {
    echo "You are not logged in";
}
