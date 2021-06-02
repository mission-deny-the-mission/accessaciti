<?php
session_start();

require("connect to database.php");
$conn = connect_to_database();

$queryString = "SELECT issue.issue_id, issue.issue_description, issue.illegality,
location.long_loc, location.lat_loc, issue.current_rating
FROM issue, location
WHERE issue.location_id = location.location_id;";

$result = $conn->query($queryString);

if (!$result) {
    echo "an error occured running the query";
    exit();
}

if (isset($_SESSION["valid"]) && $_SESSION["valid"]) {
    $query2 = "SELECT issue_id FROM FavoriteIssues WHERE user_id = " . $_SESSION["userid"] . ";";
    $favorites = $conn->query($query2);
    $hasfavorites = true;
} else {
    $hasfavorites = false;
}
?>

<html>

<head>
    <link rel="stylesheet" href="main.css">
    <title>Saved issues</title>
</head>

<body>
    <h1>Saved issues</h1>
    <table>
        <tr>
            <th>Issue ID</th>
            <th>Description</th>
            <th>illegality</th>
            <th>longitude</th>
            <th>latitude</th>
            <th>current rating</th>
            <?php
            if ($hasfavorites) {
                echo "<th>favorite</th>";
            }
            ?>
        </tr>
        <?php
        if ($result->num_rows > 1) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["issue_id"] . "</td>";
                echo "<td>" . $row["issue_description"] . "</td>";
                echo "<td>" . $row["illegality"] . "</td>";
                echo "<td>" . $row["longitude"] . "</td>";
                echo "<td>" . $row["latitude"] . "</td>";
                echo "<td>" . $row["current_rating"] . "</td>";
                if ($hasfavorites) {
                    $favorite_id = $favorites->fetch_assoc()["issue_id"];
                    if ($favorite_id == $row["issue_id"]) {
                        echo "<td>Yes</td>";
                    } else {
                        echo "<td>No</td>";
                    }
                }
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>