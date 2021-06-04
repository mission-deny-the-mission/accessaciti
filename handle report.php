<?php

$conn = new mysqli('localhost', 'root', '', 'accessaciti');

$description  =   $_POST['description'];
$latitude     =   $_POST['latitude'];
$longitude    =   $_POST['longitude'];

if (isset($_POST['illegality'])) {
    echo "illegal";
    $illegality = 1;
} else {
    $illegality = 0;
}

$sq2 = "SELECT location_id FROM location
WHERE long_loc = $longitude AND lat_loc = $latitude;";

$result = $conn->query($sq2);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $location_id = $row["location_id"];
} else {
    $sq3 = "INSERT INTO Location (lat_loc, long_loc)
    VALUES ($latitude, $longitude)";

    if ($conn->query($sq3) === TRUE) {
        $location_id = $conn->insert_id;
        echo "query executed successfully\n";
    } else {
        echo "an error occured executing the query\n";
        exit();
    }
}

$sql = "INSERT INTO issue (issue_description, illegality, location_id, current_rating, rating_count, rating_text, date_submitted)
VALUES ('$description', $illegality, $location_id, 0, 0, '', curdate())";

echo $sql . "<br>";

if ($conn->query($sql) === TRUE) {
    header("location: report successful.html");
    exit();
} else {
    header("location: report unsuccessful.html");
    exit();
}
?>