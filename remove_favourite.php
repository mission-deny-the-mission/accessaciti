<?php
include('connect to database.php');
$conn = connect_to_database();

$issue = mysqli_real_escape_string($conn, $_POST['hid_issID']);
$user = mysqli_real_escape_string($conn, $_POST['hid_useID']);

$sql = "DELETE FROM `favoriteissues` WHERE `user_id` = $user AND `issue_id` = $issue";
$rs = mysqli_query($conn,$sql);
header('location: saved_issues.php');
?>
