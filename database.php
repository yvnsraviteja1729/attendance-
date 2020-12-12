<?php

$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$sql = "CREATE DATABASE nitpy";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully <br>";
} else {
  echo "<br>Error creating database: " . $conn->error;
}
$sql="USE nitpy";
if($conn->query($sql)===TRUE)
  echo "we are using the myDB database<br>";
else {
  echo "error in using the database<br>";
}
$sql="CREATE TABLE `course_reg` (
  `ROLL_NO` varchar(9) NOT NULL,
  `COURSE_ID` varchar(6) NOT NULL,
  `SEMESTER` tinyint(1) NOT NULL,
  `INS/HOSTEL_FEE_STATUS` varchar(15) NOT NULL,
  `OTHER_DUES` varchar(15) NOT NULL,
  `DATE_OF_REGISTRATION` date NOT NULL,
  constraint course_reg_pk PRIMARY KEY (`ROLL_NO`,`COURSE_ID`)
) ";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table students created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="CREATE TABLE `student_credentials` ( `ROLL_NO` VARCHAR(9) NOT NULL , `PASSWORD` VARCHAR(255) NOT NULL , PRIMARY KEY (`ROLL_NO`)) ENGINE = InnoDB";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table student login created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="CREATE TABLE `faculty_credentials` ( `FAC_ID` VARCHAR(15) NOT NULL , `PASSWORD` VARCHAR(255) NOT NULL , PRIMARY KEY (`FAC_ID`)) ";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table faculty login created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}

$sql="CREATE TABLE Course (
    COURSE_ID VARCHAR(6) NOT NULL,
    COURSE_NAME VARCHAR(100) NOT NULL,
    COURSE_FACULTY VARCHAR(85),
    SEMESTER INT(1) ,

PRIMARY KEY(COURSE_ID(6)),
    FOREIGN KEY (COURSE_FACULTY) REFERENCES faculty_credentials(FAC_ID)
)";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table STU_COURSE created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="CREATE TABLE ATTENDANCES(
  ROLL VARCHAR(9) NOT NULL,
  COURSE_ID VARCHAR(10) NOT NULL,
  CLASS_START DateTime NOT NULL,
  CLASS_END DateTime NOT NULL,
  ATTENDANCE VARCHAR(10) NOT NULL,
  CONSTRAINT PK_ATTENDANCE PRIMARY KEY (ROLL,COURSE_ID,CLASS_START,CLASS_END)
);";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table ATTENDANCE created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="CREATE TABLE TOPIC(
  COURSE_ID VARCHAR(10) NOT NULL,
  CLASS_START DateTime NOT NULL,
  CLASS_END DateTime NOT NULL,
  topic VARCHAR(50) NOT NULL,
  CONSTRAINT PK_TOPIC PRIMARY KEY (COURSE_ID,CLASS_START,CLASS_END)
);";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table TOPIC created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="CREATE TABLE LOCK_TABLE(
  COURSE_ID VARCHAR(10) NOT NULL,
  LOCK_VALUE tinyint(1) NOT NULL,
    FOREIGN KEY (COURSE_ID) REFERENCES COURSE(COURSE_ID),
    PRIMARY KEY(COURSE_ID)
)";
if ($conn->query($sql) === TRUE) {
  echo "<br>Table LOCK_TABEL IS  created successfully<br>";
} else {
  echo "<br>Error creating table: " . $conn->error;
}
$sql="SELECT COURSE_ID FROM COURSE";
$res=$conn->query($sql) ;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
while($row = $res->fetch_array(MYSQLI_NUM)) {
$sql="INSERT INTO LOCK_TABLE VALUES('$row[0]','1')";
if ($conn->query($sql) === TRUE) {
  echo "<br>INSERTED INTO LOCK TABLE successfully<br>";
} else {
  echo "<br>Error INSERTING table: " . $conn->error;
}}
$conn->close();

?>
