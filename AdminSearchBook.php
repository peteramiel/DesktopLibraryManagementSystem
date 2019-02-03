<?php
//session_start();
//if ($_SESSION['fullName']==NULL){
//echo "<script> window.location.href='AdminLogin.php';</script>";
//}

session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }
$servername = "localhost";
$username = "root";
$password = "";

try {
    $dbconn = new PDO("mysql:host=$servername;dbname=rblms", $username, $password);
    // set the PDO error mode to exception
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>


<!DOCTYPE html>
<html>
<style>
.card {
    box-shadow: 0 2px 4px 1px rgba(0,0,0,0.2);
	width: 200px;
	position: relative;
	/*z-index: 0;*/
	text-align: center;
	margin: 10px 3px 10px;
	background-color:white;
	transition:.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 4px 8px 4px rgba(0,0,0,0.2);
	transform: scale(1.03);
}
body{
  max-width:100%;
  overflow-x: hidden;
  overflow-y: scroll;
}

.container3{
background-color: #92c6d7;
padding: 1px 0px 5px 0px;
width: 140px;
height: 45px;
}

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: black;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}

/*body{
    background-repeat: no-repeat;
    background-size: 1500px 950px;
	background-attachment:fixed;
}*/

p.capitalize{
	text-transform:capitalize;
	text-align: center;
	margin-bottom: 0px;
	margin-bottom: 0rem;
}

p{
	margin-bottom: 0rem;
}

span.buttons{
	text-align: center;
	white-space: nowrap;
	text-overflow: ellipsis;
	width:140px;
	display: block;
	overflow:  hidden;
}

div.col-xs-3{
	padding-left: 15px;
	padding-right: 15px;
	text-align: center;
	
}
/*div.col-xs-3{
	text-align: center;
}
p{
	text-align: right;
}
*/

.cards{
	display: flex;
	 flex-flow: row wrap;
	justify-content: flex-start;
}

/*FOR TOOLTIP*/
.card .tooltiptext {
  visibility: hidden;
  width: 200px;
  background-color: gray;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  font-size: 14px;
  /* Position the tooltip */

 position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 40%;
  margin-left: -60px;
  /* Fade in tooltip - takes 1 second to go from 0% to 100% opac: */
  opacity: 0;
  transition: opacity 1s;
}

.card:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

.imagetext{
	display : table-row;
	
vertical-align : bottom;
height: 1px;
    margin: 0;
	bottom: 2px;
}

hr.style14 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

</style>
<head>
	<title>Admin - Search Book</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">
<!-- asdf -->
<!-- <script src="jquery-1.11.3-jquery.min.js"></script> -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
 
  <script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<!-- asdf -->
	<link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
	<script type="text/javascript" src="scripts/dbconf.js" ></script>

	
</head>
<body>
	<?php include('AdminSidebar.php'); ?>
	<script type="text/javascript">
		 document.getElementById("homeLi").classList.remove('active');
		 document.getElementById("booksLi").classList.add('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("addStudentsLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');
	</script>
	<div id="content">

	<?php

		if(isset($_GET['delete_id']) && !empty($_GET['delete_id']))
		{
			// select image from db to delete
			$stmt_select = $dbconn->prepare('SELECT * FROM books WHERE callNumber =:callNumber');
			$stmt_select->execute(array(':callNumber'=>$_GET['delete_id']));
			$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
			unlink("images/books/".$imgRow['uniqueId']);
			// $stmt_select->close();

			// $result = $dbconn->prepare('DELETE FROM books WHERE callNumber = :callNumber');
			// $result->execute(array(':callNumber' => $_GET['delete_id']));

			// $escapedId= mysqli_real_escape_string($dbconn,$_GET['delete_id']);
			// $sql = "SELECT * FROM books WHERE callNumber = ".$_GET['delete_id'];
			// $rs_result=mysqli_query($dbconn, $sql);
			// if (mysqli_num_rows($rs_result)>0) {
			// 	while($row = $rs_result->fetch_assoc()) {
			// 	unlink("images/books/".$row['uniqueId']);


				// it will delete an actual record from db

			$stmt_delete = "DELETE FROM books WHERE callNumber ='".$_GET['delete_id']."'";
			date_default_timezone_set("Asia/Hong_Kong");
			$dateTime = date('l g:i A F j, Y');
			$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','".$_GET['delete_id']."','admin','Delete Book','".$dateTime."','".$imgRow['bookTitle']." by ". $imgRow['bookAuthor'] ."');";

			if ($dbconn->query($stmt_delete) === TRUE && $dbconn->query($add_activity_sql)===TRUE) {
			    echo"<div id='myAlert' style='margin-left:250px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>".$_GET['delete_id']."</strong><br></div>";
			    	

			} else {
				// CONNECTION ERROR

			    // echo "<div id='myAlert' style='margin-left:300px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>". $dbconn->error."</strong><br></div>"; ;

			}
				
					
			
			if ($dbconn->query($add_activity_sql) === TRUE) {
			    echo"<div id='myAlert' style='margin-left:250px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>".$_GET['delete_id']."</strong><br></div>";
			} else {
				//CONNECTION ERROR
			    // echo "<div id='myAlert' style='margin-left:300px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>". $dbconn->error."</strong><br></div>"; ;
			}
				
			
			
			
		
		}


	?>
	<div class="container">
  	<h1 style="font-family: 'Century Gothic'; text-align: center;"><span class="glyphicon glyphicon-cog"></span>    MANAGE BOOKS</h1>
  	<hr class="style14">
  	<p style="font-family: 'Verdana'; text-align: center;" >The following books are available in the system.</p><br>
	<input type="text" name="search" title="Type call number, author or title" class="form-control" autocomplete="off" id="search" placeholder="Search Book" size="173"><br><br>
  	</div>


	<center>
	<div id="result"></div>
	</center>

	

</div>
<!-- LOAD THE DATA IN THE PAGE-->
	<script type="text/javascript">
	
	  var page=1;
	 $(document).ready(function(){

	  load_data(page);

	  function load_data(page)
	  {
	   var action = "Load";
	   $.ajax({
	    url:"Fetch_Books_Admin.php",
	    method:"POST",
	    data:{action:action, page:page},
	    success:function(data)
	    {
	     $('#result').html(data);
	      var btns = document.getElementById("pagination").getElementsByClassName("pagination_link");
	      btns[page+1].className+= " active";
	      if (page==1){
	      btns[0].style.display = "none";
	      btns[1].style.display = "none";
	      }
	      if (page==total_pages){
	      document.getElementById("last").style.display = "none";
	      document.getElementById("next").style.display = "none";
	      }
	      for (var i = 0; i < btns.length; i++) {
	      btns[i].addEventListener("click", function() {
	      var current = document.getElementsByClassName("active");
	       current[1].className = current[1].className.replace(" active", "");
	      this.className += " active";
	      });
	      }
	    }
	   });
	  }

	  $(document).on('click', '.pagination_link', function(){

	    if ($(this).attr("id")=="next"){
	      if (page<total_pages){
	        page=parseInt(page);
	        page=page+1;
	        load_data(page);
	      }
	    } 
	    else if ($(this).attr("id")=="prev"){
	      if(page&&page!=1){
	        page=page-1;
	        load_data(page);
	      }
	    }
	     else if ($(this).attr("id")=="first"){
	        load_data(1);
	        page=1;
	    }
	     else if ($(this).attr("id")=="last"){
	        load_data(total_pages);
	        page=total_pages;
	    }
	    else{ 
	      page = $(this).attr("id");
	      page=parseInt(page);
	      load_data(page); 
	      
	    }
	  });

	  
	  $('#search').keyup(function(){
	   var query = $('#search').val();
	   var action = "Search";
	   if(query != '')
	   {
	    $.ajax({
	     url:"Fetch_Books_Admin.php",
	     method:"POST",
	     data:{query:query, action:action},
	     success:function(data)
	     {
	      $('#result').html(data);
	     }
	    });
	   }
	   else
	   {
	    load_data();
	   }
	  });
	  
	 });
	</script>

</body>
</html>