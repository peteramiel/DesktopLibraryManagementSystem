<html>

<?php
include_once './includes/dbhandler.php';

if (isset($_POST["btnsave"])){

$sectionName = $_POST["sectionName"];
for($i = 0; $i <= count ($_POST['inputs'])-1; $i ++) {
    // Do what ever you want with data
    $book = $_POST ['inputs'] [$i];
    //GET BOOK INFORMATION
    $sql ="SELECT * FROM books WHERE callNumber =".$book;
    $result = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        	$available= $row["available"];
        	$bookAuthor= $row["bookAuthor"];
        	$bookTitle=$row["bookTitle"];
        	$location=$row["location"];
        	$publishDate=$row["publishDate"];
        	$series=$row["series"];
        	$uniqueId=$row["uniqueId"];
        	$shelfPosition=$row["shelfPosition"];
        	$shelfLayer=$row["shelfLayer"];


           $insert = "INSERT INTO search_page (sectionTitle,available,bookAuthor,bookTitle,callNumber,location,publishDate,series,uniqueId,shelfPosition,shelfLayer)
	VALUES ('$sectionName','$available','$bookAuthor','$bookTitle','$book','$location','$publishDate','$series','$uniqueId','$shelfPosition','$shelfLayer')";
        }
    } else {
        echo "<script>console.log('No result')</script>";
    }


     //UPLOAD TO DATABASE
	// $insert = "INSERT INTO search_page (sectionTitle,callNumber)
	// VALUES ('$sectionName','$book')";



	if (!$dbconn->query($insert)) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Oops! Something went wrong, please try again.</strong><br>
			    </div>";
	}

	else{
			
			echo"<div id='myAlert' class='alert alert-success'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Added a New Book to a Section!</strong><br>
			    </div>";
	}
 
	echo "<script>console.log(".$book.")</script>";


}
}
?>

<style>
	.card p{
		  white-space: nowrap;
		  overflow: hidden;
		  text-overflow: ellipsis;
		  max-width: 200px;
	}


	.cards{
  	display: flex;
   	flex-flow: row wrap;
  	justify-content: flex-start;
  	width: 50%;
  	margin-top: 20px;
  	margin-right: 30px;
	}
	
	#phoneView {
  box-shadow: 0 2px 4px 1px rgba(0,0,0,0.2);
  width: 100%;
  
  /*z-index: 0;*/
  text-align: center;
 
  padding: 10px 20px 10px;
  background-color:white;
  transition:.3s ease-in-out;
}

#phoneView:hover {
    box-shadow: 0 4px 8px 4px rgba(0,0,0,0.2);
  transform: scale(1.03);
}
	
</style>
<head>
	<title>PLM Library</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
  	 <link rel="stylesheet" href="./css/home.css">
  	
  		<link rel="icon" type="image/png" href="images/icons/logo_circle_small.png" />
</head>
<body>
	<nav class="navbar" style="background-color: #ECEDEF">
    	<div class="navbar-header">
      	<a class="navbar-brand" href="#">PLM Library System</a>
      	</div>



		<ul class="nav justify-content-end">
		<li class="nav-item">
    	<a class="nav-link" href="EditAccount.php"><i class='fas fa-user-cog'></i> Account</a>
  		</li>
		<li class="nav-item">
    	<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  		</li>
 		</ul>
	</nav>

	<nav class="navbar" id="home_nav" style="border-bottom:#79BF2B 5px solid; padding-bottom: 20px">
	
      	<img src="images/icons/logo_circle.png" alt="Logo" height="100px" >
      	
		<ul class="nav justify-content-end" >
			
		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="Home.php" ><i class='far fa-newspaper' style='font-size:48px;'></i><br>Home</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="Catalog.php"><i class='fas fa-book' style='font-size:48px;'></i><br>Catalog</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
        <a class="nav-link" href="Attendance.php"><i class='fas fa-book' style='font-size:48px;'></i><br>Attendance</a>
        </center>
        </li>

  		<li class="nav-item" href="#"><center>
        <a class="nav-link" href="GenerateReport.php"><i class='fas fa-book' style='font-size:48px;'></i><br>Generate Report</a>
        </center>
        </li>

        <li class="nav-item" href="#"><center>
        <a class="nav-link" href="Students.php"><i class='fas fa-book' style='font-size:48px;'></i><br>Students</a>
        </center>
        </li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#"><i class='far fa-map' style='font-size:48px;'></i><br>Map</a>
    	</center>
  		</li>


  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="Librarians.php" ><i class='far fa-user-circle' style='font-size:48px;'></i><br>Librarians</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="MobileApp.php" "><i class='fas fa-id-badge' style='font-size:48px;'></i><br>Mobile App</a>
    	</center>
  		</li>

		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="About.html" ><i class='far fa-comment' style='font-size:48px;'></i><br>About</a>
    	</center>
  		</li>


 		</ul>
	</nav>
<section class="cards" id="preview_mobile" width="60%" style="float: right; padding: 0 auto;">
	<h2 style="text-align: center; font-family: 'Century Gothic'; margin-top: 20px; margin-left: 250px;" >MOBILE VIEW</h2>
	<div class='card' id=phoneView>
<?php

 // $sql ="SELECT * FROM books WHERE callNumber =".$book;
 //    $result = mysqli_query($dbconn, $sql);
 //    if (mysqli_num_rows($result) > 0) {


//creating a query
  $sql = "SELECT * FROM search_page ORDER BY sectionTitle";
 //executing the query 
 $stmt=mysqli_query($dbconn, $sql);
 $row1 = mysqli_fetch_assoc($stmt);
 $prev = $row1['sectionTitle'];
	$output="";
  if(mysqli_num_rows($stmt) > 0)
	{

 //GET INITIAL SECTION TITLE 		$prev;
 $output .= "<table>
 <tr><td><h3>$prev</h3></td></tr>";
   while($row = mysqli_fetch_assoc($stmt))
   {

	$sectionTitleNew = $row['sectionTitle'];
   	$bookAuthorNew = $row['bookAuthor'];
   	$bookTitleNew = $row['bookTitle'];
   	$bookImageNew = $row['uniqueId'];
   
   	if($prev == $sectionTitleNew){
   		$output.="<td><div class='card' ><center><img src='./images/books/$bookImageNew' width='75px' height='125px'/><p>$bookTitleNew by<br>$bookAuthorNew</p></center></div></td>";
   	}else{
   		$prev= $sectionTitleNew;
   		$output .= "</tr><tr><td><h3>$prev</h3><td>";
   		$output .= "</tr><tr><td>
   			<div class='card' ><center><img src='./images/books/$bookImageNew' width='75px' height='125px'/><p>$bookTitleNew by<br>$bookAuthorNew</p></center></div>
   		</td>";
   	}
   	
	}
}
 // $output="<div class='sectionList'>";

 //  if(mysqli_num_rows($stmt) > 0)
	// {

 // //GET INITIAL SECTION TITLE 		$prev;
 // $output .= "<div id='sectionDiv style='text-align:center;'><h1>$prev</h1>";
 //   while($row = mysqli_fetch_assoc($stmt))
 //   {

 //   	if($prev == $row['sectionTitle']){
	// $sectionTitleNew = $row['sectionTitle'];
 //   	$bookAuthorNew = $row['bookAuthor'];
 //   	$bookTitleNew = $row['bookTitle'];
 //   	$bookImageNew = $row['uniqueId'];
   
 //   	$output.="<div class='card' ><center><img src='./images/books/$bookImageNew' width='75px' height='125px'/><p>$bookTitleNew by<br>$bookAuthorNew</p></center></div>";
   	// }else{
   		$output.="</tr></table></div>";
 //   		$prev = $row['sectionTitle'];

 //   		$output = "<div id='sectionDiv' style='text-align:center;'><h1>$prev</h1>";
 //   		$output.="<div class='card' ><center><img src='./images/books/$bookImageNew' width='75px' height='125px'/><p>$bookTitleNew by<br>$bookAuthorNew</p></center></div>";
 //   	}

 //   }
	// }
	// $output.="</div>";

	echo $output;
?>
			  
</section>
	<section class="section" style="width: 30%; padding: 20px 20px 20px 10px; width:40%;">
		<h2 style="text-align: center; font-family: 'Century Gothic'; margin-top: 20px;">SEARCH PAGE</h2>
		<p style="text-align: center; font-family: 'Century Gothic'; margin-left: 40px;">Add a section to the Search Page</p>
		<form method="POST" enctype="multipart/form-data" id = "addBook" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<table >
				<tr>
					<td><label style="text-align: center; font-family: 'Century Gothic'; margin-left: 40px;">Section Name</label></td>
				</tr>
				<tr>
					<td><input style="margin-left: 40px;" class= "form-control" type="text" name="sectionName" required></td>
				</tr>
				<tr>
					<td>
						<br><label style="text-align: center; font-family: 'Century Gothic'; margin-left: 40px;">Add books</label></td>
				</tr>
				<tr>
					<td>
						<div id="sectionBookCart"></div>

						<button id="booksToAdd" type="button" style="width:80px; margin-left: 10px; height: 100px;" name="addBookButton" class= "btn btn-outline-primary" data-toggle="modal" data-target="#myModal">
							<i style='font-size:48px;' class="far fa-plus-square"></i></button>
						
							
						</td>
					</tr>
						<tr><td>
						<h5 style="text-align: center; font-family: 'Century Gothic';  margin-top: 20px;">Added Books: </h5>
						<div id="bookCartTitle"></div>
					</td>
				</tr>

				<tr>

					<td colspan="2">
						<br>
						<button style="margin-left: 40px;" type="submit" name="btnsave" class="btn btn-outline-primary"><i class="far fa-check-circle"></i> Submit</button>
					</td>
				</tr>
			</table>

		</form>

<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<center>
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h4 class="modal-title">Add book to the Section</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		     
		      <div class="modal-body">
		      	
		      		<div class="form-horizontal">
					<div class="form-group">
					<input type="search" class="form-control"  style="font-size: 24px;" id="search" name="search" placeholder="Search book" autocomplete="off" required/>
					</div>
					<div id=bookSearchResult>
						
					</div>
					</div>
		      		<!-- <input class="form-control" type="text" name="News" id = "News" placeholder="Type an Announcement" style="font-size: 24px;" height="200px" required /> -->
		      		<!-- <div id="image_placement" style="display: inline-block; position: relative;"></div> -->
		      		<!-- <input class="input-group-hello" type="file" name="user_image" id ="user_image" accept="image/*"required onchange="readURL(this)"/> -->
		      	
		        
		      </div>
		    </div>
		  </div>
		</center>
	</div>
		<!-- end of modal -->
	</section>
<!-- LOAD THE DATA IN THE PAGE-->
	<script type="text/javascript">
	
 		$(document).ready(function(){
		 	 $('#search').keyup(function(){
			   var query = $('#search').val();
			   	console.log(query);
			   var action = "Search";
			   if(query != '')
			   {
			    $.ajax({
			     url:"Fetch_Books_MobileApp.php",
			     method:"POST",
			     data:{query:query, action:action},
			     success:function(data)
			     {
			      $('#bookSearchResult').html(data);
			     }
			    });
			   }
			   else
			   {
			    $('#bookSearchResult').html("<br><br><br><br><p style='text-align:center; width:100%;'>No Book Found!</p><br><br><br><br>");
			   }
			  });
 		




 		});
function picDismiss(){
       $("#img").remove();
       $("#closeImage").remove();
       $("#callNumberP").remove();	
    }
	
	</script>
 

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>