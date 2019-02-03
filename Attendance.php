<?php 
session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="librarian"){
  }else{
    header('location: UserLogin.php');
  }

require_once "./includes/dbhandlerpdo.php";
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	 <link rel="stylesheet" href="./css/home.css">

 <script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>


  	 <link rel="icon" type="image/png" href="images/icons/logo_circle_small.png" />
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

    <h1 style="text-align: center; font-family: 'Century Gothic'; margin-top: 20px;">STUDENT ATTENDANCE</h1>

        

  <?php
    include_once './includes/dbhandler.php';
    if (isset($_POST["searchAttendance"]) && $_POST["searchAttendance"]==""){
  
    // header('Location: '.$newURL);
      $sql = "SELECT * FROM list ORDER BY Date DESC";
      $rs_result=$dbconn->query($sql);
    }
    elseif (isset($_POST["searchAttendance"])) {
      $sql = "SELECT * FROM list WHERE Name LIKE '%".$_POST['searchAttendance'] ."%' OR StudentNumber = '".$_POST['searchAttendance']."' OR Date LIKE '". $_POST['searchAttendance']."%' ORDER BY Date DESC" ;
      
      $rs_result=$dbconn->query($sql);
    }
    else{
      $sql = "SELECT * FROM list ORDER BY Date DESC";
      
      $rs_result=$dbconn->query($sql);
    }


  ?>

 <!-- Page Content -->
    <div id="content">
   
    <form class="form-inline" style="margin: 0 200px 0 200px" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <center>
        <input id="myInput" type="text" name="searchAttendance" class="form-control" placeholder="Search Student Name or Date" size=100% autocomplete="off">
        <button type="submit" class="btn btn-primary btn-md">Search</button>
       
      
       
    <br><br>
        </center>
   
   </form>
    <table id="myTable" border="0" bgcolor = "white">
    <tr>
      <th bgcolor="#CCCCCC"><strong>Name</strong></th>
      <th bgcolor="#CCCCCC"><strong>Student Number</strong></th>
      <th bgcolor="#CCCCCC"><strong>Student Image</strong></th>
      <th bgcolor="#CCCCCC"><strong>College</strong></th>
      <th bgcolor="#CCCCCC"><strong>Course</strong></th>
      <th bgcolor="#CCCCCC"><strong>Date</strong></th>
    </tr>
    <?php
      $self=$_SERVER['PHP_SELF'];
    if (!$rs_result || $rs_result->num_rows<=0) {
        // echo "<script>console.log(".$user->email.")</script>";
        // trigger_error('Invalid query: ' . $dbconn->error);
        echo '</table><br><br><p>Attendance not found!</p>';
        // echo "<script>console.log('".trigger_error('Invalid query: ' . $dbconn->error)."');</script>";   
    }
    // if ($rs_result->num_rows >=0) {
    //   echo "<script>console.log('".$user->email."'')</script>";
    else{

      
     while($row = $rs_result->fetch_assoc()) {
      $StudentNumberCurrent = $row['StudentNumber'];
      $DateCurrent = substr($row["Date"], 0, -9);
      $stmt_select = "SELECT UserPic FROM student WHERE StudentNumber = $StudentNumberCurrent";
      $image_result=$dbconn->query($stmt_select);
      $row1 = $image_result->fetch_assoc();

      echo "<tr id='myTr'>
    <td><a href='FindStudent.php?find=$StudentNumberCurrent'>".$row["Name"] ."</a></td>
    <td><a href='FindStudent.php?find=$StudentNumberCurrent'>".$row["StudentNumber"] ."</a></td>

    <td><img src='images/users/".$row1['UserPic']."' width='100px' style='padding:8px;'></td>
        <td>".$row["Course"]."</td>
        <td>".$row["College"]."</td>   
        <form action='$self' method='POST'>
        <input type='hidden' name='searchAttendance' value='$DateCurrent' />
        <td><button class='btn btn-link' onClick='submit();'>".$row["Date"]."</button></td>
        </form>
        </tr>";
  
   
    }

    }
    ?> 
    </table>

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