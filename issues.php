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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Saved issues</title>
</head>

<body>
    <h1>Saved issues</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Description</th>
                <th scope="col">illegality</th>
                <th scope="col">longitude</th>
                <th scope="col">latitude</th>
                <th scope="col">current rating</th>
                <?php
                if ($hasfavorites) {
                    echo "<th>favorite</th>";
                }
                ?>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["issue_id"] . "</td>";
                echo "<td>" . $row["issue_description"] . "</td>";
                echo "<td>" . $row["illegality"] . "</td>";
                echo "<td>" . $row["long_loc"] . "</td>";
                echo "<td>" . $row["lat_loc"] . "</td>";
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
    <button type="button" class="btn btn-primary" onclick="document.location='index.php'">
    Back to home page</button>
</body>

</html>