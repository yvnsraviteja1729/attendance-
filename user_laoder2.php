<?php
session_start();
// echo $_SESSION['fac_id'];

 $servername = "localhost";
 $username = "root";
 $password = "";
 $database =  "nitpy";
 $conn = new mysqli($servername, $username, $password,$database);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT COURSE_ID FROM course WHERE COURSE_FACULTY='".$_SESSION['fac_id']."'";
 $res = $conn->query($sql);
 $html = "<SELECT name='sub_code' oninput='fun1(this.value)' id='i3' style='width: 200px; height:30px' required><option></option>";
 while($row = $res->fetch_array(MYSQLI_NUM))
 {
  	$html = $html."<option value='".$row[0]."'>".$row[0]."</option>";
 }
 $html = $html."</SELECT>";

 echo $html;
?>
