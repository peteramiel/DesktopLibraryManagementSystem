<?php

session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }

?>

<!DOCTYPE html>
<html>

<style>


div.form
{
    display: block;
    text-align: center;
}
form
{
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}

tr:nth-child(even){
	background-color: #71c2ce
}

td .form-control{
	width: 550px;
	height: 50px;
}

td .control-label{
	width: 200px;
	height: 50px;
}

hr.style14 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

button{
	align-content: center;
	background-color: #258230;
	color: #fff;
	padding: 5px;
	text-align: center;
}

</style>



<head>
	<title>Admin - Add Book</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
	<script type="text/javascript" src="scripts/dbconf.js" ></script>
	<script src="http://bootboxjs.com/bootbox.js"></script>
	
	
</head>


<body>
	<?php include('AdminSidebar.php'); 
	include_once './includes/dbhandler.php';?>

	<script type="text/javascript">
		 document.getElementById("homeLi").classList.remove('active');
		 document.getElementById("booksLi").classList.add('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("addStudentsLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');
	</script>


	<!-- Page Content -->
		<div id="content">

	<?php 

	//This code runs if the form has been submitted
	if (isset($_POST['btnsave'])) { 

	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
	  
	  // 	UPLOAD IMAGE TO LOCAL HOST
			$upload_dir = 'images/books/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
			$userpic = md5(uniqid(rand(), true)).".".$imgExt;

			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		// END OF UPLOAD IMAGE TO LOCAL HOST

	//UPLOAD TO DATABASE
	$insert = "INSERT INTO books (available, bookAuthor, bookTitle, callNumber, location, publishDate, series,uniqueId)
	VALUES ('".$_REQUEST['available']."', '".$_REQUEST['book_author']."', '".$_REQUEST['book_title']."', '".$_REQUEST['call_number']."','".$_REQUEST['location']."','".$_REQUEST['publish_date']."','".$_REQUEST['series']."','".$userpic."')";

	$add_book = $dbconn->query($insert);


	echo"<div id='myAlert' class='alert alert-success'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Added Book Success!</strong><br>
	    </div>";

	} 
	 
	?>
		<div class = "form">
			<h1 style="font-family: 'Century Gothic';">ADD BOOKS TO LIBRARY</h1>
			<hr class="style14">
			<p style="font-family: 'Verdana';">Enter the information below to add a book to the library.</p>
			<form align="center" method="post" enctype="multipart/form-data" id = "addBook" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<table align="center" class="table table-bordered table-responsive">

					<tr>
						<td><label class="control-label" >Book Title</label></td>
						<td><input class="form-control" type="text" name="book_title" id = "book_title" placeholder="Enter Book Title" required /></td>
					</tr>
					<tr>
						<td><label class="control-label" >Book Author</label></td>
						<td><input class="form-control" type="text" name="book_author" id = "book_author" placeholder="Enter Book Author" required /></td>
					</tr>
					<tr>
						<td><label class="control-label" >Call Number</label></td>
						<td><input class="form-control" type="text" name="call_number" id = "call_number" placeholder="Enter Call Number" required /></td>
					</tr>
					<tr>
						<td><label class="control-label" >Published Date</label></td>
						<td><input class="form-control" type="text" name="publish_date" id = "publish_date" placeholder="Enter Date of Publish" required /></td>
					</tr>
					<tr>
						<td><label class="control-label" >Series</label></td>
						<td><input class="form-control" type="text" name="series" id = "series" placeholder="Enter Book Series" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label" >Shelf Location</label></td>
						<td><input class="form-control" type="text" name="location" id = "location" placeholder="Enter Location" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label" >Quantity</label></td>
						<td><input class="form-control" type="number" name="available" id = "available" placeholder="Enter Available" required /></td>
					</tr>
					<tr>
						<td><label class="control-label" >Book Cover</label></td>
						<td><input class="input-group-hello" type="file" name="user_image" id = "unique_id" accept="image/*"required /></td>
					</tr>

					<tr>

						<td style= "text-align: center;" colspan="2"><Button type="submit" name="btnsave" class="btn btn-default">
								<span class="glyphicon glyphicon-save"></span> &nbsp; Save
							</Button>
						</td>
					</tr>

				</table>

			</form>
		</div>
			</div>
			<script>
 
// $( "#addBook" ).submit(function() {
		 	
			
			
// 		  	// UPLOAD BOOK IMAGE TO FIREBASE STORAGE
// 		  	var booksImageRef = firebase.storage().ref('Books');
// 		  	const file = document.querySelector('.input-group-hello').files[0];
// 		  	const name = (+new Date()) + '_' + file.name;
// 		  	const metadata = { contentType: file.type };
// 		  	const task = booksImageRef.child(name).put(file, metadata);
		  	
// 		  	// UPLOAD BOOK INFORMATION TO FIREBASE DATABASE
// 		  	var available = document.getElementById(available).value;
// 			var bookAuthor = document.getElementById(book_author).value;
// 			var bookTitle= document.getElementById(book_title).value;
// 			var callNumber = document.getElementById(call_number).value;
// 			var location = document.getElementById(location).value;
// 			var publishDate = document.getElementById(publish_date).value;
// 			var series = document.getElementById(series).value;
// 		  	var uid = firebase.database().ref().child('Books').push().key;

// 		  	firebase.database().ref('Books').child(uid).set({
// 		  		available: available,
// 		  		bookAuthor: bookAuthor,
// 		  		bookTitle:bookTitle,
// 		  		callNumber: callNumber,
// 		  		location: location,
// 		  		publishDate: publishDate,
// 		  		series: series,
// 		  		uniqueId: name
// 		  	})
// 		});


//   function writeUserData(bookTitle, bookAuthor, callNumber, publishDate,location, series,available) {
//   	var bookImageRef = firebase.storage().ref('Books');
//   	// var preview = document.querySelector('.preview');

//   	const file = document.querySelector('.input-group-hello').files[0];
//   	const name = (+new Date()) + '_' + file.name;
//   	const metadata = { contentType: file.type };
//   	const task = bookImageRef.child(name).put(file, metadata);

//   	var uid = firebase.database().ref().child('Books').push().key;
//   	firebase.database().ref('Books').child(uid).set({
//   		available: available,
//   		bookAuthor: bookAuthor,
//   		bookTitle: bookTitle,
//   		callNumber: callNumber,
//   		location: location,
//   		publishDate: publishDate,
//   		series: series,
//   		uniqueId: name
//   	}, function(error) {
//   		if (error) {
//   			alert("Error");
//   		} else {
//       // Data saved successfully!
//       // alert('The book is created successfully!');
//       // window.location.reload();
//   }
// }); 

//     // window.location.reload();


// }

  // function save_user(){
  //  var uid = firebase.database().ref().child('Books').push().key;
  //  var book_title = document.getElementById('book_title').value;
  //  var book_author = document.getElementById('book_author').value;
  //  var call_number = document.getElementById('call_number').value;
  //  var publish_date = document.getElementById('publish_date').value;
  //  var location = document.getElementById('location').value;
  //  var series = document.getElementById('series').value;
  //  var available = document.getElementById('available').value;
  //  // var uniqueId = document.getElementById('unique_id').value;
  //  var unique_id = "asdf.jpg"


  //  var bookData = {	
  //  	available: available,
  //  	bookAuthor: book_author,
  //  	bookTitle: book_title,
  //  	callNumber: call_number,
  //  	location: location,
  //  	publishDate: publish_date,
  //  	series: series,
  //  	uniqueId: unique_id
  //  }

  //  var updates = {};
  //  updates['/Books/' + uid] = bookData;
  //  firebase.database().ref().update(updates);

  //  reload_page();
  // }
  
  //  function reload_page(){
  //  window.location.reload();
  // }
  
</script>
</body>
</html>