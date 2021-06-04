<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" href="home_style.css">
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
  <style>body {background-color: #3489eb;}</style>
</head>
<body>
  <button class="open-button" onclick="openPopup('optionsPopup')">Account</button>
  <div class="form-popup" id="optionsPopup">
    <form action="/action_page.php" class="form-container">
      <h1>ACCOUNT</h1>
      <button type="button" class="btn link" onclick="window.location.href='signup.html'">Sign Out</button>
      <button type="button" class="btn link" onclick="window.location.href='login.php'">My Saved Issues</button>
      <button type="button" class="btn link" onclick="window.location.href='change_password.php'">Change Password</button>
      <button type="button" class="btn link" onclick="window.location.href='change_password.php'">Change Email Address</button>
      <button type="button" class="btn link" onclick="window.location.href='change_password.php'">Change Password</button>
      <button type="button" class="btn cancel" onclick="closePopup('optionsPopup')">Close</button>
    </form>
  </div>
  <script>
    function openPopup(popup) {
      document.getElementById(popup).style.display = "block";
    }

    function closePopup(popup) {
      document.getElementById(popup).style.display = "none";
    }
  </script>
<div id='map' style='position: fixed; bottom: 23px; right: 28px; width: 1400px; height: 850px;'></div>
<p id="centerID"></p>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYS1ib2x0b24iLCJhIjoiY2twZmE2NTZxMDl2cDJucW9pbWZkNWltMSJ9.wv5-c8TsmWg5TCVdlhLiLA';
var err = document.getElementById("centerID");
var centerLat = 53.82677216974765;
var centerLong = -1.5917173312110902;
centerLocation();
function centerLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setCenter);
  } else {
    err.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function setCenter(position) {
  centerLat = position.coord.latitude;
  centerLong = position.cood.longitude;
}
var map = new mapboxgl.Map({
  container: 'map',
  center: [centerLong,centerLat],
  zoom: 12,
  style: 'mapbox://styles/mapbox/streets-v11'
});

</script>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accessaciti";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT issue.issue_id, issue.issue_description, issue.rating_text, location.lat_loc, location.long_loc FROM issue, location,    WHERE issue.location_id = location.location_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $Desc = $row["issue_description"];
    $Lat = $row["lat_loc"];
    $Long = $row["long_loc"];
    $Rat = $row["rating_text"];
    echo "<script>var marker = new mapboxgl.Marker().setLngLat([$Long,$Lat]).setPopup(new mapboxgl.Popup().setMaxWidth('300px').setHTML(\"<h1>$Desc</h1><body>$Rat<br><form><button type='button' class='btn link' onclick='window.location.href='change_password.php''>I found this report helpful</button><button type='button' class='btn link' onclick='window.location.href='change_password.php''>I found this report unhelpful</button><br><button type='button' class='btn link' onclick='window.location.href='change_password.php''>I encountered this issue today</button></form></body>\")).addTo(map);</script>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>

<button class="open-button1" onclick="openReportPopup('reportPopup')">Report Issue</button>
<div class="form-popup1" id="reportPopup">
  <form method="POST" action="log_report.php" class="form-container">
    <h1>Report Issue</h1>
    <input type="text" class="text" id="txt_description" name="txt_description" placeholder="Enter Issue Description">
    <select name="sel_type" id="sel_type">
      <option value="1">Steps</option>
      <option value="2">Pavement</option>
      <option value="3">Obstruction</option>
      <option value="4">Surface</option>
    </select>
    <input type="hidden" id="reportLat" name="reportLat" value="">
    <input type="hidden" id="reportLong" name="reportLong" value="">
    <button type="submit" class="btn">Submit Report</button>
    <button type="button" class="btn cancel" onclick="closePopup('reportPopup')">Close</button>
  </form>
</div>
<script>
  function openReportPopup(popup) {
    navigator.geolocation.getCurrentPosition(enterCurrentPosition);
    document.getElementById(popup).style.display = "block";
    }
  function enterCurrentPosition(location){
    document.getElementById("reportLat").value = location.coords.latitude;
    document.getElementById("reportLong").value = location.coords.longitude;
  }
</script>

</body>
</html>
