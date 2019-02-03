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


  $stmt = $conn ->prepare("SELECT * FROM search_page ORDER BY sectionTitle");

 
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id, $sectionTitle, $available, $bookAuthor, $bookTitle, $callNumber, $location, $publishDate, $series, $uniqueId, $shelfPosition,$shelfLayer);
 
 $books = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id; 
 $temp['sectionTitle'] = $sectionTitle; 
 $temp['available'] = $available; 
 $temp['bookAuthor'] = $bookAuthor; 
 $temp['bookTitle'] = $bookTitle; 
 $temp['callNumber'] = $callNumber; 
 $temp['location'] = $location; 
 $temp['publishDate'] = $publishDate; 
 $temp['series'] = $series; 
 $temp['uniqueId'] = $uniqueId; 
 $temp['shelfPosition'] = $shelfPosition; 
 $temp['shelfLayer'] = $shelfLayer; 
 array_push($books, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($books);