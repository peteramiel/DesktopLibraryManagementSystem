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
  <title>Admin - Recent Activities</title>
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
     document.getElementById("studentVerificationLi").classList.remove('active');
     document.getElementById("librariansLi").classList.add('active');
     document.getElementById("editSearchPageLi").classList.remove('active');
  </script>
  <?php
    require_once './includes/dbhandlerpdo.php';
  // if (isset($_GET["edit_account"])){
  //   // TODO: EDIT ACCOUNT
  // }

  // if (isset($_GET["delete"])){
  //   try {
  //      // $stmt_select = $dbconn->prepare('SELECT userImage from librarians WHERE id =:item_no');
  //   // $stmt_select->execute(array(':item_no'=>$_GET['delete']));
  //   $stmt_select = $dbconnpdo->prepare('SELECT userImage from librarians WHERE id =:item_no');
  //   $stmt_select->execute(array(':item_no'=>$_GET['delete']));
  //   $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
  //   unlink("images/librarians/".$imgRow['userImage']);

  //   //RECENT ACTIVITY
  //   date_default_timezone_set("Asia/Hong_Kong");
  // $dateTime = date('l g:i A F j, Y');
  // $add_activity_sql = "INSERT INTO recent_activity (userName,item_code,role,action,dateTime,item_detail) VALUES ('".$_SESSION["username"]."','$userName','admin','Add Librarian','$dateTime','$name in $section');";

  //   // it will delete an actual record from db
  //   $stmt_delete = $dbconnpdo->prepare('DELETE FROM librarians WHERE id =:item_no');
  //   $stmt_delete->bindParam(':item_no',$_GET['delete']);
  //   $stmt_delete->execute();
  //   }

  //   //catch exception
  //   catch(Exception $e) {
  //     echo"<div id='myAlert' class='alert alert-alert'>
  //         <a href='#' class='close' data-dismiss='alert'>&times;</a>
  //         <strong>Cant Delete User Please Try </strong><br>
  //     </div>";
  //   }
   
    
    
  // }


  ?>


  <?php
    include_once './includes/dbhandler.php';
    if (isset($_POST["searchActivity"]) && $_POST["searchActivity"]==""){
  
    // header('Location: '.$newURL);
      $sql = "SELECT * FROM recent_activity";
      $rs_result=$dbconn->query($sql);
    }
    elseif (isset($_POST["searchActivity"])) {
      $search = $_POST['searchActivity'];


      $sql = "SELECT * FROM recent_activity WHERE action LIKE '%$search%' OR userName LIKE '$search%' OR dateTime LIKE '$search%' OR item_code LIKE '%$search%' ORDER BY action_id DESC" ;
      
      $rs_result=$dbconn->query($sql);
    }
    else{
      $sql = "SELECT * FROM recent_activity";
      
      $rs_result=$dbconn->query($sql);
    }


  ?>

  <!-- Page Content -->
    <div id="content">
      <center><h1 style="font-family: 'Century Gothic';">RECENT ACTIVITY</h1></center>
      <hr class="style15">
   
    <form class="form-inline" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <div class="form-group">
        <input id="myInput" type="Search" name="searchActivity" class="form-control" onkeyup="myFunction()" placeholder="Search for Activity (Action, Username or Datetime)"
        size=80 autocomplete="off">
        <button type="submit" class="btn btn-primary btn-md">Search</button>
        <br><br>
      </div>
    </form>
    <table id="myTable" border="0" bgcolor = "white">
    <tr>
      <th bgcolor="#CCCCCC"><strong>ID</strong></th>
      <th bgcolor="#CCCCCC"><strong>ACTION</strong></th>
      <th bgcolor="#CCCCCC"><strong>ITEM CODE</strong></th>
      <th bgcolor="#CCCCCC"><strong>ITEM DETAIL</strong></th>
      <th bgcolor="#CCCCCC"><strong>USERNAME</strong></th>
      <th bgcolor="#CCCCCC"><strong>ROLE</strong></th>
      <th bgcolor="#CCCCCC"><strong>DATETIME</strong></th>
    </tr>
    <?php
      
    if (!$rs_result || $rs_result->num_rows<=0) {
        // echo "<script>console.log(".$user->email.")</script>";
        // trigger_error('Invalid query: ' . $dbconn->error);
        echo '</table><br><br><p>Activity not found!</p>';
        // echo "<script>console.log('".trigger_error('Invalid query: ' . $dbconn->error)."');</script>";   
    }
    // if ($rs_result->num_rows >=0) {
    //   echo "<script>console.log('".$user->email."'')</script>";
    else{

      
     while($row = $rs_result->fetch_assoc()) {
    
      echo "<tr id='myTr'>
    <td>".$row["action_id"] ."</td>
    <td>".$row["action"] ."</td>
     <td>".$row["item_code"] ."</td>
        <td>".$row["item_detail"]."</td>
        <td>".$row["userName"]."</td>
        <td>".$row["role"]."</td>
          <td>".$row["dateTime"] ."</td>
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