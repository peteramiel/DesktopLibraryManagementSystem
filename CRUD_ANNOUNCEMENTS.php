<?php

session_start();


?>
<html>
<head>
<style>

#pagination {
    display: inline-block;
    cursor:pointer;
}

#pagination a {
    color: #888;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}

#pagination .active {
    color: #fff;
    font-family: 'Century Gothic'
}

.active{
    background-color: #459ea8;
    text-decoration: blink;
    color: #ddd;
    border-radius: 8px;
}

#pagination a:hover:not(.active) {
    background-color: #ddd;
    border-radius: 5px;
}

.container8{
  height: 30%;
    width: 500px; 
    margin: auto;
   display : table;
   padding: 10px 20px 10px;
}

.card{
  margin: 15px 5px;
  width: 800px; 
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  margin-left: 180px;
  }

.contentText{
  font-size: 18px;
  color: #1d2129;
  font-weight: normal;
  line-height: 1.38;
}

.dateTimeText{
  font-size: 14px;
  color: #616770;
  font-family: 'Verdana';
}
</style>
</head>
<?php
class Crud
{
 public $connect;
 private $host = "localhost";
 private $username = 'root';
 private $password = '';
 private $database = 'rblms';

 function __construct()
 {
  $this->database_connect();
 }

 public function database_connect()
 {
  $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
 }

 public function execute_query($query)
 {
  return mysqli_query($this->connect, $query);
 }

 public function get_data_in_table($query)
 {
  $output = '<section class="cards">';
  $result = $this->execute_query($query);

  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_object($result))
   {
     
     $output .= '
  
  <div style = "text-align:center;" class="card">
     
        <div "text-align:center;"  class = "container8">
        <br>
        
        <p class = "contentText""text-align:center;" ><b>'.$row->content.'</b></p>';

      if($row->attachment == ""){

      }else{
        $output.='<img src="images/announcements/'.$row->attachment.'" class="img-rounded" width="300px" height="200px" />';
      }
        
        $output.='<p class="dateTimeText" "text-align:center;" >'.$row->dateTime.'</p>';
        
        if($_SESSION["role"]=="admin"){
        $output.='
        <a align="right" class="btn btn-danger" href="?delete_id='.$row->id.'" title="Click for Delete" onclick="return confirm("Do you really want to delete the item:'.$row->id.'?")"> Delete</a>'; 
        }
        $output.='
        </div>

      </div>

      ';
   }
  }
  else
  {
   $output .= '
   <br><br><br><br>
     <p style="text-align:center; width:100%; ">No Announcement Found!</p>
   
   ';
  }
  $output .= '</section>';
  echo $output;
 } 

 function make_pagination_link($query, $record_per_page)
 {
  $output = '';
  $result = $this->execute_query($query);
  
  $total_records = mysqli_num_rows($result);
  $total_pages = ceil($total_records/$record_per_page);
  echo '<script>';
  echo 'total_pages = ' . json_encode($total_pages) . ';';
  echo '</script>';
  ?>
  <div id="pagination">
  <?php
  $output .= '<a span class="pagination_link" id="first">&laquo;</a>';
  $output .= '<a span class="pagination_link" id="prev">&lsaquo;</a>';
   
  for($i=1; $i<=$total_pages; $i++)
  {
  
    $output .= '<a span class="pagination_link" id="'.$i.'">'.$i.'</a>';
   // $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'">'.$i.'</span>';
  }
  $output .= '<a span class="pagination_link" id="next">&rsaquo;</a>';
  $output .= '<a span class="pagination_link" id="last">&raquo;</a>';
  return $output;
 }
}
?>

</div>
</html>




<!--  <ul class="pagination pagination">
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
  </ul> -->