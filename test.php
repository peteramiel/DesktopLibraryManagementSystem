<?php 
 

 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'rblms');
 
 //connecting to database and getting the connection object
 $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }

//creating a query


 // GET STARTING AND ENDING DAYS IN THE WEEK
 $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
 $tuesday = date( 'Y-m-d', strtotime( 'tuesday this week' ) );
 $wednesday = date( 'Y-m-d', strtotime( 'wednesday this week' ) );
 $thursday = date( 'Y-m-d', strtotime( 'thursday this week' ) );
 $friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
 $saturday = date( 'Y-m-d', strtotime( 'saturday this week' ) );
 $newMonday = date( 'F d', strtotime( 'monday this week' ) );
 $newTuesday = date( 'F d', strtotime( 'tuesday this week' ) );
 $newWednesday = date( 'F d', strtotime( 'wednesday this week' ) );
 $newThursday = date( 'F d', strtotime( 'thursday this week' ) );
 $newFriday = date( 'F d', strtotime( 'friday this week' ) );
 $newSaturday = date( 'F d', strtotime( 'saturday this week' ) );

 $news = array(); 

 $sqlMonday = "SELECT * FROM `list` WHERE Date LIKE '$monday%'"; 
 $result=mysqli_query($dbconn,$sqlMonday);
 $rowcountMonday=mysqli_num_rows($result);
 

 $sqlTuesday = "SELECT * FROM `list` WHERE Date LIKE '$tuesday%'"; 
 $result=mysqli_query($dbconn,$sqlTuesday);
 $rowcountTuesday=mysqli_num_rows($result);
 

 $sqlMonday = "SELECT * FROM `list` WHERE Date LIKE '$wednesday%'"; 
 $result=mysqli_query($dbconn,$sqlMonday);
 $rowcountWednesday=mysqli_num_rows($result);
 
 $sqlMonday = "SELECT * FROM `list` WHERE Date LIKE '$thursday%'"; 
 $result=mysqli_query($dbconn,$sqlMonday);
 $rowcountThursday=mysqli_num_rows($result);
 

 $sqlMonday = "SELECT * FROM `list` WHERE Date LIKE '$friday%'"; 
 $result=mysqli_query($dbconn,$sqlMonday);
 $rowcountFriday=mysqli_num_rows($result);
 

 $sqlMonday = "SELECT * FROM `list` WHERE Date LIKE '$saturday%'"; 
 $result=mysqli_query($dbconn,$sqlMonday);
 $rowcountSaturday=mysqli_num_rows($result);
 


 $named_array = array(
    array(
       
            "x" => $newMonday
       ,
      
            "y" => $rowcountMonday
        
    ), array(
     
            "x" => $newTuesday
        ,
     
            "y" => $rowcountTuesday
       
    ), array(
       
            "x" => $newWednesday
        ,
       
            "y" => $rowcountWednesday
        
    ), array(
      
            "x" => $newThursday
        ,
      
            "y" => $rowcountThursday
     
    ), array(
      
            "x" => $newFriday
        ,
        
            "y" => $rowcountFriday
        
    ), array(
     
            "x" => $newSaturday
        ,
        
            "y" => $rowcountSaturday
        
    )
);
 
 //displaying the result in json format 
 echo json_encode($named_array);
 