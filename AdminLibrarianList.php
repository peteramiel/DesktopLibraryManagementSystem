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


table td{
  padding: 8;
}


div.form
{
    display: block;
    text-align: center;
}
form
{
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}

table tr:nth-child(even){
  background-color: #71c2ce
}


hr.style15 { 
  border: 0; 
  height: 2px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

input .form-control {
  width: 500px;
} 

button .btn.btn-primary.btn-md {
  text-align: right;
  
}

</style>
<head>
  <title>Admin - Librarian List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">

  <link rel="icon" type="image/png" href="images/icons/.png" />
  <script src="http://bootboxjs.com/bootbox.js"></script>
  
</head>

<body>


  <?php 
  include('AdminSidebar.php'); 
  
  ?>

  <script type="text/javascript">

     document.getElementById("homeLi").classList.remove('active');
     document.getElementById("booksLi").classList.remove('active');
     document.getElementById("newsLi").classList.remove('active');
     document.getElementById("studentVerificationLi").classList.remove('active');
     document.getElementById("librariansLi").classList.add('active');
     document.getElementById("editSearchPageLi").classList.remove('active');
  </script>
  <div id="content">
  <?php
    require_once './includes/dbhandlerpdo.php';
  if (isset($_GET["edit_account"])){
    // TODO: EDIT ACCOUNT
  }

  if (isset($_GET["delete"])){
    try {
       // $stmt_select = $dbconn->prepare('SELECT userImage from librarians WHERE id =:item_no');
    // $stmt_select->execute(array(':item_no'=>$_GET['delete']));
    $stmt_select = $dbconnpdo->prepare('SELECT * from librarians WHERE id =:item_no');
    $stmt_select->execute(array(':item_no'=>$_GET['delete']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
    unlink("images/librarians/".$imgRow['userImage']);
    $userName = $imgRow['username'];
    $name = $imgRow['name'];
    $section = $imgRow['section'];
    //RECENT ACTIVITY
    date_default_timezone_set("Asia/Hong_Kong");
  $dateTime = date('l g:i A F j, Y');
  $add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$userName','admin','Delete Librarian','$dateTime','$name in $section');";

    $res = $dbconnpdo-> query($add_activity_sql);
    // it will delete an actual record from db
    $stmt_delete = $dbconnpdo->prepare('DELETE FROM librarians WHERE id =:item_no');
    $stmt_delete->bindParam(':item_no',$_GET['delete']);
    $stmt_delete->execute();
    }

    //catch exception
    catch(Exception $e) {
      echo"<div id='myAlert' class='alert alert-alert'>
          <a href='#' class='close' data-dismiss='alert'>&times;</a>
          <strong>Cant Delete User Please Try </strong><br>
      </div>";
    }
   
    
    
  }


  ?>


  <?php
    include_once './includes/dbhandler.php';
    if (isset($_POST["searchFaculty"]) && $_POST["searchFaculty"]==""){
  
    // header('Location: '.$newURL);
      $sql = "SELECT * FROM librarians";
      $rs_result=$dbconn->query($sql);
    }
    elseif (isset($_POST["searchFaculty"])) {
      echo "<script>console.log('".$_POST['searchFaculty']."')</script>";
      $sql = "SELECT * FROM librarians WHERE name LIKE '%".$_POST['searchFaculty'] ."%' OR id = '".$_POST['searchFaculty']."' OR section LIKE '". $_POST['searchFaculty']."%' ORDER BY name ASC" ;
      
      $rs_result=$dbconn->query($sql);
    }
    else{
      $sql = "SELECT * FROM librarians";
      
      $rs_result=$dbconn->query($sql);
    }


  ?>

  <!-- Page Content -->
    
    <a href="AdminAddLibrarian.php">


      <div class = "form">
          <h1 style="font-family: 'Century Gothic'; color: #000;">LIST OF LIBRARIANS</h1>
      <hr class="style15">

    <button style="font-family: 'Century Gothic'; font-weight:bold;" type="button" class="btn btn-info btn-lg">Add Librarian</button>
    </a>
    <form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <div class="form-group">
        <input id="myInput" type="text" name="searchFaculty" class="form-control" onkeyup="myFunction()" placeholder="Search Personnel or Section"
        size=80 autocomplete="off">
        <button type="submit" class="btn btn-primary btn-md">Search</button>
        <br><br>
      </div>
    </form>
  </div>
    <table id="myTable" border="0" bgcolor = "white">
    <tr>
      <th bgcolor="#CCCCCC"><strong>ID</strong></th>
      <th bgcolor="#CCCCCC"><strong>FULL NAME</strong></th>
      <th bgcolor="#CCCCCC"><strong>USER IMAGE</strong></th>
      <th bgcolor="#CCCCCC"><strong>POSITION</strong></th>
      <th bgcolor="#CCCCCC"><strong>SECTION</strong></th>
      <th bgcolor="#CCCCCC"><strong>USERNAME</strong></th>
      <th bgcolor="#CCCCCC"><strong>ACTION</strong></th>
    </tr>
    <?php
      
    if (!$rs_result || $rs_result->num_rows<=0) {
        // echo "<script>console.log(".$user->email.")</script>";
        // trigger_error('Invalid query: ' . $dbconn->error);
        echo '</table><br><br><p>Personnel not found!</p>';
        // echo "<script>console.log('".trigger_error('Invalid query: ' . $dbconn->error)."');</script>";   
    }
    // if ($rs_result->num_rows >=0) {
    //   echo "<script>console.log('".$user->email."'')</script>";
    else{

      
     while($row = $rs_result->fetch_assoc()) {
    
      echo "<tr id='myTr'>
    <td>".$row["id"] ."</td>
    <td>".$row["name"] ."</td>
    <td><img src='images/librarians/".$row['userImage']."' width='100px' style='padding:8px;'></td>
        <td>".$row["position"]."</td>
        <td>".$row["section"]."</td>
        <td>".$row["username"]."</td>
        <td><a class='btn btn-info' href='AdminLibrarianList.php?edit_account=".$row["id"]."' title='Edit Account' > Edit</a>
            <a class='btn btn-danger' href='AdminLibrarianList.php?delete=".$row["id"]."' title='Delete Account' > Delete</a>
        </td>
        </tr>";

    }

    }
    ?> 
    </table>

    </div>


<!-- Latest compiled and minified JavaScript --><!-- 
<script src="bootstrap/js/bootstrap.min.js"></script> -->

</body>
</html>