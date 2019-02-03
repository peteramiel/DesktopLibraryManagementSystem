<?php
session_start();
?>

<html>


<head>
	<title>User - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/login.css">
		<link rel="icon" type="image/png" href="images/icons/PLM_Seal.png" />
	
</head>
<body>

	<nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">PLM</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="Index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			</ul>
		</div>
	</nav>
	<center>
<?php
include_once './includes/dbhandler.php';

if(isset($_POST['login-user']))
{
 $username = $dbconn->real_escape_string($_POST['username']);
 $password = $dbconn->real_escape_string($_POST['password']);




 $res=$dbconn->query("SELECT * FROM librarians WHERE username='$username'");

 $row=mysqli_fetch_array($res);
 
 

// checks it against the database

// if (!get_magic_quotes_gpc()) {
// $_POST['username'] = addslashes($_POST['username']);
// }

$fetched_encrypt = md5($_POST['password']);
$fetched_slash = addslashes($fetched_encrypt);
$check = $dbconn->query("SELECT * FROM librarians WHERE username = '".$_POST['username']."' AND password = '".$fetched_slash."' LIMIT 1")or die(mysql_error());

//Gives error if user dosen't exist
$check2 = $check->num_rows;
if ($check2 == 0) {
// echo"<div id='myAlert' class='alert alert-danger'>
//         <a href='#' class='close' data-dismiss='alert'>&times;</a>
//         <strong>Login Failed!</strong>&nbsp;Password and Username doesn't match!<br>
//     </div>";

}

 
else if($row['password']==($fetched_slash))
 {
  $_SESSION['username'] = $row['username'];
  $_SESSION['role'] = "librarian";
  $_SESSION['id'] = $row['id'];
  header("Location: Home.php");
 }
 else
 {
 	// echo"<div id='myAlert' class='alert alert-danger'>
  //       <a href='#' class='close' data-dismiss='alert'>&times;</a>
  //       <strong>Login Failed!</strong>&nbsp;Password Incorrect!<br>
  //   </div>";
  ?>
  <br>

        <?php
 }
 
}
?>

		<img src="images/icons/PLM_Seal.png" alt="Logo" style="width: 20%">
		<h1><b>Celso Al Karunungan Library</b></h1>
		<br>
		<div class="card">
			<div class = "container2">
				<h2 style = "color:white">User Login</h2>
			</div>
			<br>

			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<div class="container3">
					<input type="text" placeholder="Enter Username" name="username" required>
					<br>
					<input type="password" placeholder="Enter Password" name="password" required>
				</div>
				<div class="container3">
					<button class="btn btn-outline-primary my-2 my-sm-0" name="login-user" type="submit">Login</button>
				</div>
			</form>

			

			<br><br>
		</div>


	</center>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



















