<?php

session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }
 require_once './includes/dbhandlerpdo.php';
if (isset($_GET["edit_account"])){
    // TODO: EDIT ACCOUNT
    try{
    $stmt_select = $dbconnpdo->prepare('SELECT * from student WHERE StudentNumber =:stud_no');
    $stmt_select->execute(array(':stud_no'=>$_GET['edit_account']));
    $row=$stmt_select->fetch(PDO::FETCH_ASSOC);
   
    $Name = $row['Name'];
    $StudentNumber =  $row['StudentNumber'];
    $Course = $row['Course'];
    $College = $row['College'];
    $YearLevel = $row['YearLevel'];
    $Email = $row['Email'];
    $ContactNumber = $row['ContactNumber'];
    $Picture = $row['UserPic'];
   
    date_default_timezone_set("Asia/Hong_Kong");
	$dateTime = date('l g:i A F j, Y');
	$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$StudentNumber','admin','Edit Student','$dateTime','$Name in $Course')";
	if(!$dbconnpdo->query($add_activity_sql)){
		 echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Edit User Please Try </strong><br>
      </div>";
	}
    }
    catch(Exception $e) {
      echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Edit User Please Try </strong><br>
      </div>";
    }
  }else{
  	header('location: AdminSearchStudent.php');
  }



?>

<!DOCTYPE html>
<html>
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
	<title>Admin - Edit Student</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/PLM_Seal.png" />
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
	<script src="http://bootboxjs.com/bootbox.js"></script>
	
</head>


<body>
	<?php include('AdminSidebar.php'); 
	?>

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
		$oldNumber= $_POST['edit_account'];


	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
	  
	if($imgFile)
		{
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
		}else{
			$userpic = $_POST['oldPic']; // old image from database
		}
	//UPDATE DATABASE
	$insert = "UPDATE student SET Name = '$userName', StudentNumber = '$userNumber', Userpic = '$userpic', Course = '$course', College = '$college', YearLevel = '$yearLevel', Email = '$email', ContactNumber = '$contactNumber', UserType= 'Student' WHERE StudentNumber = $oldNumber";
	

		// if ($dbconnpdo->connect_errno) {
		//     echo"<div id='myAlert' class='alert alert-danger'>
		// 	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
		// 	        <strong>Can't Connect to the Database</strong><br>
		// 	    </div>";
		// }

		if (!$dbconnpdo->query($insert)) {
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
	
	?>

			<center><h2>Student Registration</h2></center>
			<div class="card" id ="view_profile" style="float: right; text-align: center;">
			
			  <img src="./images/users/<?php echo $Picture; ?>" id="view_image" alt="John" style="width: auto;" height="250dp" >
				
			  <h1 id="view_name"><?php echo $Name; ?></h1>
			  <p id="view_course"><?php echo $Course; ?></p>
			  <p id="view_studentNumber"><?php echo $StudentNumber; ?></p>
			  <p id="view_email"><?php echo $Email; ?></p>
			 
			</div>
			<form method="post" id="edit_form" enctype="multipart/form-data" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<table class="table table-bordered" style="width:50%">

					<tr>
						<td><label class="control-label">Student Name</label></td>
						<td><input class="form-control" type="text" name="Name" id = "Name" onkeyup="changeName()" placeholder="Enter Full Name" value="<?php echo $Name; ?>" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Student Number</label></td>
						<td><input class="form-control" type="text" name="StudentNumber" id = "StudentNumber" onkeyup="changeStudentNumber()" value="<?php echo $StudentNumber; ?>" placeholder="Enter Student Number (e.g., 2014100000)" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Course</label></td>
						<td><input class="form-control" type="text" name="Course" value="<?php echo $Course; ?>" id = "Course" onkeyup="changeCourse()" placeholder="Enter Course" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">College</label></td>
						<td><input class="form-control" type="text" value="<?php echo $College ?>" name="College" id = "College" placeholder="Enter College" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Year Level</label></td>
						<td><input class="form-control" type="text" value="<?php echo $YearLevel ?>" name="YearLevel" id = "YearLevel" placeholder="Enter Year Level" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Email</label></td>
						<td><input class="form-control" type="text" name="Email" value="<?php echo $Email ?>" id = "Email" onkeyup="changeEmail()" placeholder="Enter Email" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label">Contact Number</label></td>
						<td><input class="form-control" type="text" value="<?php echo $ContactNumber ?>" name="ContactNumber" id = "ContactNumber" placeholder="Enter Contact Number" required />
						</td>
					</tr>
					<tr>
						<td><label class="control-label">User Image</label></td>
						<td><input class="input-group-hello" type="file" name="user_image" id = "user_image" accept="image/*" onchange="readURL(this)"/></td>
					</tr>
					<input type="hidden" name="edit_account" value="<?php echo $StudentNumber?>">
					<input type="hidden" name="oldPic" value="<?php echo $Picture?>">
					

					<tr>

						<td colspan="2"><Button type="submit" name="btnsave" class="btn btn-default">
								<span class="glyphicon glyphicon-save"></span> &nbsp; Save
							</Button>
						</td>
					</tr>

				</table>

			</form>
			
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
		     $('#view_image').attr('src', '/assets/no_preview.png');
		  }
		}

		 $("#edit_form").on("submit", function(){
		   $_POST['edit_account']= $_GET['edit_account'];
		   console.log($_POST['edit_account']);
		   $_POST['oldPic'] = $Picture;
		   return false;
		 })
  
</script>
</body>
</html>