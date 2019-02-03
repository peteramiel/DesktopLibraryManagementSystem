<?php 
$servername = "localhost";
$username = "root";
$password = "";

try {
    $dbconn = new PDO("mysql:host=$servername;dbname=rblms", $username, $password);
    // set the PDO error mode to exception
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>

<html>

<style>
.title{
    font-family: sans-serif;
    color: #dc2d5e;
}

.container {
    position: relative;
    width: 150px;
    height: 150px;
    display: inline;
    margin-top: 199px;
}


.image {
    display: inline-block;
    width: 150px;
    height: 150px;
    margin-bottom: 20px;
}


.text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: sans-serif;
}


.overlayFade{
    height: 250%;
    width:100%;
    top:0;
    left:0;
}
.overlay {
    position: absolute;
    opacity: 0;
    transition:all .3s ease;
    background-color: #008cba;
}
.container:hover .overlay,.container:hover .overlayFade {
    opacity: 1;
    margin-top: 35px;
}

.overlayLeft{
    height: 250%;
    width:100%;
    top:0;
    left:0;
    background-color: #00b1ba;
}
.overlayRight{
    height: 250%;
    width: 100%;
    top:0;
    right:0;
    background-color: #12888e;
}
.container:hover .overlayLeft ,.container:hover .overlayRight {
    width: 100%;
    margin-top: 35px;
}
.overlayTop{
    width: 100%;
    height: 250%;
    top:0;
    left:0;
    background-color: #d63c58;

}
.overlayBottom{
    width: 100%;
    height: 250%;
    top: 25%;
    bottom:0;
    left:0;
    background-color: #941e33;
}
.container:hover .overlayTop {
    height: 250%;
    margin-top: 35px;
    height: 250%;


    }
.container:hover .overlayBottom {
    margin-top: 35px;
    height: 250%;
}



.overlayCross{
    width: 100%;
    height: 250%;
    top:30%;
    left:0;
    background-color: #e47a52;
}
.container:hover .overlayCross {
    height: 250%;
    width: 100%;
    margin-top: 35px;
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

    <h1 style="text-align: center; font-family: 'Century Gothic'; margin-top: 20px;">LIBRARY PERSONNEL</h1>

	<div align="center" style="margin-top: 40px">
   <div style="margin: 0 150px 0 150px">
    
    <input type="text" name="search" class="form-control" id="search" placeholder="Search Librarian"><br><br>
    </div>
  
    <div id="result"></div>






</div>
        

  <script>
       $(document).ready(function(){

      load_data();

      function load_data(page)
      {
       var action = "Load";
       $.ajax({
        url:"Fetch_Librarians_User.php",
        method:"POST",
        data:{action:action, page:page},
        success:function(data)
        {
         $('#result').html(data);
   
        }
       });
      }

     
      
      $('#search').keyup(function(){
       var query = $('#search').val();
       var action = "Search";
       if(query != '')
       {
        $.ajax({
         url:"Fetch_Librarians_User.php",
         method:"POST",
         data:{query:query, action:action},
         success:function(data)
         {
          $('#result').html(data);
         }
        });
       }
       else
       {
        load_data();
       }
      });
      
     });
  </script>





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