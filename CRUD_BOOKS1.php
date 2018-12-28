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
   
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}

.active{
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
}

#pagination a:hover:not(.active) {
    background-color: #ddd;
    border-radius: 5px;
}
.container{
  height: 100%;
}
.container4{
  height: 100%;
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
  $output = '<section class="cards">';
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
        <p class = "capitalize"><b>'.$row->bookTitle.'</b></p>
        <p class="capitalize"><b>by </b>'.$row->bookAuthor.'</p>
        <div class="imagetext">
        <img src="images/books/'.$row->uniqueId.'" class="img-rounded" width="75px" height="75px" />
        <p class="page-header">
        <span>';
        //FOR ADMIN EDIT AND DELETE
        if(isset($_SESSION['fullName']) && array_key_exists('fullName',$_SESSION) && !empty($_SESSION['fullName'])){
             $output.= ' <a class="btn btn-info" href="EditItem_Admin.php?edit_id= '.$row->bookTitle.'" title="click for edit" > Edit</a>';  }
        // FOR USER EDIT 
        else if(isset($_SESSION['username']) && array_key_exists('username',$_SESSION) && !empty($_SESSION['username'])){
              $output.=' <a class="btn btn-info" href="editbook.php?edit_id= '.$row->callNumber.'" title="Click to Edit" > Edit</a>';
        }
        $output .='<a class="btn btn-danger" href="?delete_id='.$row->callNumber.'" title="Click for Delete" onclick="return confirm("Do you really want to delete the item:'.$row->callNumber.'?")"> Delete</a> 
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
  
   <br><br>
    <tr>
     <td colspan="5" align="center">No Data Found</td>
    </tr>
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