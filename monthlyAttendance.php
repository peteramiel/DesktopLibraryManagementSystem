<?php 
 

 
//  //database constants
//  define('DB_HOST', 'localhost');
//  define('DB_USER', 'root');
//  define('DB_PASS', '');
//  define('DB_NAME', 'rblms');
 
//  //connecting to database and getting the connection object
//  $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
//  //Checking if any error occured while connecting
//  if (mysqli_connect_errno()) {
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//  die();
//  }

// //creating a query


 // GET STARTING AND ENDING DAYS IN THE WEEK
 $first = date("Y-m-d", strtotime("first day of this month"));
 $last = date("Y-m-d", strtotime("last day of this month"));

 $sql = "SELECT DATE(Date) AS Date, 
       COUNT(Id) AS TOT 
       FROM list 

       GROUP BY DATE(Date) ORDER BY Date DESC"; 

 $result=mysqli_query($dbconn,$sql);

$monthlyAttendance = array();
while ($row = mysqli_fetch_array($result))
{
	$temp = array();
 	$temp['x'] = strtotime($row['Date']);
 	$temp['y'] = $row['TOT']; 
	$temp['x'] .= "000";
 array_push($monthlyAttendance, $temp);
   
}

// echo json_encode($monthlyAttendance);

 
//  