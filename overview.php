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
$sql="SELECT * FROM COURSE WHERE COURSE_ID='".$q."'";
$res9=$conn->query($sql)  or die("Wrong");
$row9 = $res9->fetch_array(MYSQLI_NUM);
    $sql="SELECT DISTINCT CLASS_START,CLASS_END FROM attendances where COURSE_ID='".$q."'";
      $res=$conn->query($sql)  or die("Wrong");
$html1="<div id='screen' ><span class='print_element' ><b>COURSE ID:".strtoupper($q)."<br>COURSE NAME:".$row9[1]."<br>FAC ID:".$row9[2]."<br>SEMESTER:".$row9[3]."<br></b></span><table cellpadding='1px' class='print_contain' ><tr id='abc2'><th><div><span>ROLL NO.</span></div></th>";
      while($row = $res->fetch_array(MYSQLI_NUM)) {
        $a=substr($row[0],0,10);
        $html1=$html1."<th id='abc'><div><span>".$a."</span></div></th>";
      }
      $html1=$html1."<th><div><span>presents</span></div></th><th><div><span>absents</span></div></th><th><div><span>Attendance</br> precentage</span></div></th></tr>";
      $sql = "SELECT ROLL_NO FROM course_reg WHERE COURSE_ID='".$q."'";
    $res=$conn->query($sql) ;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$abc1="";
    while($row = $res->fetch_array(MYSQLI_NUM)) {
      $html1=$html1."<tr><td>".$row[0]."</td>";
      $sql1="SELECT * FROM attendances WHERE ROLL='".$row[0]."'AND COURSE_ID='".$q."'";
      $res1=$conn->query($sql1) ;

        while ($row1 = $res1->fetch_array(MYSQLI_NUM)) {
    $abc="";
     if($row1[4]=="ABSENT")
     {$abc="A";}
     else {$abc="P";
     }
    $html1=$html1."<td id='abcd'>".$abc."</td>";

	}$sql3="SELECT COUNT(ATTENDANCE) FROM attendances WHERE ATTENDANCE='PRESENT' AND ROLL='".$row[0]."' AND COURSE_ID='".$q."'";
      $res3=$conn->query($sql3);
      $row3=$res3->fetch_array(MYSQLI_NUM);
      $present=$row3[0];
      $html1=$html1."<td>".$present."</td>";

      $sql2="SELECT COUNT(ATTENDANCE) FROM attendances WHERE ATTENDANCE='ABSENT'AND ROLL='".$row[0]."' AND COURSE_ID='".$q."'";
      $res2=$conn->query($sql2);
      $row2=$res2->fetch_array(MYSQLI_NUM);
      $absent=$row2[0];
      $html1=$html1."<td>".$absent."</td>";
			if($present+$absent==0)
			{
				$html1=$html1."<td>".intval(0)."%</td>";
	     $html1=$html1."</tr>";
			}
			else {
				$html1=$html1."<td>".intval(($present*100/($present+$absent)))."%</td>";
	     $html1=$html1."</tr>";
				// code...
			}

    }

$html1 = $html1."</table><a href='#' onclick='window.print()' >print</a></div>";
echo $html1;
// $query = "SELECT DISTINCT(ROLL),(SELECT COUNT(*) FROM attendance WHERE ROLL=attd.ROLL AND COURSE_ID='$q' AND ATTENDANCES='PRESENT') AS CLASSES_ATEENDED,(SELECT COUNT(DISTINCT DATES,SESSION,PERIOD) FROM attendance WHERE COURSE_ID='$q') AS TOTAL_CLASSES,((SELECT COUNT(*) FROM attendance WHERE ROLL=attd.ROLL AND COURSE_ID='$q' AND ATTENDANCES='PRESENT')/(SELECT COUNT(DISTINCT DATES,SESSION,PERIOD) FROM attendance WHERE COURSE_ID='$q')*100) AS PERC FROM attendance attd WHERE COURSE_ID='$q' ORDER BY ROLL";


// echo '<div id="screen" align="center" ><table border="0" cellspacing="2" cellpadding="15" id="disp_table" >
//       <tr>
//           <th> ROLL NO </th>
//           <th> CLASSES ATTENDED </th>
//           <th> TOTAL CLASSES </th>
//           <th> ATTENDENCE PERCENTAGE </th>
//       </tr>';

// if ($result = $mysqli->query($query)) {
//     while ($row = $result->fetch_assoc()) {
//         $field1name = $row["ROLL"];
//         $field2name = $row["CLASSES_ATEENDED"];
//         $field3name = $row["TOTAL_CLASSES"];
//         $field4name = intval($row["PERC"]);

//         echo '<tr>
//                   <td>'.$field1name.'</td>
//                   <td>'.$field2name.'</td>
//                   <td>'.$field3name.'</td>
//                   <td>'.$field4name.'%</td>
//               </tr>';
//     }
//     echo '</table><a onclick="document.getElementById("screen").print()" href="#">>>print</a></div>';
//     $result->free();
// }
  ?>
</body>
</html>
