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


  $stmt = $conn ->prepare("SELECT * FROM announcements ORDER BY id DESC");

 
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id, $content, $attachment, $dateTime);
 
 $news = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id; 
 $temp['content'] = $content; 
 $temp['attachment'] = $attachment; 
 $temp['dateTime'] = $dateTime; 
 array_push($news, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($news);