<?php 
session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="librarian"){
  }else{
    header('location: UserLogin.php');
  }

require_once "./includes/dbhandler.php";
?>

<html>
<style>
table{
   width:100%;
   text-align:center;
   border-collapse: separate;
}

table th{
  padding: 10;
  text-align:center;
  background-color: #add8e6;
}

table tr:nth-child(even){
  background-color:#ffffff;
}
table tr:nth-child(odd){
  background-color:#add8e6;
}

table td{
  padding: 8;
}

</style>

<head>
	<title>PLM Library</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	 <link rel="stylesheet" href="./css/home.css">

 <script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>


  	<link rel="icon" type="image/png" href="images/PLM_Seal.png" />
</head>
<body >
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

<div class='centered-margined'>
<?php 
  if(isset($_GET['find']) && !empty(isset($_GET['find']))){
    $find = $_GET['find'];
    $stmt_select= "SELECT * FROM student WHERE StudentNumber = $find";
    
    $rs_result=$dbconn->query($stmt_select);

    if(!$rs_result || $rs_result->num_rows<=0){
       echo '</table><br><br><p>Student not found!</p>';
    }
    else{
      $row = $rs_result->fetch_assoc();
      $fetchedName = $row['Name'];
      $fetchedStudentNumber = $row['StudentNumber'];
      $fetchedUserPic = $row['UserPic'];
      $fetchedCourse = $row['Course'];
      $fetchedCollege = $row['College'];
      $fetchedYearLevel = $row['YearLevel'];
      $fetchedEmail = $row['Email'];
    }
  }
 
?>
      <div class="card" id ="view_profile" style="margin-right:20px; float: right; text-align: center;">
      
        <img src="./images/users/<?php echo $fetchedUserPic?>" id="view_image" alt="John" style="width: auto;" height="250px" width= "250px">
        
        <h1 id="view_name"><?php echo $fetchedName?></h1>
        <p id="view_course"><?php echo $fetchedCourse?></p>
        <p id="view_studentNumber"><?php echo $fetchedStudentNumber?></p>
        <p id="view_email"><?php echo $fetchedEmail?></p>
       
      </div>
      <form method="post" enctype="multipart/form-data" class="form-horizontal" >

        <table class="table table-bordered" style="width:50%">

          <tr>
            <td><label class="control-label">Student Name</label></td>
            <td><input class="form-control" type="text" name="Name" id = "Name" onkeyup="changeName()" placeholder="Full Name" value= "<?php echo $fetchedName?>" readonly="true" /></td>
          </tr>
          <tr>
            <td><label class="control-label">Student Number</label></td>
            <td><input class="form-control" type="text" name="StudentNumber" id = "StudentNumber" onkeyup="changeStudentNumber()" value= "<?php echo $fetchedStudentNumber?>" placeholder="Student Number" readonly="true" /></td>
          </tr>
          <tr>
            <td><label class="control-label">Course</label></td>
            <td><input class="form-control" type="text" name="Course" id = "Course" onkeyup="changeCourse()" placeholder="Course" value= "<?php echo $fetchedCourse?>" readonly="true" /></td>
          </tr>
          <tr>
            <td><label class="control-label">College</label></td>
            <td><input class="form-control" type="text" name="College" id = "College" placeholder="College" value= "<?php echo $fetchedCollege?>" readonly="true" /></td>
          </tr>
          <tr>
            <td><label class="control-label">Year Level</label></td>
            <td><input class="form-control" type="text" name="YearLevel" id = "YearLevel" placeholder="Year Level" value= "<?php echo $fetchedYearLevel?>" readonly="true" /></td>
          </tr>
          <tr>
            <td><label class="control-label">Email</label></td>
            <td><input class="form-control" type="text" name="Email" id = "Email" onkeyup="changeEmail()" placeholder="Email" value= "<?php echo $fetchedEmail?>" readonly="true" />
            </td>
          </tr>
          


        </table>

      </form>


</div>


  <!-- JS dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- bootbox code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

</body>
</html>