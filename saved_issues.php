<?php
session_start();

require("connect to database.php");
$conn = connect_to_database();

$user = $_SESSION['userid'];
$queryString = "SELECT issue.issue_description, issue.rating_text, issue.issue_id, type.issue_name
FROM issue, type, favoriteissues
WHERE issue.type_id = type.type_id AND issue.issue_id = favoriteissues.issue_id AND favoriteissues.user_id = '$user'";

$result = $conn->query($queryString);

if (!$result) {
    echo "an error occured running the query";
    exit();
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
                <th scope="col">Type</th>
                <th scope="col">Rating</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $issueId = $row["issue_id"];
                echo "<tr>";
                echo "<td>" . $issueId . "</td>";
                echo "<td>" . $row["issue_description"] . "</td>";
                echo "<td>" . $row["issue_name"] . "</td>";
                echo "<td>" . $row["rating_text"] . "</td>";
                echo "<td> <form method='POST', action='remove_favourite.php'><input type='hidden' name='hid_issID' value='$issueId'><input type='hidden' name='hid_useID' value='$user'><input type='submit' value='REMOVE'></form></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <button type="button" class="btn btn-primary" onclick="document.location='home.php'">
    Back to home page</button>
</body>

</html>
