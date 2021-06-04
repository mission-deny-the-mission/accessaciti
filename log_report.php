<?php

$con = new mysqli('localhost', 'root', '', 'accessaciti');

$description = $_POST['txt_description'];
$latitude = $_POST['reportLat'];
$longitude = $_POST['reportLong'];
$type = $_POST['sel_type'];

$sql1 = "INSERT INTO `location` (`lat_loc`,`long_loc`) VALUES ('$latitude', '$longitude')";

$rs1 = mysqli_query($con,$sql1);

if($rs1)
{
  $sql2 = "SELECT * FROM `location` WHERE `long_loc` = '$longitude' AND `lat_loc` = '$latitude'";
  $rs2 = mysqli_query($con,$sql2);
  echo mysqli_num_rows($rs2);
  if(mysqli_num_rows($rs2) != 0)
  {
    while($row = mysqli_fetch_assoc($rs2))
    {
      $location_id = $row['location_id'];
      $sql3 = "INSERT INTO `issue` (`issue_description`, `location_id`, `current_rating`, `rating_count`, `rating_text`, `date_submitted`) VALUES ('$description', '$location_id', '0', '0', 'The helpfulness of this report is unknown', curdate())";
      $rs3 = mysqli_query($con,$sql3);
      header("location: home.php");
    }
  }
  else{echo 'sql2';}
}
else{echo 'sql1';}












 ?>
