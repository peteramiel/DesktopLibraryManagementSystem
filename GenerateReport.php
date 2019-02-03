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
  #preview {
  box-shadow: 0 2px 4px 1px rgba(0,0,0,0.2);
  width: 35%;
  
  /*z-index: 0;*/
  text-align: center;
 
  padding: 10px 20px 10px;
  background-color:white;
  transition:.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 4px 8px 4px rgba(0,0,0,0.2);
  transform: scale(1.02);
}

#chartContainer{
  width: 500px;
  padding: 10px auto 10px;
  height: 300px;
}

#pieGraphContainer{
  width: 500px;
  padding: 10px auto 10px;
  height: 300px;
}

#monthlyChartContainer{
  width: 500px;
  padding: 10px auto 10px;
  height: 400px;
}

#monthlyPieGraphContainer{
  width: 500px;
  padding: 10px auto 10px;
  height: 400px;
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
 <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


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

    <h1 style="text-align: center;" "font-family: Poppins">Generate Report</h1>



    <div class="card" id="weekSummary" style="float: right; width:40%; margin: 0px 30px 0px auto; padding:10px;">
    <!-- <div id="format_buttons" style="margin:20px 10 20px auto; " class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-primary active">
    <input type="radio" name="select_summary_interval" data-id="weekSummary" value="week" autocomplete="off" onclick="show1();" checked> Weekly
    </label>
    <label class="btn btn-primary">
    <input type="radio" name="select_summary_interval" data-id="monthSummary" value="month" onclick="show2();" autocomplete="off"> Monthly
    </label>
    </div> -->
    <div id="format_buttons" style="margin:20px 10 20px auto; " class="btn-group btn-group-toggle" >
    <label id="weeklyRadioButton" class="btn btn-primary">
    <input type="radio" name="select_summary_interval" data-id="weekSummary" value="week" autocomplete="off" onclick="show1();" checked> Weekly
    </label>
    <label id="monthlyRadioButton" class="btn btn-primary">
    <input type="radio" name="select_summary_interval" data-id="monthSummary" value="month" onclick="show2();" autocomplete="off"> Monthly
    </label>
    </div>
   <!--  <input type="radio" name="tab" value="igotnone" onclick="show1();" />
    Weekly
    <input type="radio" name="tab" value="igottwo" onclick="show2();" />Monthly
 -->


    <div id= "week">
    <div id="chartContainer"></div>
    <div id="pieGraphContainer"></div>
    </div>
    <div id= "month" style="display: none;">
    <div id="monthlyChartContainer"></div>
    <div id="monthlyPieGraphContainer"></div>
    </div>
    </div>

    
 <!-- Page Content -->
   

    <div id="content">
    <form method="POST" style="margin: 0 200px 0 200px"  enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <label for="format_buttons"><h4>Select Format</h4></label>
    <div id="format_buttons" style="margin-left: 20px;" class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-secondary active">
    <input type="radio" name="select_format" value="pdf" autocomplete="off" checked><i class="fa fa-file-pdf-o" style="font-size:22px;color:#d8496b"></i> PDF
    </label>
    <label class="btn btn-secondary">
    <input type="radio" name="select_format" value="excel" autocomplete="off"><i class="fa fa-file-excel-o" style="font-size:22px; color:#32CD32"></i> Excel
    </label>
    </div>

    <br>
    <br>
    
    <label for="select_date_spinner"><h3>Select Date:</h3></label>
    <select id="select_date_spinner" name="default_select_date">
    <option class="dropdown-item" value="day" selected="selected">This Day</option>
    <option class="dropdown-item" value="week">This Week</option>
    <option class="dropdown-item" value="month">This Month</option>
    <option class="dropdown-item" value="custom" >Custom</option>
    </select>
    
    <div id="custom_settings_div" class="settings">
    <h4>Custom Settings</h4>
    <table>
    <tr><td>
    <label for="custom_start_date">Start Date:</label>
    </td><td>
    <input type="date" name="custom_start_date">
    </td></tr>
    <tr><td>
    <label for="custom_end_date">End Date:</label>
    </td><td>
    <input type="date" name="custom_end_date">
    </td></tr>
    </table>
    </div>

    <label for="other">User:</label>
    
    <select id="select_user" name="select_user">
    <option class="dropdown-item" value="All" selected="selected">All</option>
    <option class="dropdown-item" value="CET">CET</option>
    <option class="dropdown-item" value="CBGM">CBGM</option>
    <option class="dropdown-item" value="CA">CA</option>
    <option class="dropdown-item" value="CS">CS</option>
    <option class="dropdown-item" value="CAUP">CAUP</option>
    <option class="dropdown-item" value="CA">CA</option>
    <option class="dropdown-item" value="CN">CN</option>
    <option class="dropdown-item" value="CPT">CPT</option>
    <option class="dropdown-item" value="CL">CL</option>
    </select>
   
    

    <br><br>
 
    <button class="btn btn-success btn-lg active" type="submit" name="generate_button"> Generate</button>
    <button class="btn btn-info btn-lg" type="submit" name="preview_button">Overview</button>
   
    </form>


<?php
if(isset($_POST['preview_button'])){
  $output ="";
  $output .= '<div class="card" id="preview" style="margin: 20px 200px 0 200px">
      <h2>Overview</h2>';

            //THIS IS FOR DAY SETTINGS
      if($_POST['default_select_date']=='day'){
      $dateToday = date("Y-m-d");
      $user = $_POST['select_user'];
      if($user =='All'){
        $sql = "SELECT count(*) FROM `list` WHERE Date LIKE '$dateToday%'"; 
      }else{
        $sql = "SELECT count(*) FROM `list` WHERE Date LIKE '$dateToday%' AND College = '$user'"; 
      }
      $result = $dbconnpdo->prepare($sql); 
      $result->execute(); 
      $number_of_rows = $result->fetchColumn(); 
      $output.='<p>Attendance for the Day of '.$dateToday.'</p>
      <p>Number of Entry for Today: '.$number_of_rows.'</p>';
      }

          //THIS ISFOR WEEK SETTINGS
      if($_POST['default_select_date']=='week'){
      $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
      $saturday = date( 'Y-m-d', strtotime( 'saturday this week' ) );
      $user = $_POST['select_user'];
      if($user =='All'){
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$monday' AND Date <= '$saturday' OR Date LIKE '$monday%' OR DATE LIKE '$saturday%' ORDER BY Date DESC"; 
      }else{
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$monday' AND Date <= '$saturday' OR Date LIKE '$monday%' OR DATE LIKE '$saturday%' ORDER BY Date DESC AND College = '$user'"; 
      }
      $result = $dbconnpdo->prepare($sql); 
      $result->execute(); 
      $number_of_rows = $result->fetchColumn(); 
      $output.='<p>Attendance for the Week of '.$monday.' to '.$saturday.'</p>
      <p>Number of Entry for this Week: '.$number_of_rows.'</p>';
      }
    

      //THIS ISFOR MONTH SETTINGS
      if($_POST['default_select_date']=='month'){
      $first = date("Y-m-d", strtotime("first day of this month"));
      $last = date("Y-m-d", strtotime("last day of this month"));
      $user = $_POST['select_user'];
      if($user =='All'){
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$first' AND Date <= '$last' OR Date LIKE '$last%' OR DATE LIKE '$first%' ORDER BY Date DESC"; 
      }else{
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$first' and Date <= '$last' OR Date LIKE '$last%' OR DATE LIKE '$first%' AND College = '$user' ORDER BY Date DESC"; 
      }
      $result = $dbconnpdo->prepare($sql); 
      $result->execute(); 
      $number_of_rows = $result->fetchColumn(); 
      $output.='<p>Attendance for the Month of '.$first.' to '.$last.'</p>
      <p>Number of Entry for this Month: '.$number_of_rows.'</p>';
      }

      //THIS ISFOR CUSTOM SETTINGS
      if($_POST['default_select_date']=='custom'){
        try{
          $first = $_POST['custom_start_date'];
          $last = $_POST['custom_end_date'];
     
      $user = $_POST['select_user'];
      if($user =='All'){
        // $sql = "SELECT count(*) FROM `list` WHERE Date >= '$first' AND Date <= '$last'"; 
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$first' and Date <= '$last' OR Date LIKE '$last%' OR DATE LIKE '$first%' ORDER BY Date DESC"; 
      }else{
        $sql = "SELECT count(*) FROM `list` WHERE Date >= '$first' and Date <= '$last' OR Date LIKE '$last%' OR DATE LIKE '$first%' AND College LIKE '$user' ORDER BY Date DESC"; 
      }
      $result = $dbconnpdo->prepare($sql); 
      $result->execute(); 
      $number_of_rows = $result->fetchColumn(); 
      $output.='<p>Attendance for the Month of '.$first.' to '.$last.'</p>
      <p>Number of Entry for this Month: '.$number_of_rows.'</p>';
        }catch(PDOException $e){
          echo"<div id='myAlert' style='margin-left:250px;' class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Invalid Input!</strong><br></div>";
        }
     
      }
  $output.='</div>';
  echo $output;
}else if(isset($_POST['generate_button'])){
 
    if($_POST['select_format']=='pdf'){
      $selectDate = $_POST['default_select_date'];
      $users = $_POST['select_user'];
      if($selectDate == 'day'){
        $startDate = date("Y-m-d");
        $endDate = date("Y-m-d");
      }else if($selectDate == 'week'){
      $startDate = date( 'Y-m-d', strtotime( 'monday this week' ) );
      $endDate = date( 'Y-m-d', strtotime( 'saturday this week' ) );
      }else if($selectDate== 'month'){
      $startDate = date("Y-m-d", strtotime("first day of this month"));
      $endDate = date("Y-m-d", strtotime("last day of this month"));
      }else if($selectDate=='custom'){
        $startDate = $_POST['custom_start_date'];
        $endDate = $_POST['custom_end_date'];
      }
        header("Location: GeneratePDF.php?startDate=$startDate&endDate=$endDate&users=$users" ); 
      }
      
      
      
      
    else if($_POST['select_format']=='excel'){
         $selectDate = $_POST['default_select_date'];
      $users = $_POST['select_user'];
      if($selectDate == 'day'){
        $startDate = date("Y-m-d");
        $endDate = date("Y-m-d");
      }else if($selectDate == 'week'){
      $startDate = date( 'Y-m-d', strtotime( 'monday this week' ) );
      $endDate = date( 'Y-m-d', strtotime( 'saturday this week' ) );
      }else if($selectDate== 'month'){
      $startDate = date("Y-m-d", strtotime("first day of this month"));
      $endDate = date("Y-m-d", strtotime("last day of this month"));
      }else if($selectDate=='custom'){
        $startDate = $_POST['custom_start_date'];
        $endDate = $_POST['custom_end_date'];
      }
        header("Location: GenerateExcel.php?startDate=$startDate&endDate=$endDate&users=$users" ); 
    }
}


?>


    </div>
<?php
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'rblms');
 
 //connecting to database and getting the connection object
 $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }

  $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
  $saturday = date( 'Y-m-d', strtotime( 'saturday this week' ) );
  
  $stmt = $dbconn ->prepare("SELECT College, count(*) as Count FROM list WHERE Date >= '$monday' AND Date <= '$saturday' OR Date LIKE '$monday%' OR DATE LIKE '$saturday%' GROUP BY College");

  $stmt->execute();


 $stmt->bind_result($college, $count);
 
 $newattendance = array(); 

/* //traversing through all the result 
 while($stmt->fetch()){
 $i+=$Count;
 }*/

 while($stmt->fetch()){
 $temp = array();
 $temp['college'] = $college; 
 $temp['y'] = $count;   

 array_push($newattendance, $temp);
 }


?>



<script type="text/javascript">


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      var myObj = JSON.parse(this.responseText);
    
    
       var chart = new CanvasJS.Chart("chartContainer", {
    title:{
      text: "Attendance"              
    },
    data: [              
    {

      
      // Change type to "doughnut", "line", "splineArea", etc.
      type: "column",
      dataPoints: [
        { label: myObj[0].x,  y: myObj[0].y  },
        { label: myObj[1].x, y: myObj[1].y  },
        { label: myObj[2].x, y: myObj[2].y  },
        { label: myObj[3].x,  y: myObj[3].y  },
        { label: myObj[4].x,  y: myObj[4].y  },
        { label: myObj[5].x,  y: myObj[5].y  }
      ]
    }
    ]
  });
  chart.render();
  }
  };
  xmlhttp.open("GET", "test.php", true);
  xmlhttp.send();
</script>

<script type="text/javascript">
  
      var chart = new CanvasJS.Chart("pieGraphContainer", {
        animationEnabled: true,
        title: {
          text: "Usage of Library by College"
        },
        subtitles: [{
          text: "This Week"
        }],
        data: [{
          type: "pie",
        
          indexLabel: "{college} ({y})",
          dataPoints: <?php echo json_encode($newattendance, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
  
</script>

<?php 
include_once 'monthlyAttendance.php';
include_once 'attendanceByCollege.php';

$currentMonth = Date('F');
?>

<script type="text/javascript">
  
      var monthlyPie = new CanvasJS.Chart("monthlyPieGraphContainer", {
        animationEnabled: true,
        title: {
          text: "Usage of Library by College"
        },
        subtitles: [{
          text: "This Month"
        }],
        data: [{
          type: "pie",
        
          indexLabel: "{college} ({y})",
          dataPoints: <?php echo json_encode($attendanceMonthlyPie, JSON_NUMERIC_CHECK); ?>
        }]
      });
      monthlyPie.render();
  
</script>
<script>
window.onload = function () {
 
var monthLineGraph = new CanvasJS.Chart("monthlyChartContainer", {
  animationEnabled: true,
  title:{
    text: <?php echo "'Attendance for $currentMonth'"; ?>
  },
  axisY: {
    title: "No. of Users",
    
  },
  data: [{
    type: "spline",
    markerSize: 5,
    xValueFormatString: "MM/DD",
    
    xValueType: "dateTime",
    dataPoints: <?php echo json_encode($monthlyAttendance, JSON_NUMERIC_CHECK); ?>
  }]
});
 
monthLineGraph.render();
 
}
</script>
<script>  
function show1(){
  // document.getElementById('chartContainer').style.display ='none';
  // document.getElementById('pieGraphContainer').style.display ='none';
  document.getElementById('week').style.display ='block';
  document.getElementById('month').style.display ='none';
  document.getElementById('weeklyRadioButton').addClass('active');
  document.getElementById('monthlyRadioButton').removeClass('active');
}
function show2(){
  document.getElementById('week').style.display ='none';
  document.getElementById('month').style.display ='block';
  document.getElementById('weeklyRadioButton').removeClass('active');
  document.getElementById('monthlyRadioButton').addClass('active');
  // document.getElementById('pieGraphContainer').style.display ='none';
  // document.getElementById('month').style.display = 'block';
}
$(document).ready(function(){
    $("#custom_settings_div").hide();
    $('#select_date_spinner').on('change', function() {
      if ( this.value == 'custom')
      {
        $("#custom_settings_div").show();
      }
      else
      {
        $("#custom_settings_div").hide();
      }
    });

   



});
</script>


< <!-- JS dependencies -->
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

<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


</body>
</html>