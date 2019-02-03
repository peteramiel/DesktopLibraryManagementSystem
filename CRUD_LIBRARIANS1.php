<?php

session_start();


?>
<html>
<head>

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
  $output = '';
  $result = $this->execute_query($query);

  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_object($result))
   {
     $random_number= rand(1,6);

    switch($random_number){
        case 1:
          $div_class = "overlay  overlayLeft";
          break;

        case 2:
          $div_class = "overlay overlayRight";
          break;

        case 3:
          $div_class = "overlay overlayFade";
          break;

        case 4:
          $div_class = "overlay overlayTop";
          break;

        case 5:
          $div_class = "overlay overlayBottom";
          break;

        case 6:
          $div_class = "overlay overlayCross";
          break;
        

    }
     $output .= '
  
        <div class="container">
            <img src="images/librarians/'.$row->userImage.'" alt="Avatar" class="image">
            <div class="'.$div_class.'">
                <div class="text" style="font-size: 10px">'.$row->name.'<br>'.$row->position.'<br>'.$row->section.'</div>
            </div>
        </div>

      ';
   }
  }
  else
  {
   $output .= '
   <br><br><br><br>
     <p style="text-align:center; width:100%; ">No Librarian Found!</p>
   
   ';
  }
 
  echo $output;
 } 

 // function make_pagination_link($query, $record_per_page)
 // {
 //  $output = '';
 //  $result = $this->execute_query($query);
  
 //  $total_records = mysqli_num_rows($result);
 //  $total_pages = ceil($total_records/$record_per_page);
 //  echo '<script>';
 //  echo 'total_pages = ' . json_encode($total_pages) . ';';
 //  echo '</script>';
 //  
 //  <div id="pagination">
 //  <?php
 //  $output .= '<a span class="pagination_link" id="first">&laquo;</a>';
 //  $output .= '<a span class="pagination_link" id="prev">&lsaquo;</a>';
   
 //  for($i=1; $i<=$total_pages; $i++)
 //  {
  
 //    $output .= '<a span class="pagination_link" id="'.$i.'">'.$i.'</a>';
 //   // $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'">'.$i.'</span>';
 //  }
 //  $output .= '<a span class="pagination_link" id="next">&rsaquo;</a>';
 //  $output .= '<a span class="pagination_link" id="last">&raquo;</a>';
 //  return $output;
 // }
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