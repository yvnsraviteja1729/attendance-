<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
    $q = strval($_GET['crs_id']);
    //echo "hello<br>hello<br>hello<br>hello<br>hello<br>";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "USE nitpy";
  $res=$conn->query($sql) ;
      $sql = "SELECT ROLL_NO FROM course_reg WHERE COURSE_ID='".$q."'";
    $res=$conn->query($sql) ;
    if ($res->num_rows > 0) {
    while($row = $res->fetch_array(MYSQLI_NUM)) {
  echo $row[0]."<label>&nbsp present</lable><input type='radio' name='".$row[0]."' value='PRESENT' checked>absent<input type='radio' name='".$row[0]."' value='ABSENT' ><br><br>";

     }
     }
      else {
     echo "0 results";
     }$conn->close();
     ?>
  </body>
</html>
