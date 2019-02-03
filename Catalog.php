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
.card {
  box-shadow: 0 2px 4px 1px rgba(0,0,0,0.2);
  width: 200px;
  position: relative;
  /*z-index: 0;*/
  text-align: center;
  margin: 10px 3px 10px;
  background-color:white;
  transition:.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 4px 8px 4px rgba(0,0,0,0.2);
  transform: scale(1.03);
}
body{
  max-width:100%;
  overflow-x: hidden;
  overflow-y: scroll;
}

.container3{
background-color: #92c6d7;
padding: 1px 0px 5px 0px;
width: 140px;
height: 45px;
}

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: black;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}



p.capitalize{
  text-transform:capitalize;
  text-align: center;
  margin-bottom: 0px;
  margin-bottom: 0rem;
}

p{
  margin-bottom: 0rem;
}

span.buttons{
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
  width:140px;
  display: block;
  overflow:  hidden;
}

div.col-xs-3{
  padding-left: 15px;
  padding-right: 15px;
  text-align: center;
  
}
/*div.col-xs-3{
  text-align: center;
}
p{
  text-align: right;
}
*/

.cards{
  display: flex;
   flex-flow: row wrap;
  justify-content: flex-start;
}

/*FOR TOOLTIP*/
.card .tooltiptext {
  visibility: hidden;
  width: 200px;
  background-color: gray;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  font-size: 14px;
  /* Position the tooltip */

 position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 40%;
  margin-left: -60px;
  /* Fade in tooltip - takes 1 second to go from 0% to 100% opac: */
  opacity: 0;
  transition: opacity 1s;
}

.card:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

.imagetext{
  display : table-row;
  
vertical-align : bottom;
height: 1px;
    margin: 0;
  bottom: 2px;
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

    <h1 style="text-align: center; font-family: 'Century Gothic'; margin-top: 20px;">BOOK CATALOG</h1>

	 <div align="center" style="margin-top: 40px">
   <div style="margin: 0 150px 0 150px">
    
    <input type="text" name="search" class="form-control" autocomplete="off" id="search" placeholder="Search Book"><br><br>
    </div>
    <center>
    <div id="result" style="margin: 0px 40px;"></div>
    </center>





</div>
        

 <script type="text/javascript">
  
    var page=1;
   $(document).ready(function(){

    load_data(page);

    function load_data(page)
    {
     var action = "Load";
     $.ajax({
      url:"Fetch_Books_Admin.php",
      method:"POST",
      data:{action:action, page:page},
      success:function(data)
      {
       $('#result').html(data);
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

    
    $('#search').keyup(function(){
     var query = $('#search').val();
     var action = "Search";
     if(query != '')
     {
      $.ajax({
       url:"Fetch_Books_Admin.php",
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