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


hr.style15 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

table {
	margin-top: 20px; 
}

td .form-control{
	width: 230px;
	height: 30px;
}

td .control-label{
	width: 200px;
	height: 30px;
}

table tr:nth-child(even){
  background-color: #71c2ce
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
	<style>
	#view_profile{
	margin-left: 10px;
	margin-right: 10px;
	box-shadow: 0 4px 8px 2px rgba(0,0,0,0.2);
	transition: 0.3s;
	width: 300px;
	text-align: center;
	margin: 10px 52px 50px 58px;
	background-color:white;
	}
	#view_profile:hover {
		box-shadow: 0 8px 16px 4px rgba(0,0,0,0.2);
	}
	</style>
	<title>Admin - Add Student</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
	<script src="http://bootboxjs.com/bootbox.js"></script>
	<script type="text/javascript" src="scripts/dbconf.js" ></script>
	
</head>


<body>
	<?php include('AdminSidebar.php'); 
	include_once './includes/dbhandler.php';?>

	<script type="text/javascript">
		 document.getElementById("homeLi").classList.remove('active');
		 document.getElementById("booksLi").classList.remove('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("addStudentsLi").classList.add('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');
	</script>


	<!-- Page Content -->
		<div id="content">

	<?php 

	//This code runs if the form has been submitted
	if (isset($_POST['btnsave'])) { 
		$userName = $_POST['Name'];
		$userNumber = $_POST['StudentNumber'];
		$course = $_POST['Course'];
		$college = $_POST['College'];
		$yearLevel = $_POST['YearLevel'];
		$email = $_POST['Email'];
		$contactNumber = $_POST['ContactNumber'];
		


	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
	  
	  // 	UPLOAD IMAGE TO LOCAL HOST
			$upload_dir = 'images/users/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			// $userpic = rand(1000,1000000).".".$imgExt;
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
	$insert = "INSERT INTO student (Name, StudentNumber, Userpic, Course, College, YearLevel, Email,ContactNumber, UserType)
	VALUES ('$userName', '$userNumber', '$userpic', '$course','$college','$yearLevel','$email','$contactNumber','Student')";
	date_default_timezone_set("Asia/Hong_Kong");
	$dateTime = date('l g:i A F j, Y');
	$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$userNumber','admin','Add Student','$dateTime','$userName in $course')";
	

		if ($dbconn->connect_errno) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Can't Connect to the Database</strong><br>
			    </div>";
		}

		if (!$dbconn->query($insert) && !$dbconn->query($add_activity_sql)) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Oops! Something went wrong, please try again.</strong><br>
			    </div>";
		}

		else{
			
			echo"<div id='myAlert' class='alert alert-success'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Student Registration Success!</strong><br>
			    </div>";
		}
	} 
	else 
	{} 
	?>

			<center><h1 style="font-family: 'Century Gothic';">STUDENT REGISTRATION</h1></center>
			<hr class="style15">
			<div class="card" id ="view_profile" style="float: right; text-align: center;">
			
			  <img src="./images/users/default.png" id="view_image" alt="John" style="width: auto;" height="250dp" >
				
			  <h1 id="view_name">Full Name</h1>
			  <p id="view_course">Course</p>
			  <p id="view_studentNumber">Student Number</p>
			  <p id="view_email">Email</p>
			 
			</div>

			<div class= form>
			<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<table class="table table-bordered" style="width:50%">

					<tr>
						<td><label class="control-label">Student Name</label></td>
						<td><input class="form-control" type="text" name="Name" id = "Name" onkeyup="changeName()" placeholder="Enter Full Name" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Student Number</label></td>
						<td><input class="form-control" type="text" name="StudentNumber" id = "StudentNumber" onkeyup="changeStudentNumber()" placeholder="Enter Student Number (e.g., 2014100000)" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Course</label></td>
						<td><input class="form-control" type="text" name="Course" id = "Course" onkeyup="changeCourse()" placeholder="Enter Course" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">College</label></td>
						<td><input class="form-control" type="text" name="College" id = "College" placeholder="Enter College" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Year Level</label></td>
						<td><input class="form-control" type="text" name="YearLevel" id = "YearLevel" placeholder="Enter Year Level" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Email</label></td>
						<td><input class="form-control" type="text" name="Email" id = "Email" onkeyup="changeEmail()" placeholder="Enter Email" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label">Contact Number</label></td>
						<td><input class="form-control" type="text" name="ContactNumber" id = "ContactNumber" placeholder="Enter Contact Number" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label">User Image</label></td>
						<td><input class="input-group-hello" type="file" name="user_image" id = "user_image" accept="image/*"required onchange="readURL(this)"/></td>
					</tr>

					<tr>

						<td style = "text-align:center;" colspan="2"><Button type="submit" name="btnsave" class="btn btn-default">
								<span class="glyphicon glyphicon-save"></span> &nbsp; Save
							</Button>
						</td>
					</tr>

				</table>

			</form>
			</div>
			
			<!-- END OF CONTENT -->
		</div>
		<script>
		function changeName(){
			document.getElementById('view_name').innerHTML = document.getElementById("Name").value;
		}
		function changeStudentNumber(){
			document.getElementById('view_studentNumber').innerHTML = document.getElementById("StudentNumber").value;
		}
		function changeEmail(){
			document.getElementById('view_email').innerHTML = document.getElementById("Email").value;
		}
		function changeCourse(){
			document.getElementById('view_course').innerHTML = document.getElementById("Course").value;
		}

		 function readURL(input) {
		var url = input.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
		    var reader = new FileReader();

		    reader.onload = function (e) {
		        $('#view_image').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
		}
		else{
		     $('#view_image').attr('src', '/images/librarians/student.png');
		  }
		}


//   function writeUserData(studentName, studentNUmber, course, college,yearLevel, email,contactNumber,userImage) {
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