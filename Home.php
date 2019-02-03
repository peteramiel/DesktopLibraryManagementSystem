<?php
session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="librarian"){
  }else{
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

  		<link rel="icon" type="image/png" href="images/icons/logo_circle_small.png" />
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
<!-- 
	<section id="showcase">
		<div style= "height: 300px;" class="container" id="showcase_message">
			<h2>WELCOME TO</h2>
			<h1>The Celso Al Carunungan Memorial Library</h1>
			<p>We offer a variety of programs for all ages. with information and registration available right here on our website</p>
		</div>
	</section> -->

	<div>
		 <center><h1 style="font-family: 'Century Gothic'; margin-left: 10px;">HOME</h1></center>
		<div style = "text-align: center;"id="news_section">
		<!-- <div class="section_title">
			<h3><i class='far fa-newspaper'></i> Recent News</h3>
		</div> -->
		<div id="news_content">
			
			
		</div>
		</div>
	</div>
	

	<script type="text/javascript">
	
	  var page=1;
	 $(document).ready(function(){

	  load_data(page);

	  function load_data(page)
	  {
	   var action = "Load";
	   $.ajax({
	    url:"Fetch_Announcements.php",
	    method:"POST",
	    data:{action:action, page:page},
	    success:function(data)
	    {
	     $('#news_content').html(data);
	      var btns = document.getElementById("pagination").getElementsByClassName("pagination_link");
	      btns[page+1].className+= " active";
	      if (page==1){
	      btns[0].style.display = "none";
	      btns[1].style.display = "none";
	      }
	      if (page==total_pages){
	      document.getElementById("last").style.display = "none";
	      document.getElementById("next").style.display = "none";
	      }
	      for (var i = 0; i < btns.length; i++) {
	      btns[i].addEventListener("click", function() {
	      var current = document.getElementsByClassName("active");
	       current[1].className = current[1].className.replace(" active", "");
	      this.className += " active";
	      });
	      }
	    }
	   });
	  }

	  $(document).on('click', '.pagination_link', function(){

	    if ($(this).attr("id")=="next"){
	      if (page<total_pages){
	        page=parseInt(page);
	        page=page+1;
	        load_data(page);
	      }
	    } 
	    else if ($(this).attr("id")=="prev"){
	      if(page&&page!=1){
	        page=page-1;
	        load_data(page);
	      }
	    }
	     else if ($(this).attr("id")=="first"){
	        load_data(1);
	        page=1;
	    }
	     else if ($(this).attr("id")=="last"){
	        load_data(total_pages);
	        page=total_pages;
	    }
	    else{ 
	      page = $(this).attr("id");
	      page=parseInt(page);
	      load_data(page); 
	      
	    }
	  });

	  

	 });
	</script>
 
</body>
</html>