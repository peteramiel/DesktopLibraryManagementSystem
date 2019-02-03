<?php

session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }
 require_once './includes/dbhandlerpdo.php';
//Initialize (Put values in form)
	if(isset($_GET['edit_account'])){
		 $stmt_select = $dbconnpdo->prepare('SELECT * from admin WHERE id =:stud_no');
    $stmt_select->execute(array(':stud_no'=>$_GET['edit_account']));
    $row=$stmt_select->fetch(PDO::FETCH_ASSOC);
   
    $idStart = $row['id'];
    $nameStart = $row['name'];
    $positionStart = $row['position'];
    $sectionStart = $row['section'];
    $usernameStart = $row['username'];
    $userImageStart = $row['userImage'];
   	$passwordStart = $row['password'];
    date_default_timezone_set("Asia/Hong_Kong");
	$dateTime = date('l g:i A F j, Y');
	$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$idStart','admin','Edit Admin','$dateTime','$nameStart in $sectionStart')";
	if(!$dbconnpdo->query($add_activity_sql)){
		 echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Edit User Please Try </strong><br>
      </div>";
	}
	}else{
		header('location: AdminSearchAdmin.php');
	}
	//This code runs if the form has been submitted
	if (isset($_POST['btnsave'])) { 
		$id = $_POST['id'];
		$name = $_POST['Name'];
		$position = $_POST['Position'];
		$section = $_POST['Section'];
		$userName = $_POST['Username'];
		$password = $_POST['Password'];

		if($password==""){
			$password = $_POST['oldPw'];
		}else{
		$password_encrypt = md5($password);
		$password_slash = addslashes($password_encrypt);
		$password = $password_slash;	
		}

			
		
	// UPLOAD LIBRARIAN IMAGE 
			$imgFile = $_FILES['user_image']['name'];
			$tmp_dir = $_FILES['user_image']['tmp_name'];
			$imgSize = $_FILES['user_image']['size'];
	if($imgFile){  
	  // 	UPLOAD IMAGE TO LOCAL HOST
			$upload_dir = 'images/admin/'; // upload directory
	
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
			$userpic = $_POST['oldPic'];
		}

	//UPLOAD TO DATABASE
	// admin (name, position, section, username, password,userImage)
	// VALUES ('$name', '$position', '$section', '$userName','$password','$userpic')"
	$insert = "UPDATE admin SET name = '$name', position = '$position', section ='$section', username= '$userName',password='$password' , userImage ='$userpic' WHERE id='$id'";

	
// $insert = "UPDATE student SET Name = '$userName', StudentNumber = '$userNumber', Userpic = '$userpic', Course = '$course', College = '$college', YearLevel = '$yearLevel', Email = '$email', ContactNumber = '$contactNumber', UserType= 'Student' WHERE StudentNumber = $oldNumber";
	

		if ($dbconnpdo->connect_errno) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Can't Connect to the Database</strong><br>
			    </div>";
		}

		if (!$dbconnpdo->query($insert)) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Oops! Something went wrong, please try again.</strong><br>
			    </div>";
		}

		else{
			
			echo"<div id='myAlert' class='alert alert-success'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Successfully edited Admin!</strong><br>
			    </div>";
		}
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
	<title>Admin - Edit Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/PLM_Seal.png" />
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
		 document.getElementById("librariansLi").classList.add('active');
		 document.getElementById("addStudentsLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');
	</script>


	<!-- Page Content -->
		<div id="content">


			<center><h2>Edit Admin</h2></center>
			<div class="card" id ="view_profile" style="float: right; text-align: center;">
			
			  <img src="./images/librarians/download.png" id="view_image" alt="John" style="width: auto;" height="250dp" >
				
			  <h1 id="view_name">Full Name</h1>
			  <p id="view_position">Position</p>
			  <p id="view_section">Section</p>
			  <p id="view_username">Username</p>
			 
			</div>
			<form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<table class="table table-bordered" style="width:50%">

					<tr>
						<td><label class="control-label">Full Name</label></td>
						<td><input class="form-control" value="<?php echo $nameStart?>" type="text" name="Name" id = "Name" onkeyup="changeName()" placeholder="Enter Full Name" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Position</label></td>
						<td><input class="form-control" value="<?php echo $positionStart?>" type="text" name="Position" id = "Position" onkeyup="changePosition()" placeholder="Enter Position" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Section</label></td>
						<td><input class="form-control" value="<?php echo $sectionStart?>" type="text" name="Section" id = "Section" onkeyup="changeSection()" placeholder="Enter Section"/></td>
					</tr>
					<tr>
						<td><label class="control-label">Username</label></td>
						<td><input class="form-control" value="<?php echo $usernameStart?>" type="text" name="Username" id = "Username" placeholder="Enter Username" onkeyup="changeUsername()" /></td>
					</tr>
					
					<tr>
						<td><label class="control-label">Password</label></td>
						<td><input class="form-control" type="password" name="Password" id = "Password" placeholder="Enter Password" />
						</td>
					</tr>
					
					<tr>
						<td><label class="control-label">User Image</label></td>
						<td><input class="input-group-hello" type="file" name="user_image" id = "user_image" accept="image/*" onchange="readURL(this)"/></td>
					</tr>
					<input type="hidden" name="oldPic" value="<?php echo $userImageStart?>">
					<input type="hidden" name="id" value="<?php echo $_GET['edit_account']?>">
					<input type="hidden" name="oldPw" value="<?php echo $passwordStart?>">

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
		function changePosition(){
			document.getElementById('view_position').innerHTML = document.getElementById("Position").value;
		}
		function changeSection(){
			document.getElementById('view_section').innerHTML = document.getElementById("Section").value;
		}
		function changeUsername(){
			document.getElementById('view_username').innerHTML = document.getElementById("Username").value;
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
		     $('#view_image').attr('src', './images/librarians/download.png');
		  }
		}


</script>
</body>
</html>