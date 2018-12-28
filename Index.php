<html>
<head>
	<title>PLM Library</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	 <link rel="stylesheet" href="./css/home.css">

  	<link rel="icon" type="image/png" href="images/PLM_Seal.png" />
</head>
<body>
	<nav class="navbar" style="background-color: #ECEDEF">
    	<div class="navbar-header">
      	<a class="navbar-brand" href="#">PLM Library System</a>
      	</div>

		<div class="navbar-form">
		<form class="form-inline">
    	<input class="form-control mr-sm-2" type="search" placeholder=" Search" style="font-family:Arial, FontAwesome font-style: normal; font-weight: normal;text-decoration: inherit; color:#5D5763;" aria-label="Search" >
    	<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
  		</form>
  		</div>

		<ul class="nav justify-content-end">
		<li class="nav-item">
    	<a class="nav-link" href="UserLogin.php" onclick="Home.php"><i class='fas fa-user'></i> User</a>
  		</li>
		<li class="nav-item">
    	<a class="nav-link" href="AdminLogin.php" onclick="AdminLogin.php"><i class='fas fa-user-cog'></i> Admin</a>
  		</li>
 		</ul>
	</nav>

	<nav class="navbar" id="home_nav" style="border-bottom:#79BF2B 5px solid; padding-bottom: 20px">
	
      	<img src="images/icons/images_library_book.png" alt="Logo" height="80px" >
      	
		<ul class="nav justify-content-end" >

		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#" ><i class='far fa-comment' style='font-size:48px;'></i><br>About</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#" "><i class='fas fa-id-badge' style='font-size:48px;'></i><br>Mobile App</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#"><i class='far fa-map' style='font-size:48px;'></i><br>Map</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#"><i class='fas fa-book' style='font-size:48px;'></i><br>Catalog</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#" ><i class='far fa-newspaper' style='font-size:48px;'></i><br>News</a>
    	</center>
  		</li>

  		<li class="nav-item" href="#"><center>
    	<a class="nav-link" href="#" ><i class='far fa-user-circle' style='font-size:48px;'></i><br>Librarians</a>
    	</center>
  		</li>

 		</ul>
	</nav>

	<section id="showcase">
		<div class="container" id="showcase_message">
			<h2>WELCOME TO</h2>
			<h1>The Al Celso Karunungan Library</h1>
			<p>We offer a variety of programs for all ages. with information and registration available right here on our website</p>
		</div>
	</section>

	<section class="section">
		<div id="news_section">
		<div class="section_title">
			<h3><i class='far fa-newspaper'></i> Recent News</h3>
		</div>
		<div id="news_content">
			<br>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In massa turpis, eleifend et imperdiet sed, aliquam interdum ex. In hac habitasse platea dictumst. Nam massa quam, sollicitudin tincidunt lectus in, semper efficitur eros. In at urna at nulla viverra semper aliquet vel nibh. Aliquam tristique justo faucibus, lacinia ante eget, tristique enim.</p>
			<p>12/22/2018, 8:40pm</p>
			
			<p>Nulla imperdiet iaculis est et vulputate. Sed mauris magna, suscipit ac volutpat ut, aliquet a sapien. Sed et lorem non nisi consequat pellentesque. In egestas ex sit amet diam rutrum pellentesque. Nulla facilisi. Mauris a tempus dui. Aliquam at posuere diam. Vestibulum ac lorem consequat, malesuada justo vel, vehicula nisl.</p>
			<p>12/22/2018, 8:40pm</p>
		</div>
		</div>
	</section>
	
	<section class="section">
		<div id="library_sched_section">
		<div class="section_title">
			<h3><i class="far fa-clock"></i> Library Hours</h3>
		</div>
			<br>
			<table id="library_sched_table">
				<tr>
					<td>Monday</td>
					<td>7am-7pm</td>
				</tr>
				<tr>
					<td>Tuesday</td>
					<td>7am-7pm</td>
				</tr>
				<tr>
					<td>Wednesday</td>
					<td>7am-7pm</td>
				</tr>
				<tr>
					<td>Thursday</td>
					<td>7am-7pm</td>
				</tr>
				<tr>
					<td>Friday</td>
					<td>7am-7pm</td>
				</tr>
				<tr>
					<td>Saturday</td>
					<td>7am-7pm</td>
				</tr>
			</table>
		</div>
	</section>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>