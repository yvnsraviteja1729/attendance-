<?php
$q = strval($_GET['id']);
//echo "hello<br>hello<br>hello<br>hello<br>hello<br>";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "USE nitpy";
$res=$conn->query($sql);
$q=test_input($q);
$roll=substr($q,0,strpos($q,"_"));
$q=substr($q,strpos($q,"_")+1);
$course_id=substr($q,0,strpos($q,"_"));
$q=substr($q,strpos($q,"_")+1);
$START_TIME=substr($q,0,strpos($q,"_"));
$q=substr($q,strpos($q,"_")+1);
$END_TIME=substr($q,0,strpos($q,"_"));
$q=substr($q,strpos($q,"_")+1);
$original=substr($q,0,strpos($q,"_"));
$q=substr($q,strpos($q,"_")+1);
$value=$q;
echo "ROLL NUMBER:-".$roll." <BR>COURSE ID:-".$course_id."<BR>CLASS STARTING TIME:- ".$START_TIME."<BR>CLASS ENDING TIME ".$END_TIME."<BR>CHANGED FROM ".$original." TO ".$q." is AND IS SAVED<br>";
$sql="UPDATE attendances SET ATTENDANCE='".$value."' WHERE ROLL='".$roll."' AND COURSE_ID='".$course_id."' AND CLASS_START='".$START_TIME."' AND CLASS_END='".$END_TIME."'";
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

//echo $roll." ".$course_id." ".$date." ".$session." ".$period." ".$value."  saved";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();
 ?>
