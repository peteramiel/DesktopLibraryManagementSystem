<?php
//session_start();
//if ($_SESSION['fullName']==NULL){
//echo "<script> window.location.href='AdminLogin.php';</script>";
//}

session_start();
if(isset($_SESSION["username"]) && $_SESSION["username"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }

?>

<html>
	
<head>
	<title>Admin - Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/PLM_Seal.png" />
	<script src="http://bootboxjs.com/bootbox.js"></script>
	<script type="text/javascript" src="scripts/dbconf.js" ></script>
</head>


<body>
	<?php include('AdminSidebar.php'); ?>
	<script type="text/javascript">
		 document.getElementById("homeLi").classList.add('active');
		 document.getElementById("booksLi").classList.remove('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("addStudentLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');

	</script>
	
</body>
</html>