<?php
  session_start();
  include('connect to database.php');

  $conn = connect_to_database();

  $issue = mysqli_real_escape_string($conn, $_POST['hid_issID']);
  $user = $_SESSION['userid'];

  $sql = "INSERT INTO `favoriteissues` (`user_id`, `issue_id`) VALUES ('$user', '$issue')";
  $result = mysqli_query($conn, $sql);
  header("location: home.php");

?>
