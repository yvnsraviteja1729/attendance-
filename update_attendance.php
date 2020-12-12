<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // isset($_POST["sub_code"]) or die("No results found<br>Insertion unsuccessful<br>No students found in class");
  $SUB_ID = test_input($_POST["sub_code"]);
  $ATT_DATE = test_input($_POST["att_date"]);
  $START_TIME = test_input($_POST["start_time"]);
  $END_TIME= test_input($_POST["end_time"]);
  $START_TIME=$ATT_DATE.' '.$START_TIME.'-00';
  $END_TIME=$ATT_DATE.' '.$END_TIME.'-00';
  $TOPIC=test_input($_POST["topic"]);
  $servername = "localhost";
  $username = "root";
  $password = "";
  $conn = new mysqli($servername, $username, $password);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql="USE nitpy";
  $conn->query($sql);
 $sql="SELECT lock_value FROM lock_table WHERE COURSE_ID='".$SUB_ID."'";
  $res1=$conn->query($sql) ;
  $row1 = $res1->fetch_array(MYSQLI_NUM);
  //echo $row1[0];
  if($row1[0]==1){

    $sql = "SELECT ROLL_NO FROM course_reg WHERE COURSE_ID='".$SUB_ID."'";
  $res=$conn->query($sql) ;

  while($row = $res->fetch_array(MYSQLI_NUM)) {
  $ATT= test_input($_POST[$row[0]]);


  $sql="INSERT INTO attendances (ROLL,COURSE_ID,CLASS_START,CLASS_END,ATTENDANCE) VALUES('$row[0]','$SUB_ID','$START_TIME','$END_TIME','$ATT')";
  $conn->query($sql);
  $sql="INSERT INTO TOPIC VALUES ('$SUB_ID','$START_TIME','$END_TIME','$TOPIC')";
  $conn->query($sql);
}
header('Location:reload.php');

}
else {
    header('Location:error.php') ;
}
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();

?>
