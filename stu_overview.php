<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
 $username = "root";
$password = "";
$database = "nitpy";
$conn = new mysqli("localhost", $username, $password, $database) or die("HEllo");

$q = strval($_GET['crs_id']);
if(strpos($q,"@")){
	$flag=true;
	$position=strpos($q,"@");
	$cs_id=substr($q,$position+1);
	$r_no=substr($q,0,$position);


}
else{
	$flag=false;
}
$html1="<div id='screen' ><span><b>ROLL NUMBER:".strtoupper($q)."</b></span><table cellpadding='15px' class='print_contain' ><tr><th>COURSE_ID</th>";
  /*   */


	if($flag==false){
		  $html1=$html1."<th>presents</th><th>absents</th><th>Attendance precentage</th><th>Details</th>";
    $sql="SELECT DISTINCT  CLASS_START,CLASS_END FROM attendances where ROLL='".$q."'";
      $res=$conn->query($sql)  or die("Wrong");
      $sql = "SELECT COURSE_ID FROM course_reg WHERE ROLL_NO='".$q."'";
    $res=$conn->query($sql) ;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$abc1="";
    while($row = $res->fetch_array(MYSQLI_NUM)) {
      $html1=$html1."<tr><td>".$row[0]."</td>";
      $sql1="SELECT * FROM attendances WHERE COURSE_ID='".$row[0]."'AND ROLL='".$q."'";
      $res1=$conn->query($sql1) ;

$sql3="SELECT COUNT(ATTENDANCE) FROM attendances WHERE ATTENDANCE='PRESENT' AND COURSE_ID='".$row[0]."' AND ROLL='".$q."'";
      $res3=$conn->query($sql3);
      $row3=$res3->fetch_array(MYSQLI_NUM);
      $present=$row3[0];
      $html1=$html1."<td>".$present."</td>";

      $sql2="SELECT COUNT(ATTENDANCE) FROM attendances WHERE ATTENDANCE='ABSENT'AND COURSE_ID='".$row[0]."' AND ROLL='".$q."'";
      $res2=$conn->query($sql2);
      $row2=$res2->fetch_array(MYSQLI_NUM);
      $absent=$row2[0];
      $html1=$html1."<td>".$absent."</td>";
      $html1=$html1."<td>".($present*100/($present+$absent))."%</td><td><a href='#'onclick=fun2('$q@$row[0]') >View Details </a></td>";
     $html1=$html1."</tr>";
    }
	}
	else{
		$sql="SELECT DISTINCT  CLASS_START,CLASS_END FROM attendances WHERE COURSE_ID='".$cs_id."'";
      $res=$conn->query($sql)  or die("Wrong");
		while($row = $res->fetch_array(MYSQLI_NUM)) {
				 $a=substr($row[0],0,10);

				 $html1=$html1."<th>".$a."</th>";
			 }
			 $html1=$html1."</tr> <tr>";
			 $sql1="SELECT * FROM attendances WHERE COURSE_ID='".$cs_id."'AND ROLL='".$r_no."'";
			 $res1=$conn->query($sql1) ;
  $html1=$html1."<td>".$cs_id."</td>";
			  while ($row1 = $res1->fetch_array(MYSQLI_NUM)) {
		 $abc="";
			if($row1[4]=="ABSENT")
			{$abc="ABSENT";}
			else {$abc="PRESENT";
			}
		 $html1=$html1."<td>".$abc."</td>";
	 }
	 $html1=$html1."</tr>";
	}

$html1 = $html1."</table><a href='#' onclick='window.print()' >print</a>";
if($flag){
	$html1=$html1."<a href='#' onclick=fun2('$r_no') style='float:right'>BACK</a>";
}
	$html1=$html1."</div>";
echo $html1;

  ?>
</body>
</html>
