<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);

    if(!(isset($_POST["w3lName"]) && isset($_POST["w3lSender"]) && isset($_POST["w3lSubject"]) && isset($_POST["w3lMessage"])))
    {
        echo "wow you bypassed the front end validation somehow. Are you a hacker?<br>";
        echo "I would say contact us if not, but that's what you just tried to do<br>";
        echo "Well, maybe try phoning or emailing us instead to tell us about this as I am quite curious how you got here without hacking";
        exit();
    }
    require("connect to database.php");
    $conn = connect_to_database();

    $Name = mysqli_real_escape_string($conn, $_POST["w3lName"]);
    $Email = mysqli_real_escape_string($conn, $_POST["w3lSender"]);
    $Subject = mysqli_real_escape_string($conn, $_POST["w3lSubject"]);
    $Message = mysqli_real_escape_string($conn, $_POST["w3lMessage"]);

    $querystring = "INSERT INTO ContactDetails (Name, Email, Subject, Message)
    VALUES ('$Name', '$Email', '$Subject', '$Message')";

    if($conn->query($querystring) === True)
    {
        header("location: contact successful.html");
        exit();
    } else {
        echo "could not submit query";
        exit();
    }


}
