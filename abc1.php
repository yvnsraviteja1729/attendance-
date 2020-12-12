<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "USE nitpy";
$res=$conn->query($sql) ;
$SUB_ID = test_input(strval($_GET["crs_id"]));
$sql="update lock_table set lock_value=0 where COURSE_ID='".$SUB_ID."'";
$res=$conn->query($sql) ;
//echo "data base is locked";

echo $SUB_ID;
    header('Location:error.php') ;
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $conn->close();
  //  echo "completed";

 ?>
