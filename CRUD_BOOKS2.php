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
  
   display : table;
}

.imagetext{
  display: inline-block;
}

.card{
    display: inline-block;
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
  $output = '<section class="cards" style="width:80%;">';
  $result = $this->execute_query($query);

  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_object($result))
   {
     
     $output .= '
  
  <div class="card" style="width:500px; height:200px; padding-left: 30px;">
     
     
       
        <br>
        <img src="images/books/'.$row->uniqueId.'" style="float:left"  width="100px" height="150px" />
        <div class="imagetext">
        
       <p style="color: #000;"><b>'.$row->bookTitle.'</b><br>by<b> '.$row->bookAuthor.'</b><br> Call Number: '.$row->callNumber.'<br>Publish Date: '.$row->publishDate.'</p>
        <input class="btn btn-outline-primary add_book_modal" id="hello" data-dismiss="modal" type="button" onclick=myFunction("'.$row->callNumber.'","'.$row->uniqueId.'") value="Add Book">
       
      

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
   <br><br><br><br>
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

<script type="text/javascript">
  function myFunction(callNumber,uniqueId) {
  var searchTextbox = document.getElementById('search');
  searchTextbox.value= "";
  var div = document.getElementById('sectionBookCart');
div.insertAdjacentHTML('afterend', '<img src="images/books/'+uniqueId+'" id="img" width="70" height="100" alt="Test Image" title="'+callNumber+'" />');
  var div2 = document.getElementById('bookCartTitle');
  div2.insertAdjacentHTML('afterend','<div style="overflow: hidden; width:100%"><input class="form-control" type="text" name="inputs[]" style="display: inline;width:80%" id="callNumberP" value='+callNumber+' readonly><button type="button" id="closeImage" class="close" style="display: inline-block; position: relative; margin-left: 10px !important;" onclick="picDismiss()">&times;</button></div>')
// var content = document.createTextNode('<img src="images/books/'+uniqueId+'" id="img" width="200" height="200" alt="Test Image" title="'+callNumber+'" /><button type="button" id="closeImage" class="close" style="position: absolute; top: 0; right: 5px;" onclick="picDismiss()">&times;</button>');
// div.appendChild(content);
  // div.innerHTML += '<img src="images/books/'+uniqueId+'" id="img" width="200" height="200" alt="Test Image" title="'+callNumber+'" /><button type="button" id="closeImage" class="close" style="position: absolute; top: 0; right: 5px;" onclick="picDismiss()">&times;</button>';
 // div.innerHTML += callNumber;
}

</script>


</html>




<!--  <ul class="pagination pagination">
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
  </ul> -->