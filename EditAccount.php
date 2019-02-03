<?php
session_start();
if(isset($_SESSION["id"]) && $_SESSION["role"]=="librarian"){
  
require_once './includes/dbhandlerpdo.php';

try{

	$stmt_select = $dbconnpdo->prepare('SELECT * from librarians WHERE id =:id');
	$stmt_select->execute(array(':id'=>$_SESSION["id"]));
    $row=$stmt_select->fetch(PDO::FETCH_ASSOC);
   
    $NameStart = $row['name'];
    $PositionStart= $row['position'];
    $UsernameStart=$row['username'];
    $PasswordStart = $row['password'];
    $IdStart =  $row['id'];
    $SectionStart = $row['section'];
    $UserImageStart = $row['userImage'];
    
}catch(Exception $e){
echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Edit User Please Try </strong><br>
      </div>";
}
}
else{
    header('location: UserLogin.php');
  }
?>

<html>

<head>
	<title>PLM Library</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	 <link rel="stylesheet" href="./css/home.css">

  	<link rel="icon" type="image/png" href="images/icons/PLM_Seal.png" />

</head>

	<?php 

	//This code runs if the form has been submitted
	if (isset($_POST['btnsave'])) { 
	date_default_timezone_set("Asia/Hong_Kong");
	$dateTime = date('l g:i A F j, Y');
	$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$IdStart','librarian','Edit Account','$dateTime','$NameStart in $SectionStart')";
	if(!$dbconnpdo->query($add_activity_sql)){
		 echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Edit User Please Try </strong><br>
      </div>";
	}


		$name = $_POST['Name'];
		$position = $_POST['Position'];
		$section = $_POST['Section'];
		$userName = $_POST['Username'];

		if($_POST['Password']==""){
		$password = $PasswordStart;
		}else{
		$password = $_POST['Password'];
		$password_encrypt = md5($password);
		$password_slash = addslashes($password_encrypt);
		$password = $password_slash;			
		}
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
	// UPLOAD LIBRARIAN IMAGE 
	if ($imgFile)
	{
			
	  
	  // 	UPLOAD IMAGE TO LOCAL HOST
			$upload_dir = 'images/librarians/'; // upload directory
	
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
		$userpic=$_POST['oldPic'];
	}
	//UPLOAD TO DATABASE
	$insert ="UPDATE librarians SET name ='$name', password='$password',position='$position', section='$section',username='$userName',userImage='$userpic' WHERE id ='".$_POST['id']."'";
	
	if (!$dbconnpdo->query($insert)) {
		    echo"<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Oops! Something went wrong, please try again.</strong><br>
			    </div>";
		}

		else{
			
			echo"<div id='myAlert' class='alert alert-success'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Edit Librarian Success!</strong><br>
			    </div>";
		}

}
	

	
	?>



<body>
	<nav class="navbar" style="background-color: #ECEDEF">
    	<div class="navbar-header">
      	<a class="navbar-brand" href="Home.php">PLM Library System</a>
      	</div>


		
		<ul class="nav justify-content-end">
		<li class="nav-item">
    	<a class="nav-link" href="Home.php"><i class='fas fa-arrow-left'></i> Back</a>
  		</li>
		<li class="nav-item">
    	<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  		</li>
 		</ul>
	</nav>


<div style="border-bottom:#79BF2B 5px solid; margin-bottom: 30px;">
</div>
<div style="margin: 20px 300px 20px 300px;">
<div class="card" id ="view_profile" style="float: right; text-align: center;">
			
			  <img src="./images/librarians/<?php echo $UserImageStart; ?>" id="view_image" alt="John" style="width: auto;" height="250dp" >
				
			  <h1 id="view_name" style="width: 300px"><?php echo $NameStart?></h1>
			  <p id="view_position"><?php echo $PositionStart?></p>
			  <p id="view_section"><?php echo $SectionStart?></p>
			  <p id="view_username"><?php echo $UsernameStart?></p>
			 
</div>
			<form  method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

				<table class="table table-bordered" style="width:50%">

					<tr>
						<td><label class="control-label">Full Name</label></td>
						<td><input class="form-control" type="text" name="Name" id = "Name" onkeyup="changeName()" placeholder="Enter Full Name" value="<?php echo $NameStart; ?>" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Position</label></td>
						<td><input class="form-control" type="text" name="Position" id = "Position" onkeyup="changePosition()" placeholder="Enter Position" value="<?php echo $PositionStart; ?>" required /></td>
					</tr>
					<tr>
						<td><label class="control-label">Section</label></td>
						<td><input class="form-control" type="text" name="Section" id = "Section" onkeyup="changeSection()" value="<?php echo $SectionStart; ?>" placeholder="Enter Section"/></td>
					</tr>
					<tr>
						<td><label class="control-label">Username</label></td>
						<td><input class="form-control" type="text" name="Username" id = "Username" placeholder="Enter Username" value="<?php echo $UsernameStart; ?>" onkeyup="changeUsername()" /></td>
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
					<input type="hidden" name="id" value="<?php echo $IdStart?>">
					<input type="hidden" name="oldPic" value="<?php echo $UserImageStart?>">
					<tr>

						<td colspan="2"><Button type="submit" name="btnsave" class="btn btn-default">
								<span class="glyphicon glyphicon-save"></span> &nbsp; Save
							</Button>
						</td>
					</tr>

				</table>

			</form>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>