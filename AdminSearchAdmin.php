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
  background-color: #71c2ce
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
td .form-control{
  width: 450px;
  height: 30px;
}


</style>
<head>
  <title>Admin - Search Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">

  <link rel="icon" type="image/png" href="images/icons/logo_circle.png" />
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
     document.getElementById("studentVerificationLi").classList.add('active');
     document.getElementById("librariansLi").classList.remove('active');
     document.getElementById("editSearchPageLi").classList.remove('active');
  </script>
  <?php
    require_once './includes/dbhandlerpdo.php';
    $errorResult="";

  if (isset($_GET["delete"])){
    try {
 
    $stmt_select = $dbconnpdo->prepare('SELECT * from admin WHERE id =:stud_no');
    $stmt_select->execute(array(':stud_no'=>$_GET['delete']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
    if($imgRow['userImage']=="download.png"){

    }else{
    unlink("images/admin/".$imgRow['userImage']);
    }
    $idDelete= $imgRow['id'];
    $nameDelete =  $imgRow['name'];
    $sectionDelete = $imgRow['section'];
    $userNameDelete = $imgRow['username'];
    $stmt_delete = $dbconnpdo->query("DELETE FROM admin WHERE id ='$idDelete'");

    //RECENT ACTIVITY
    date_default_timezone_set("Asia/Hong_Kong");
    $dateTime = date('l g:i A F j, Y');
    $add_activity_sql = $dbconnpdo->query("INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$idDelete','admin','Delete Admin','$dateTime','$nameDelete - $sectionDelete'");


    // it will delete an actual record from db
    // $stmt_delete->bindParam(':item_no',$_GET['delete']);
    // $stmt_delete->execute();
    }

    //catch exception
    catch(Exception $e) {
      // echo"<div id='myAlert' class='alert alert-alert'>
      //     <a href='#' class='close' data-dismiss='alert'>&times;</a>
      //     <strong>Cant Delete Admin Please Try </strong><br>
      // </div>";
      // $errorResult .=  "<div id='myAlert' class='alert alert-alert'>
      //      <a href='#' class='close' data-dismiss='alert'>&times;</a>
      //      <strong>Cant Delete Admin Please Try Again</strong><br>
      //  </div>";
       $errorResult .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oops!</strong> Cant delete Admin please try again.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      // echo '<script type="text/javascript">window.onload = function() { document.gt">
      //     <a href="#" class="close" data-dismiss="alert">&times;</a>
        //     <strong>Cant Delete Admin Please Try </strong><br>
      // </div>"; }</script>';

    }
  }


  ?>


  <?php
    include_once './includes/dbhandler.php';
    if (isset($_POST["searchAdmin"]) && $_POST["searchAdmin"]==""){
  
    // header('Location: '.$newURL);
      $sql = "SELECT * FROM admin";
      $rs_result=$dbconn->query($sql);
    }
    elseif (isset($_POST["searchAdmin"])) {
      $sql = "SELECT * FROM admin WHERE name LIKE '%".$_POST['searchAdmin'] ."%' OR section = '".$_POST['searchAdmin']."' OR username LIKE '". $_POST['searchAdmin']."%' ORDER BY name ASC" ;
      
      $rs_result=$dbconn->query($sql);
    }
    else{
      $sql = "SELECT * FROM admin";
      
      $rs_result=$dbconn->query($sql);
    }


  ?>

  <!-- Page Content -->
    <div id="content">
      <center><h1 style="font-family: 'Century Gothic';">ADMIN LIST</h1></center>
      <hr class="style15">

    <?php echo $errorResult ?>
    <form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <div class="form-group">
        <input id="myInput" type="text" title="Search Admin" name="searchAdmin" class="form-control" placeholder="Search Admin" size=100% autocomplete="off">
        <button type="submit" class="btn btn-primary btn-md">Search</button>
        <br><br>
      </div>
    </form>
    <table id="myTable" border="0" bgcolor = "white">
    <tr>
      <th style= "width: 50px;" bgcolor="#CCCCCC"><strong>ID</strong></th>
      <th style= "width: 200px;" bgcolor="#CCCCCC"><strong>NAME</strong></th>
      <th style= "width: 100px;" bgcolor="#CCCCCC"><strong>USER IMAGE</strong></th>
      <th style= "width: 200px;" bgcolor="#CCCCCC"><strong>POSITION</strong></th>
      <th style= "width: 120px;" bgcolor="#CCCCCC"><strong>SECTION</strong></th>
      <th style= "width: 100px;" bgcolor="#CCCCCC"><strong>USERNAME</strong></th>
       <th  bgcolor="#CCCCCC"><strong>ACTION</strong></th>
    </tr>
    <?php
      
    if (!$rs_result || $rs_result->num_rows<=0) {
        // echo "<script>console.log(".$user->email.")</script>";
        // trigger_error('Invalid query: ' . $dbconn->error);
        echo '</table><br><br><p>Student not found!</p>';
        // echo "<script>console.log('".trigger_error('Invalid query: ' . $dbconn->error)."');</script>";   
    }
    // if ($rs_result->num_rows >=0) {
    //   echo "<script>console.log('".$user->email."'')</script>";
    else{

      
     while($row = $rs_result->fetch_assoc()) {
    
      echo "<tr id='myTr'>
    <td>".$row["id"] ."</td>
    <td>".$row["name"] ."</td>
    <td><img src='images/admin/".$row['userImage']."' width='100px' style='padding:8px;'></td>
        <td>".$row["position"]."</td>
        <td>".$row["section"]."</td>
        <td>".$row["username"]."</td>
        <td><a class='btn btn-primary' href='AdminEditAdmin.php?edit_account=".$row["id"]."' title='Edit Account' style='width:80px; text-align:center;'>Edit</a>
            <a class='btn btn-danger' href='AdminSearchAdmin.php?delete=".$row["id"]."' title='Delete Account' style='width:80px; text-align:center;'>Delete</a>
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