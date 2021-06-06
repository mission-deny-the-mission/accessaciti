<?php

$con = new mysqli('localhost', 'root', '', 'accessaciti');

$direction = $_POST['hid_direction'];
$adjuster = intval($direction);
$issue = $_POST['hid_issID'];

$sql1 = "SELECT `current_rating`, `rating_count` FROM `issue` WHERE `issue_id` = '$issue'";
$rs1 = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($rs1);
$current = $row['current_rating'];
$count = $row['rating_count'];

++$count;
$current = $current + $adjuster;
echo $current;
$percentage = ($current / $count) * 100;

if ($percentage >= 75)
{
  $text = 'Most users found this report very helpful.';
}
elseif ($percentage >= 50)
{
  $text = 'Most users found this report helpful.';
}
elseif ($percentage >= 0)
{
  $text = 'Most users found this report unhelpful.';
}
else
{
  $text = 'Most users found this report very unhelpful.';
}

$sql2 = "UPDATE `issue` SET `rating_text`='$text', `current_rating`='$current', `rating_count`='$count' WHERE `issue_id` = '$issue'";
$rs2 = mysqli_query($con, $sql2);

header("location: home.php");

?>
