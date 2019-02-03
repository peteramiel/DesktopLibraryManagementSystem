<?php 
 

 
 // //database constants
 // define('DB_HOST', 'localhost');
 // define('DB_USER', 'root');
 // define('DB_PASS', '');
 // define('DB_NAME', 'rblms');
 
 // //connecting to database and getting the connection object
 // $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 // //Checking if any error occured while connecting
 // if (mysqli_connect_errno()) {
 // echo "Failed to connect to MySQL: " . mysqli_connect_error();
 // die();
 // }

//creating a query



  $stmt = $dbconn ->prepare("SELECT College, count(*) as Count FROM list GROUP BY College");

 
 
 //executing the query 
 $stmt->execute();

 

 $stmt->bind_result($College, $Count);
 
 $attendanceMonthlyPie = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['college'] = $College; 
 $temp['y'] = $Count; 

 array_push($attendanceMonthlyPie, $temp);
 }
 
 //displaying the result in json format 

 