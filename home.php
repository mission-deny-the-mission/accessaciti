<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" href="home_style.css">
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
  <style>body {background-color: #3489eb;}#btn_report {
    background-color: #1b17e8;
    color: white;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
    height: 10%;
    top: 10%;
    right: 75%;
    width: 15%;
  }
  #reportPopup {
    display: none;
    position: fixed;
    top: 50%
    left 10%;
    border: 3px solid #f1f1f1;
    z-index: 9;
  }
  #filter{
    background-color: #ffffff;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
    height: 25%;
    right: 90%;
    width: 8%;
    bottom: 3%
  }
  #steps {background-color: #4287f5; bottom: 16%}
  #obstruction {background-color: #ff00bf; bottom: 10%}
  #surface {background-color: #5eff00; bottom: 4%}
</style>
</head>
<body>
  <?php
  require('connect to database.php');
  $conn = connect_to_database();
  $pfilterToggles = [1,2,3,4]; ?>
  <script>
    let allMarkers = [];
    let filterToggles = [1,2,3,4];
  </script>
  <?php
      session_start();
      if (isset($_SESSION["valid"]) && $_SESSION["valid"])
      {
        $loggedId = $_SESSION["userid"];
        $sql1 = "SELECT `email` FROM `account` WHERE `user_id` = '$loggedId'";
        $rs1 = mysqli_query($conn,$sql1);
        $row = mysqli_fetch_assoc($rs1);
        $loggedIn = $row['email'];
        echo"  <button class=\"open-button\" onclick=\"openPopup('optionsPopup')\">$loggedIn</button>
        <div class=\"form-popup\" id=\"optionsPopup\">
        <form action=\"/action_page.php\" class=\"form-container\">
          <h1>$loggedIn</h1>
          <button type=\"button\" class=\"btn link\" onclick=\"window.location.href='log out.php'\">Sign Out</button>
          <button type=\"button\" class=\"btn link\" onclick=\"window.location.href='saved_issues.php'\">My Saved Issues</button>
          <button type=\"button\" class=\"btn link\" onclick=\"window.location.href='change password.php'\">Change Password</button>
          <button type=\"button\" class=\"btn link\" onclick=\"window.location.href='change email.php'\">Change Email Address</button>
          <button type=\"button\" class=\"btn link\" onclick=\"window.location.href='DeactivateAccount.html'\">Delete Account</button>
          <button type=\"button\" class=\"btn cancel\" onclick=\"closePopup('optionsPopup')\">Close</button>
        </form>
        </div>";
      }
      else
      {
        echo "<button class=\"open-button\" onclick=\"openPopup('loginPopup')\">Log In</button>
        <div class=\"form-popup\" id=\"loginPopup\">
        <form method = \"POST\" action=\"login_new.php\" class=\"form-container\">
        <h1>Login</h1>
        <label for=\"email\"><b>Email</b></label>
        <input type=\"text\" placeholder=\"Enter Email\" name=\"username\" required>
        <label for=\"psw\"><b>Password</b></label>
        <input type=\"password\" placeholder=\"Enter Password\" name=\"password\" required>
        <button type=\"submit\" class=\"btn\">Login</button>
        <button type=\"button\" class=\"btn cancel\" onclick=\"closePopup('loginPopup')\">Close</button>
        </form>
        </div>";

        echo "<button class=\"open-button1\" id=\"signup_button\" onclick=\"window.location.href='signup.html'\">Sign Up</button>";
      }
      ?>
  <script>
    function openPopup(popup) {
      document.getElementById(popup).style.display = "block";
    }

    function closePopup(popup) {
      document.getElementById(popup).style.display = "none";
    }
  </script>
<div id='map' style='position: fixed; bottom: 3%; right: 1%; width: 89%; height: 87%;'></div>

<p id="centerID"></p>

<script>
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
    centerLat = position.coords.latitude;
    centerLong = position.coords.longitude;
    savedCenter();
  }
  function savedCenter()
  {
    var savLat = localStorage.getItem("lat");
    var savLong = localStorage.getItem("long");
    if (savLat != null && savLong != null)
    {
      centerLat = savLat;
      centerLong = savLong;
    }
  }
  mapboxgl.accessToken = 'pk.eyJ1IjoiYS1ib2x0b24iLCJhIjoiY2twZmE2NTZxMDl2cDJucW9pbWZkNWltMSJ9.wv5-c8TsmWg5TCVdlhLiLA';
  var map = new mapboxgl.Map({
    container: 'map',
    center: [centerLong,centerLat],
    zoom: 15,
    style: 'mapbox://styles/mapbox/streets-v11'
  });
</script>





<?php
function addMarks($arr,$conn){

foreach ($arr as $i => $value) {
  markerMaker($value,$conn);
}
}
addMarks([1,2,3,4],$conn);
?>


<?php
  function markerMaker($display_type,$conn)
  {
  $sql = "SELECT issue.issue_id, type.type_colour, issue.issue_description, issue.rating_text, location.lat_loc, location.long_loc FROM issue, location, type WHERE issue.location_id = location.location_id AND issue.type_id = type.type_id AND type.type_id = $display_type";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $Desc = $row["issue_description"];
      $Id = $row["issue_id"];
      $Lat = $row["lat_loc"];
      $Long = $row["long_loc"];
      $Rat = $row["rating_text"];
      $colour = $row["type_colour"];
      if(isset($_SESSION['valid']) && $_SESSION["valid"]){$save = "<form action='save_issue.php', method='POST'><input type='hidden', name='hid_issID', value='$Id'><input type='submit', value = 'Save'></form>";}
      else {$save = "";}
      echo "<script>var marker = new mapboxgl.Marker({color: '$colour'}).setLngLat([$Long,$Lat]).setPopup(new mapboxgl.Popup().setMaxWidth('300px').setHTML(\"<h1>$Desc</h1><body>$Rat<br><form method='POST', action='adjust_rating.php'><input type='hidden', id= 'hid_issID', name= 'hid_issID', value='$Id'><input type='hidden' id='hid_direction' name='hid_direction' value='1'><input type='submit' value = 'I found this report helpful.'></form><form method='POST', action='adjust_rating.php'><input type='hidden', id= 'hid_issID', name= 'hid_issID', value='$Id'><input type='hidden' id='hid_direction' name='hid_direction' value='-1'><input type='submit' value = 'I found this report unhelpful.'></form><br> ".$save." </body>\")).addTo(map); allMarkers.push(marker);</script>";
    }
  }
  }
  ?>

<button class="signin-button" id="btn_report" onclick="openReportPopup('reportPopup')">Report Issue</button>
<div id="reportPopup">
  <form method="POST" action="log_report.php" class="form-container">
    <h1>Report Issue</h1>
    <input type="text" class="text" id="txt_description" name="txt_description" placeholder="Enter Issue Description">
    <select name="sel_type" id="sel_type">
      <option value="1">Steps</option>
      <option value="2">Obstruction</option>
      <option value="3">Surface</option>
    </select>
    <br>
    <input type="hidden" id="reportLat" name="reportLat" value="">
    <input type="hidden" id="reportLong" name="reportLong" value="">
    <br>
    <button type="submit" class="btn">Submit Report</button>
    <button type="button" class="btn cancel" onclick="closePopup('reportPopup')">Close</button>
  </form>
</div>

<div id="filter">
<center><h2>FILTER</h2></center>
 <form action="" method="post" name ="filter">
  <button class="btn_filter" name="steps" id="steps">STEPS</button><br>
  <button class="btn_filter" name="obstruction"  id="obstruction">OBSTRUCTION</button><br>
  <button class="btn_filter" name="surface" id="surface">SURFACE</button>
  </form>

</div>



  <form>
    <input type= 'hidden' id= "saveLat" value= "">
    <input type= 'hidden' id= "saveLong" value= "">
  </form>
<script>
  window.onbeforeunload = saveCenter();
  function saveCenter()
  {
    saveCent();
    var lat = document.getElementById('saveLat').value;
    var long = document.getElementById('saveLong').value;
    localStorage.setItem("lat", lat);
    localStorage.setItem("long", long);
  }
</script>

<script>
function saveCent()
{
var presCent = map.getCenter();
var presLat = presCent.lat;
var presLong = presCent.lng;
var x = document.getElementById("saveLat");
var y = document.getElementById("saveLong");
x.value = presLat;
y.value = presLong;
}
</script>

<script>
closePopup('reportPopup');
  function openReportPopup(popup) {
    navigator.geolocation.getCurrentPosition(enterCurrentPosition);
    document.getElementById(popup).style.display = "block";
    }
  function enterCurrentPosition(location){
    document.getElementById("reportLat").value = location.coords.latitude;
    document.getElementById("reportLong").value = location.coords.longitude;
  }
</script>
<script>
function filter(x){
  clearMarks();
  toggleMark(x);
}
</script>
<script>
function clearMarks(){
  if (allMarkers!=null)   {
    for (var i = allMarkers.length - 1; i >= 0; i--) {
      allMarkers[i].remove();
    }
  }
}
</script>


<?php
  if (!isset($_SESSION["toggle1"])){$_SESSION["toggle1"] = True;}
  if (!isset($_SESSION["toggle2"])){$_SESSION["toggle2"] = True;}
  if (!isset($_SESSION["toggle3"])){$_SESSION["toggle3"] = True;}

  function addAll($conn){
    if ($_SESSION["toggle1"]){markerMaker(1,$conn);}
    if ($_SESSION["toggle2"]){markerMaker(2,$conn);}
    if ($_SESSION["toggle3"]){markerMaker(3,$conn);}
  }
  ?>


<?php
 if(isset($_POST["steps"])){
     echo "<script> clearMarks()</script>";
     if ($_SESSION["toggle1"]){$_SESSION["toggle1"] = False;}
     else {$_SESSION["toggle1"] = True;}
     addAll($conn);
 }
 if(isset($_POST["obstruction"])){
     echo "<script> clearMarks()</script>";
     if ($_SESSION["toggle2"]){$_SESSION["toggle2"] = False;}
     else {$_SESSION["toggle2"] = True;}
     addAll($conn);
 }
 if(isset($_POST["surface"])){
     echo "<script> clearMarks()</script>";
     if ($_SESSION["toggle3"]){$_SESSION["toggle3"] = False;}
     else {$_SESSION["toggle3"] = True;}
     addAll($conn);
 }
 else{

 }
 ?>

</body>
</html>
