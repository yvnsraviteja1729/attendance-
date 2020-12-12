<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	<style>
		table
		{
			margin-left: 15%;
			margin-top: 20px;
		}
		table tr:nth-child(even)
		{
			background-color: #dddddd;
		}
		table tr:nth-child(odd)
		{
			background-color: #ffffff;
		}
		select
		{
			height:30px;
		}
	</style>
    <title></title>
  </head>
  <body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql="USE nitpy";
    $res=$conn->query($sql);
    $crs_id="";
    $roll="";
    $q="";
    $q=strval($_GET["q"]);
    $crs_id=substr($q,0,strpos($q,"_"));
    $q=substr($q,strpos($q,"_")+1);
    $roll=$q;
    $q=$crs_id;
    $x=0;
    $sql="SELECT lock_value FROM lock_table WHERE COURSE_ID='".$q."'";
 $res1=$conn->query($sql) ;
 $row1 = $res1->fetch_array(MYSQLI_NUM);
 //echo $row1[0];
 if($crs_id=='')
 $row1[0]=2;
 if($row1[0]==1){

    $html1='';
  if($crs_id!='' and $roll=='')
  { $html1="<center><h2>ATTENDANCE OF COURSE ".$crs_id."</h2></center><table cellpadding='15px' id='table'><tr style='background-color:#A9A9A9'><td>DATE</td>";
    $sql="SELECT ROLL_NO FROM course_reg WHERE COURSE_ID='".$q."'";
    //$sql="SELECT CLASS_START,CLASS_END FROM attendances where COURSE_ID=".$q;

   if($res=$conn->query($sql) ){
	   $i=0;
      while($row = $res->fetch_array(MYSQLI_NUM)) {
   $a=$row[0];
        //$a=$row[0]."_<br>".$row[1];

        $html1=$html1."<td >".$a."</td>";

      }
      $html1=$html1."</tr>";
    //  $sql = "SELECT ROLL FROM STU_COURSE2 WHERE COURSE_ID=".$q;
      $sql="SELECT DISTINCT CLASS_START,CLASS_END FROM attendances where COURSE_ID='".$q."'";
    $res=$conn->query($sql) ;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $abc1="";
    while($row = $res->fetch_array(MYSQLI_NUM)) {
      $html1=$html1."<tr><td>".substr($row[0],0,10)."</td>";
      $sql1="SELECT * FROM attendances WHERE  CLASS_START='".$row[0]."'AND CLASS_END='".$row[1]."'AND COURSE_ID='".$q."'";
      $res1=$conn->query($sql1) ;
        while ($row1 = $res1->fetch_array(MYSQLI_NUM)) {
    $abc="";
     if($row1[4]=="ABSENT")
     {$abc=$abc.'<select style="height:30px" name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
     $abc=$abc.'<option value="ABSENT'.'" >absent</option>';
     $abc=$abc.'<option value="PRESENT">present</option></select><br>';}
  else {
    $abc=$abc.'<select style="height:30px" name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
    $abc=$abc.'<option value="PRESENT'.'">present</option>';
    $abc=$abc.'<option value="ABSENT">absent</option></select><br>';
  }
      $html1=$html1."<td>".$abc."</td>";
   }$html1=$html1."</tr>";
   }}}

   else {
  /*  $sql="SELECT COUNT(DISTINCT CLASS_START,CLASS_END) FROM attendances where ROLL='".$roll."' AND COURSE_ID='".$q."'";
         $res2 = $conn->query($sql);
         while($row = $res2->fetch_array(MYSQLI_NUM))
         {
          if($row[0]==0)
          {
            die("No ROLL NUMBER found with course id $q");
          }
        }*/
    $html1="<center><h2>ATTENDANCE OF COURSE ID - ".$crs_id." AND ROLL NUMBER - ".$roll."</center></h2><table cellpadding='15px' ><tr style='background-color:#A9A9A9'><td>dates</td>";
      $sql="SELECT ROLL_NO,COURSE_ID FROM course_reg WHERE ROLL_NO='".$roll."' AND COURSE_ID='".$q."'";
      //$sql="SELECT CLASS_START,CLASS_END FROM attendances where COURSE_ID=".$q;

     if($res=$conn->query($sql) ){
        while($row = $res->fetch_array(MYSQLI_NUM)) {
     $a=$row[0];
          //$a=$row[0]."_<br>".$row[1];
          $html1=$html1."<td>".$a."</td>";
        }
        $html1=$html1."</tr>";
      //  $sql = "SELECT ROLL FROM STU_COURSE2 WHERE COURSE_ID=".$q;
        $sql="SELECT DISTINCT CLASS_START,CLASS_END FROM attendances where ROLL='".$roll."'AND COURSE_ID='".$q."'";
      $res=$conn->query($sql) ;
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      $abc1="";
      while($row = $res->fetch_array(MYSQLI_NUM)) {
        $html1=$html1."<tr><td>".substr($row[0],0,10)."</td>";
        $sql1="SELECT * FROM attendances WHERE  CLASS_START='".$row[0]."'AND CLASS_END='".$row[1]."'AND ROLL='".$roll."'AND COURSE_ID='".$q."'";
        $res1=$conn->query($sql1) ;
          while ($row1 = $res1->fetch_array(MYSQLI_NUM)) {
      $abc="";
       if($row1[4]=="ABSENT")
       {$abc=$abc.'<select name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
       $abc=$abc.'<option value="ABSENT'.'">absent</option>';
       $abc=$abc.'<option value="PRESENT">present</option></select><br>';}
    else {
      $abc=$abc.'<select name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
      $abc=$abc.'<option value="PRESENT'.'">present</option>';
      $abc=$abc.'<option value="ABSENT">absent</option></select><br>';
    }
        $html1=$html1."<td>".$abc."</td>";
     }$html1=$html1."</tr>";
     }}

   }
echo $html1;}
elseif ($row1[0]==2&&($crs_id==''&&$roll!='')) {
        $html1="";
        $sql = "SELECT COURSE_ID FROM course WHERE COURSE_FACULTY='".$_SESSION['fac_id']."'";
        $res4 = $conn->query($sql);
        while($row4 = $res4->fetch_array(MYSQLI_NUM))
        {$sql5="SELECT lock_value FROM lock_table WHERE COURSE_ID='".$row4[0]."'";
           //  echo $row4[0];
          //$sql="SELECT COUNT(*) FROM attendances where ROLL='".$roll."' and COURSE_ID='".$row4[0]."'";
          //$res5 = $conn->query($sql);
          //$row5 = $res5->fetch_array(MYSQLI_NUM);

       $res10=$conn->query($sql5) ;
       $row10 = $res10->fetch_array(MYSQLI_NUM);
       //echo "$row10[0]";
      if($row10[0]==1)
        {$x++;
          //$sql="SELECT DISTINCT COURSE_ID FROM course_reg WHERE ROLL_NO='".$roll."' and COURSE_ID='".$row4[0]."'";
        //$sql="SELECT CLASS_START,CLASS_END FROM attendances where COURSE_ID=".$q;

      // if($res2=$conn->query($sql) ){
        //  while($row2 = $res2->fetch_array(MYSQLI_NUM)) {
         $html1=$html1."<center><h2>ATTENDANCE OF ROLL NUMBER - ".$roll." AND COURSE ID - ".$row4[0]."</center></h2><table cellpadding='15px'><tr style='background-color:#A9A9A9'><td>dates</td>";
       $a=$row4[0];
            //$a=$row[0]."_<br>".$row[1];
            $html1=$html1."<td>".$a."</td>";

          $html1=$html1."</tr>";
        //  $sql = "SELECT ROLL FROM STU_COURSE2 WHERE COURSE_ID=".$q;
          $sql="SELECT DISTINCT CLASS_START,CLASS_END FROM attendances where ROLL='".$roll."' AND COURSE_ID='".$row4[0]."'";
        $res=$conn->query($sql) ;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $abc1="";
        while($row = $res->fetch_array(MYSQLI_NUM)) {

          $sql1="SELECT * FROM attendances WHERE  CLASS_START='".$row[0]."'AND CLASS_END='".$row[1]."'AND ROLL='".$roll."'";
          $res1=$conn->query($sql1) ;
            while ($row1 = $res1->fetch_array(MYSQLI_NUM)) {
        $abc="";
        $html1=$html1."<tr><td>".substr($row[0],0,10)."</td>";
         if($row1[4]=="ABSENT")
         {$abc=$abc.'<select name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
         $abc=$abc.'<option value="ABSENT'.'">absent</option>';
         $abc=$abc.'<option value="PRESENT">present</option></select><br>';}

      else {
        $abc=$abc.'<select name="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" id="'.$row1[0].'_'.$row1[1].'_'.$row1[2].'_'.$row1[3].'_'.$row1[4].'" onchange="myfun(this.id,this.value)">';
        $abc=$abc.'<option value="PRESENT'.'">present</option>';
        $abc=$abc.'<option value="ABSENT">absent</option></select><br>';
      }
          $html1=$html1."<td>".$abc."</td>";
      $html1=$html1."</tr>";
}


}$html1=$html1."</table><br>";

}
}echo $html1;
if($x==0)
{header('Location:error.php') ;}
}
else
{
    header('Location:error.php') ;
}




  } ?>
  </body>
</html>
