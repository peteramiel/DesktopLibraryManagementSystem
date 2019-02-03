<?php
//session_start();
//if ($_SESSION['fullName']==NULL){
//echo "<script> window.location.href='AdminLogin.php';</script>";
//}

session_start();
if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
  }else{
    header('location: AdminLogin.php');
  }
require_once './includes/dbhandlerpdo.php';
$db_result="";
?>
<?php
	
	if(isset($_GET['delete_id'])){
		//ALERT
		//IF ALERT == true{

		//DELETE PICTURE
		$delete_id = $_GET['delete_id'];
		
		$stmt_select = $dbconnpdo->prepare('SELECT * FROM announcements WHERE id =:id');
			$stmt_select->execute(array(':id'=>$_GET['delete_id']));
			$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
			unlink("images/announcements/".$imgRow['attachment']);
			// $stmt_select->close();

			// $result = $dbconn->prepare('DELETE FROM books WHERE callNumber = :callNumber');
			// $result->execute(array(':callNumber' => $_GET['delete_id']));

			// $escapedId= mysqli_real_escape_string($dbconn,$_GET['delete_id']);
			// $sql = "SELECT * FROM books WHERE callNumber = ".$_GET['delete_id'];
			// $rs_result=mysqli_query($dbconn, $sql);
			// if (mysqli_num_rows($rs_result)>0) {
			// 	while($row = $rs_result->fetch_assoc()) {
			// 	unlink("images/books/".$row['uniqueId']);


				// it will delete an actual record from db

			$stmt_delete = "DELETE FROM announcements WHERE id ='".$_GET['delete_id']."'";
			date_default_timezone_set("Asia/Hong_Kong");
			$dateTime = date('l g:i A F j, Y');
			$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','".$_GET['delete_id']."','admin','Delete Announcement','".$dateTime."','".$imgRow['content']."');";
			if ($dbconnpdo->query($stmt_delete) === TRUE && $dbconnpdo->query($add_activity_sql)===TRUE) {
			    echo"<div id='myAlert' style='margin-left:250px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>".$_GET['delete_id']."</strong><br></div>";
			    	

			}

		//}

	}
		
		if(isset($_POST["btnsave"])){
		// $newPostKey = $_POST["uniqueIdName"];
		// $newPostKey = $database->getReference('Admin/News/$newPostKey');
		
		$content = $_POST['content2'];
		
		
	// UPLOAD LIBRARIAN IMAGE 
	if ( $_FILES['user_image']['name'] == "" ||  !$_FILES['user_image']['name'] || empty( $_FILES['user_image']['name'])){
			$userpic = "";
	} else{
			$imgFile = $_FILES['user_image']['name'];
			$tmp_dir = $_FILES['user_image']['tmp_name'];
			$imgSize = $_FILES['user_image']['size'];
	  
	  // 	UPLOAD IMAGE TO LOCAL HOST
			$upload_dir = 'images/announcements/'; // upload directory
	
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
	}
	//UPLOAD TO DATABASE
	date_default_timezone_set("Asia/Hong_Kong");
	$dateTime = date('l g:i A F j, Y');
	
	$insert = "INSERT INTO announcements (content, attachment, dateTime)
	VALUES ('$content','$userpic','$dateTime')";
	$lastId = $dbconnpdo->lastInsertId();
	$add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$lastId','admin','Add Announcement','$dateTime','$content');";
		
		if (!$dbconnpdo->query($insert) || !$dbconnpdo->query($add_activity_sql)) {
		    $db_result .= "<div id='myAlert' class='alert alert-danger'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Oops! Something went wrong, please try again.</strong><br>
			    </div>";
		}

		else{
			
			$db_result .= "<div id='myAlert' class='alert alert-success'>
			        <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Successfully added new Announcement!</strong><br>
			    </div>";
		}
		}
		?>
<html>
<style>
		
hr.style15 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

button .btn.btn-info.btn-lg {
  justify-content: : center;
}

	</style>
<head>
	<style>
		input[type=text] {height: 60px;}
		input[type=submit] {height: 78px;}

	</style>
	<title>Admin - Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">
  	
	 <link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
	<script src="http://bootboxjs.com/bootbox.js"></script>
	<!-- <script type="text/javascript" src="scripts/dbconf.js" ></script> -->
</head>


<body>
	<?php include('AdminSidebar.php'); ?>
	<script type="text/javascript">
		 document.getElementById("homeLi").classList.add('active');
		 document.getElementById("booksLi").classList.remove('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("addStudentsLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');

	</script>

	<div id="content">
		 <center><h1 style="font-family: 'Century Gothic';">HOME</h1></center>
      <hr class="style15">
		<?php echo $db_result; ?>
		<button style = "font-family: 'Century Gothic'; font-weight: bold; " type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Create Announcement</button>


		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h4 class="modal-title">Create Announcement</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <form method="post" enctype="multipart/form-data" id="addPost" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		      <div class="modal-body">
		      	
		      		<!-- <div class="form-horizontal"> -->
					<div class="form-group">
					<textarea class="form-control" rows="3" style="font-size: 24px;" id="content2" name="content2" placeholder="Type an Announcement" required></textarea>
					</div>
					<!-- </div> -->
		      		<!-- <input class="form-control" type="text" name="News" id = "News" placeholder="Type an Announcement" style="font-size: 24px;" height="200px" required /> -->
		      		<div id="image_placement" style="display: inline-block; position: relative;"></div>
		      		<input class="input-group-hello" type="file" name="user_image" id ="user_image" accept="image/*" onchange="readURL(this)"/>
		      	
		        
		      </div>
		      <div class="modal-footer">
		        <button type="submit" name="btnsave" class="btn btn-default" >Post</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<!-- end of modal -->


	<div id="result"></div>



	</div>
		<!-- LOAD THE DATA IN THE PAGE-->
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
	<script>
		
		
		function readURL(input) {
		var url = input.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
		    var reader = new FileReader();
			 $('#img').remove();
			  $('#closeImage').remove();
		   $('#image_placement').append('<img id="img" width="200" height="200" alt="Test Image" title="Upload Image" /><button type="button" id="closeImage" class="close" style=" position: absolute; top: 0; right: 5px;" onclick="picDismiss()">&times;</button>');
			
		    reader.onload = function (e) {
		        $('#img').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
		}
		else{
		     $('#img').attr('src', '/assets/no_preview.png');
		  }
		}

		function picDismiss(){
			 $('#img').remove();
			 $('#closeImage').remove();
			document.getElementById("user_image").value = "";
		}

	</script>
</body>
</html>