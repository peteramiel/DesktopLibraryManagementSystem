<?php
include 'CRUD_BOOKS1.php';
$object = new Crud();
if(isset($_POST["action"])){

 if($_POST["action"] == "Load"){
  $record_per_page = 20;
  $page = '';

  if(isset($_POST["page"])){
   $page = $_POST["page"];
  }
  else{
   $page = 1;
  }

  $start_from = ($page - 1) * $record_per_page;

  echo $object->get_data_in_table("SELECT * FROM books ORDER BY bookTitle ASC LIMIT $start_from, $record_per_page");
  echo '<br /><div align="center">';
  echo $object->make_pagination_link("SELECT * FROM books ORDER by bookTitle ASC", $record_per_page);
  echo '</div><br />';
 }
 
 if($_POST["action"] == "Search")
 {
  $search = mysqli_real_escape_string($object->connect, $_POST["query"]);
  $query = "
  SELECT * FROM books 
  WHERE bookTitle LIKE '%".$search."%'
  OR bookAuthor LIKE '%".$search."%'
  ORDER BY bookTitle DESC
  ";
  //echo $query;
  echo $object->get_data_in_table($query);  
 }
 
}
?>