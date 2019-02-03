<?php 
 

 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'rblms');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }

//creating a query

if(isset($_GET['user'])){
  $stmt = $conn ->prepare("SELECT * FROM student WHERE UserId ='".$_GET['user']."'");
}
else{
  $stmt = $conn->prepare("SELECT * FROM student;");
}
 
 
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Name, $UserId, $StudentNumber, $UserPic, $Course, $College, $YearLevel, $Email, $ContactNumber,$UserType);
 
 $users = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Name'] = $Name; 
 $temp['UserId'] = $UserId; 
 $temp['StudentNumber'] = $StudentNumber; 
 $temp['UserPic'] = $UserPic; 
 $temp['Course'] = $Course; 
 $temp['College'] = $College; 
 $temp['YearLevel'] = $YearLevel; 
 $temp['Email'] = $Email; 
 $temp['ContactNumber'] = $ContactNumber; 
 $temp['UserType'] = $UserType; 
 
 array_push($users, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($users);