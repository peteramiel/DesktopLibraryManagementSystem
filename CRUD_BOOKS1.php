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
    
}

.active{
    background-color: #459ea8;
    text-decoration: blink;
    color: #ddd;
    border-radius: 5px;
    font-family: 'Century Gothic';
}

#pagination a:hover:not(.active) {
    background-color: #ddd;
    border-radius: 5px;
}

.container4{
  height: 50%;
   display : table;
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
  $output = '<section class="cards" style="margin: 0 auto;">';
  $result = $this->execute_query($query);

  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_object($result))
   {
     
     $output .= '
  
  <div class="card">
      <div class="container">
      <div class="col-xs-3">
        <div class = "container4">
        <br>
        <p style="color: #000; class = "capitalize"><b>'.$row->bookTitle.'</b></p>
        <p style="color: #000;" class="capitalize"><b>by </b>'.$row->bookAuthor.'</p>
        <div class="imagetext">
        <img src="images/books/'.$row->uniqueId.'" class="img-rounded" width="75px" height="75px" />
        <p class="page-header">
        <span>';
        //FOR ADMIN EDIT AND DELETE
        if($_SESSION['role']=="admin" ){
            
              $output.=' <a class="btn btn-info" href="AdminEditBook.php?edit_id='.$row->callNumber.'" title="Click to Edit" > Edit</a>';
        
        $output .='<a class="btn btn-danger" href="?delete_id='.$row->callNumber.'" title="Click for Delete" onclick="return confirm("Do you really want to delete the item:'.$row->callNumber.'?")"> Delete</a>';
      }
        $output .=' 
          </span>
        </div>
        </div>
        </p>
      </div>  
      <span class="tooltiptext">'.$row->bookTitle.' by '.$row->bookAuthor.'<br> Call Number: '.$row->callNumber.'<br>Publish Date: '.$row->publishDate.'</span>

      </div>

      </div>

      ';
   }
  }
  else
  {
   $output .= '
   <br><br><br><br>
     <p style="text-align:center; width:100%; ">No Book Found!</p>
   
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