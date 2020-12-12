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
include ("PHPExcel.php");
require 'IOFactory.php';
  $file=$_FILES['attendance']['tmp_name'];
 $objExcel=PHPExcel_IOFactory::load($file);
 $SUB_ID="";
 foreach($objExcel->getWorksheetIterator() as $worksheet)
 {$highestrow=$worksheet->getHighestRow();
   $row=1;
   $SUB_ID=$worksheet->getCellByColumnAndRow(0,$row)->getValue();}
$sql="SELECT lock_value FROM lock_table WHERE COURSE_ID='".$SUB_ID."'";
 $res1=$conn->query($sql) ;
 $row1 = $res1->fetch_array(MYSQLI_NUM);
 //echo $row1[0];
 if($row1[0]==1){

 foreach($objExcel->getWorksheetIterator() as $worksheet)
 {$highestrow=$worksheet->getHighestRow();
   $row=1;
  //echo "<br><center><h1>DATA IN EXCEL SHEET</h1></center>";
  // echo "<br>SUBJECT ID:-";
    $SUB_ID=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
  // echo "<br>CLASS STARTING TIME:-";
    $START_TIME=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
   //echo "<br>CLASS ENDING TIME:-";
    $END_TIME=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
  // echo "<br>TOPIC:-";
    $TOPIC  =$worksheet->getCellByColumnAndRow(3,$row)->getValue();
  // echo "<br><br><br><br><br>";

   $sql="INSERT INTO TOPIC VALUES ('$SUB_ID','$START_TIME','$END_TIME','$TOPIC')";
   $conn->query($sql);
 	for($row=2;$row<=$highestrow;$row++)
 	{ //echo "ROLL:-";
     $roll=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
    //echo "<br>ATTENDANCE:-";
 	  $course_id=$SUB_ID;
  //  echo "<br>";
    $sql="SELECT EXISTS(SELECT * from course_reg WHERE ROLL_NO='".$roll."' and COURSE_ID='".$course_id."')";
    $res=$conn->query($sql) ;
    $row1 = $res->fetch_array(MYSQLI_NUM);
    $class_start=$START_TIME;
    //echo "<br>";
    $class_end=$END_TIME;
    //echo "<br>";
     $attendace=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
    //echo "<br><br><br><br>";

    $sql = "INSERT INTO attendances values ('".$roll."','".$course_id."','".$class_start."','".$class_end."','".$attendace."')";
    $res=$conn->query($sql) ;
}
$sql="SELECT * FROM course_reg WHERE COURSE_ID='".$SUB_ID."'";
$res3=$conn->query($sql);
  while($row3 = $res3->fetch_array(MYSQLI_NUM)) {
    $a=0;
    for($row=2;$row<=$highestrow;$row++)
   	{
      $roll=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
      if($row3[0]==$roll)
      $a=1;
    }
    if($a==0)
    {
      $sql = "INSERT INTO attendances values ('".$row3[0]."','".$SUB_ID."','$START_TIME','$END_TIME','ABSENT')";
    $res=$conn->query($sql) ;}
}}
header('Location:reload.php');
}
else {
  header('Location:error.php') ;
//echo "database is locked .you cannot enter the attendance details now')";
//  ;
}
 ?>
