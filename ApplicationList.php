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

?>

<!DOCTYPE html>
<html>
<style type="text/css">
table{
   width:90%;
   text-align:center;
   border-collapse: separate;
}

table th{
  padding: 8;
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

hr.style15 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}


</style>
<head>
	<title>Admin - Application List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="stylesheet" href="./css/admin.css">

	<link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
	<!-- <script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script> -->
	<script src="http://bootboxjs.com/bootbox.js"></script>
	<!-- <script type="text/javascript" src="scripts/dbconf.js" ></script> -->
	
</head>

<body>


	<?php 
	include('AdminSidebar.php'); 
	?>

	<script type="text/javascript">

		 document.getElementById("homeLi").classList.remove('active');
		 document.getElementById("booksLi").classList.add('active');
		 document.getElementById("newsLi").classList.remove('active');
		 document.getElementById("studentVerificationLi").classList.remove('active');
		 document.getElementById("librariansLi").classList.remove('active');
		 document.getElementById("editSearchPageLi").classList.remove('active');
	</script>
	<?php
	// require __DIR__.'/vendor/autoload.php';

	// use Kreait\Firebase\Factory;
	// use Kreait\Firebase\ServiceAccount;

	// // This assumes that you have placed the Firebase credentials in the same directory
	// // as this PHP file.
	// $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/includes/librarymanagementsystem-7c1ac-c3a7bf53a58f.json');
	// $firebase = (new Factory)
 //    ->withServiceAccount($serviceAccount)
 //    ->create();

	
	// array_map(function (array $userData) {
	//     print_r($userData);
	// }, iterator_to_array($users));

	

	// or
	// array_map(function (\Kreait\Firebase\Auth\UserRecord $user) {
	//     // ...
	// }, iterator_to_array($users));
	// echo "

// 	<script src='https://www.gstatic.com/firebasejs/5.7.0/firebase.js'></script>
// 	 <script type='module' src='scripts/firebaseAdminConnect.js'></script>
// 	<script src='scripts/firebaseAdminConnect.js'></script>
// 	<script>
	
// //LIST ALL USER
// 	function listAllUsers(nextPageToken) {
//   // List batch of users, 1000 at a time.
//   admin.auth().listUsers(1000, nextPageToken)
//     .then(function(listUsersResult) {
//       listUsersResult.users.forEach(function(userRecord) {
//         console.log('user', userRecord.toJSON());
//       });
//       if (listUsersResult.pageToken) {
//         // List next batch of users.
//         listAllUsers(listUsersResult.pageToken)
//       }
//     })
//     .catch(function(error) {
//       console.log('Error listing users:', error);
//     });
// }
// // Start listing users from the beginning, 1000 at a time.
// listAllUsers();
// //END LIST
// </script>";

	?>
	

	<?php

	// $data_table="student";
	// $results_per_page=20;
	include_once './includes/dbhandler.php';
	include_once './includes/dbhandlerpdo.php';
	// $newURL="ApplicationList.php";
	// if(isset($_POST["searchstudent"])&&$_POST["searchstudent"]==""){
	//   header('Location: '.$newURL);
	// }
	// if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	// $start_from = ($page-1) * $results_per_page;
	// if(isset($_POST["searchstudent"])){
	// $sql = "SELECT Name, StudentNumber, UserPic, Course, College, YearLevel,Email, ContactNumber, Verified FROM ".$data_table." WHERE Verified = 0 OR Verified IS NULL ORDER BY Name ASC ";
	// $rs_result=mysqli_query($dbconn, $sql);
	// }
	// $rs_result = $dbconn->query($sql);}
	// $result = $this->execute_query($query);

  // if(mysqli_num_rows($result) > 0)
  // {
  //  while($row = mysqli_fetch_object($result))
  //  {


	?>


	<!-- Page Content -->
		<div id="content">
			 <center><h1 style="font-family: 'Century Gothic';">APPLICATION FOR MOBILE APP</h1></center>
      <hr class="style15">

 		<form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
      	<div class="form-group">
        <input id="myInput" type="text" name="searchstudent" class="form-control" onkeyup="myFunction()" placeholder="Search Applicant"
        size=80>
        <button  ="search" type="submit" class="btn btn-primary btn-md">Search</button>
        <br><br>
    	</div>
		</form>
		<table id="myTable" border="0" bgcolor = "white">
		<tr>
		  <th bgcolor="#CCCCCC"><strong>STUD NO.</strong></th>
		  <th bgcolor="#CCCCCC"><strong>NAME</strong></th>
		  <th bgcolor="#CCCCCC"><strong>USER IMAGE</strong></th>
		  <th bgcolor="#CCCCCC"><strong>COLLEGE</strong></th>
		  <th bgcolor="#CCCCCC"><strong>COURSE</strong></th>
		  <th bgcolor="#CCCCCC"><strong>YEAR & LEVEL</strong></th>
		  <th bgcolor="#CCCCCC"><strong>EMAIL</strong></th>
		  <th bgcolor="#CCCCCC"><strong>CONTACT NO.</strong></th>
		  <th bgcolor="#CCCCCC"><strong>USER TYPE</strong></th>
		  <th bgcolor="#CCCCCC"><strong>ACTION</strong></th>

		</tr>
		<?php
		require __DIR__.'/vendor/autoload.php';

		use Kreait\Firebase\Factory;
		use Kreait\Firebase\ServiceAccount;

		// This assumes that you have placed the Firebase credentials in the same directory
		// as this PHP file.
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/includes/librarymanagementsystem-7c1ac-c3a7bf53a58f.json');
		$firebase = (new Factory)
	    ->withServiceAccount($serviceAccount)
	    ->create();

		// $data_table="student";
		// $sql = "SELECT Name, StudentNumber, UserPic, Course, College, YearLevel,Email, ContactNumber, Verified FROM ".$data_table." WHERE Verified = 0 OR Verified IS NULL ORDER BY Name ASC ";
		// $rs_result=mysqli_query($dbconn, $sql);
		// if (mysqli_num_rows($rs_result)>0) {
		//    // there are some results, retrieve them normally (e.g. with mysql_fetch_assoc())
		//  while($row = $rs_result->fetch_assoc()) {

		$auth = $firebase->getAuth();
		if (isset($_GET["verify_account"]) && isset($_GET["stud_no"])){
		$auth->sendEmailVerification($_GET["verify_account"]);

		$sql = 'SELECT * FROM student WHERE StudentNumber = "'.$_GET["stud_no"].'"';
		$stmt_select = $dbconnpdo->prepare('SELECT * FROM student WHERE StudentNumber = :userNo');
		$stmt_select->execute(array(':userNo'=>$_GET['stud_no']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		$update_sql = "UPDATE student SET UserId = '".$_GET["verify_account"]."' WHERE StudentNumber = '".$_GET["stud_no"]."'";
		$count = $dbconnpdo -> exec($update_sql);
		

		$database = $firebase->getDatabase();
		$database->getReference('User/'.$_GET["verify_account"])
 		  ->set([
       'contactNumber' => $imgRow['ContactNumber'],
       'userName' => $imgRow['Name'],
       'userNumber' => $imgRow['StudentNumber'],
       'userProgram' => $imgRow['Course'],
       'userCollege' => $imgRow['College'],
       'userPic' => $imgRow['UserPic'],
       'yearLevel' => $imgRow['YearLevel'],
       'userType' => $imgRow['UserType'],
       'email' => $imgRow['Email']
      ]);

 		



		echo"<div id='myAlert' class='alert alert-success'>
	        <a href='#' class='close' data-dismiss='alert'>&times;</a>
	        <strong>Email Verification Sent!</strong><br>
	    </div>";
		}	
		// $user = $auth->getUser('ENVelLDYDTdpspHpneO1HH09rzk2');
		// $userInfo = $auth->getUserInfo('ENVelLDYDTdpspHpneO1HH09rzk2');
	 	// echo "<script>console.log( 'Debug Objects: " . $user->email. "' );</script>";	
		$users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
		// $sql = "SELECT Name, StudentNumber, UserPic, Course, College, YearLevel,Email, ContactNumber, Verified FROM ".$data_table." WHERE Verified = 0 OR Verified IS NULL ORDER BY Name ASC ";
		// $rs_result=mysqli_query($dbconn, $sql);
		// if (mysqli_num_rows($rs_result)>0) {
		//    // there are some results, retrieve them normally (e.g. with mysql_fetch_assoc())
		//  while($row = $rs_result->fetch_assoc()) {
		foreach ($users as $user) {
		    /** @var \Kreait\Firebase\Auth\UserRecord $user */
		//     // ...
		// $stmt = $conn->prepare("SELECT Name, StudentNumber, UserPic, Course, College, YearLevel,Email, ContactNumber, UserType FROM student WHERE Email = ?");
		// $stmt->bind_param("s", $user->email);
		if ($user->emailVerified){

		}
		else{
			$sql = "SELECT Name, StudentNumber, UserPic, Course, College, YearLevel,Email, ContactNumber, UserType FROM student WHERE Email = '$user->email'";
		// $sql2 = "SELECT * FROM student WHERE Email = ". $user->email."";
		 // echo "<script>console.log('".$sql."')</script>
		 // <br>";
		$rs_result=$dbconn->query($sql);
		if (!$rs_result || $rs_result->num_rows<0) {
		    // echo "<script>console.log(".$user->email.")</script>";
		    // trigger_error('Invalid query: ' . $dbconn->error);
		    echo '</table><br><br><p>No Applicants Yet!</p>';
		    // echo "<script>console.log('".trigger_error('Invalid query: ' . $dbconn->error)."');</script>";   
		}
		// if ($rs_result->num_rows >=0) {
		// 	 echo "<script>console.log('".$user->email."'')</script>";
		else{

			
		 while($row = $rs_result->fetch_assoc()) {
		
		
		echo "<tr id='myTr'>
		<td>".$row["StudentNumber"] ."</td>
		<td>".$row["Name"] ."</td>
		<td><img src='images/users/".$row['UserPic']."' width='100px' style='padding:8px;'></td>
       	<td>".$row["College"]."</td>
        <td>".$row["Course"]."</td>
      	<td>".$row["YearLevel"]."</td>
       	<td>".$user->email."</td>
      	<td>". $row["ContactNumber"]."</td>
      	<td>". $row["UserType"]."</td>
      	<td><a class='btn btn-info' href='ApplicationList.php?verify_account=".$user->uid."&stud_no=".$row["StudentNumber"]."' title='Verify Account' > Verify</a></td>
        </tr>";

		}

		}
		}
		
		// }
		  
		}
		?> 
		</table>

		</div>

<script>
 
//   function writeUserData(userId,contactNumber, userName, userNumber, userProgram,userType) {
//   	var bookImageRef = firebase.storage().ref('User');
//   	// var preview = document.querySelector('.preview');

//   	firebase.database().ref('User').child(userId).set({
//   		contactNumber: contactNumber,
//   		userName: userName,
//   		userNumber: userNumber,
//   		userProgram: userProgram,
//   		userType: userType
//   	}, function(error) {
//   		if (error) {
//   			alert("Error");
//   		} else {
//       // Data saved successfully!
//       // alert('The book is created successfully!');
//       // window.location.reload();
//   }
// }); 

    // window.location.reload();


// }

<script src="bootstrap/js/bootstrap.min.js"></script> -->

</body>
</html>