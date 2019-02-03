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
 //|| isset($_GET['bookTitle']) || isset($_GET['callNumber'])

if(isset($_GET['bookAuthor']) ){
  $stmt = $conn ->prepare("SELECT * FROM books WHERE bookAuthor LIKE '%".$_GET['bookAuthor']."%'");
}else if(isset($_GET['bookTitle'])){
	$stmt = $connn -> prepare("SELECT * FROM books WHERE bookTitle LIKE '%".$_GET['bookTitle']."%'");
}else if(isset($_GET['callNumber'])){
	$stmt = $connn -> prepare("SELECT * FROM books WHERE callNumber ='".$_GET['callNumber']."'");
}
else{
  $stmt = $conn->prepare("SELECT * FROM books;");
}
 
 
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($available, $bookAuthor, $bookTitle, $callNumber, $location, $publishDate, $series, $uniqueId, $shelfPosition,$shelfLayer);
 
 $books = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
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