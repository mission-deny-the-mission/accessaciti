<?php

include('connect to database.php');
$con = connect_to_database();

$description = mysqli_real_escape_string($con, $_POST['txt_description']);
$latitude = mysqli_real_escape_string($con, $_POST['reportLat']);
$longitude = mysqli_real_escape_string($con, $_POST['reportLong']);
$type = mysqli_real_escape_string($con, $_POST['sel_type']);

if($latitude != null && $latitude != '' && $longitude != null && $longitude != '')
{

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
      $sql3 = "INSERT INTO `issue` (`issue_description`, `location_id`, `type_id`, `current_rating`, `rating_count`, `rating_text`, `date_submitted`) VALUES ('$description', '$location_id', '$type', '0', '0', 'The helpfulness of this report is unknown', curdate())";
      $rs3 = mysqli_query($con,$sql3);
      header("location: home.php");
    }
  }
  else{echo 'sql2';}
}
else{echo 'sql1';}

}
else {echo"<b1><p>AccessaCiti cannot access this device's location. Please check your browser settings or try again later. </p> <button onclick=\"document.location='home.php'\">Back to Home</button></b1>";}










 ?>
