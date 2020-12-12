<?php

  require('config/config.php');
  require('config/db.php');

?>
<?php
session_start();
$fac_id=$_SESSION['fac_id'];
if(isset($_SESSION['fac_id']))
{
 $sql=" SELECT * FROM faculty_credentials WHERE fac_id='$fac_id' ";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_array($result);
}
else
{
  header('Location:index.php');
}
?>