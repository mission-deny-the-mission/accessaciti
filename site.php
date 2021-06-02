<?php

  $conn = new mysqli('localhost', 'root', '', 'accessaciti');

  $description =   $_POST['description'];
  $latitude    =   $_POST['latitude'];
  $longitude   =   $_POST['longitude'];

  $sq2 = "SELECT location_id FROM location
  WHERE longitude = $longitude AND latitude = $latitude;";

  $result = $conn->query($sq2);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $location_id = $row["location_id"];
  } else {

    $sq3 = "INSERT INTO 'location' (, lat_loc, long_loc)
  VALUES ($lat_loc, $long_loc)";

    if ($conn->query($sq3) === TRUE) {
      $location_id = $conn->insert_id;
      echo "query executed successfully\n";
    } else {
      echo "an error occured executing the query\n";
    }
  }

  $sql = "INSERT INTO 'issue' (description, latitude, longitude, date)
  VALUES ($description, $latitude, $longitude, curdate())";

  if ($conn->query($sql) === TRUE) {
    echo "query executed successfully\n";
  } else {
    echo "an error occured executing the query\n";
  }


  $sql = "INSERT INTO date values (curdate())";

  ?>
