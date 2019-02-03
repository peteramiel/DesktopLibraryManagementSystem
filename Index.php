<html>
<style >
	body {
	margin: 0;
	padding: 0;
}

.wrapper{

	height: 100%;
	width: 100%;
	background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.6) ), url("images/icons/index_bg.jpg") no-repeat center center fixed;
	background-position: center;
	background-size: cover;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	font-size: large;
	color: #fff;
}

@keyframes animate{
	0% {
		transform: scale(0);
	}
	100% {
		transform: scale(1);
	}
}


h1{	
	animation: animate 2s 1;

}

.nav-link{
	text-decoration: none;
	padding: 10px 30px;
	transition: 0.6s ease;
	color: #5cbbe8;
	font-size: 10px;
	animation: animate 2s 1;
	font-family: 'Century Gothic'

}

.nav-link:hover{
	background-color: #fff;
	color: #1c3359;
	border: 1px solid #fff;
}


	
</style>

<head>
	<title>Welcome!</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- 	 <link rel="stylesheet" href="./css/home.css"> -->

  	<link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
</head>
<body>

	<div class="wrapper">
		<h1 style= "font-size:90px" >W E L C O M E !</h1>
		<a class="nav-link" href="UserLogin.php"  onclick="UserLogin.php"><h1><i class='fas fa-user'></i> User</h1></a>
		<a class="nav-link" href="AdminLogin.php"  onclick="AdminLogin.php"><h1><i class='fas fa-user-cog'></i> Admin</h1></a>

	</div>
	

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>