<?php
if(isset($_POST['submit']))
			{

				$servername = "localhost";
    			$username = "root";
    			$password = "";
    			$conn = new mysqli($servername, $username, $password);
    			if ($conn->connect_error) {
      				die("Connection failed: " . $conn->connect_error);
    			}
    			$sql="USE nitpy";
    			$res=$conn->query($sql);
				$fac_id=test_input($_POST['fac_id']);
				$password=test_input($_POST['password']);
				$query=" SELECT COUNT(*) from faculty_credentials where FAC_ID='$fac_id' and PASSWORD='$password' ";

				$result=$conn->query($query);
				$row= $result->fetch_array(MYSQLI_NUM);
				    if($row[0]!=0)
					{
						session_start();
						$_SESSION['fac_id'] = $fac_id;
						$_SESSION['password'] = $row['password'];
						//echo "alert($password)";
						header('Location:TeacherAttendence.html');
					}
					else
					header('Location:login_page.html?login_error');
			}

			function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();
?>
