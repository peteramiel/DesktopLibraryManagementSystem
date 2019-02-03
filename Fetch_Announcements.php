<?php
include 'CRUD_ANNOUNCEMENTS.php';
$object = new Crud();
if(isset($_POST["action"])){

 if($_POST["action"] == "Load"){
  $record_per_page = 10;
  $page = '';

  if(isset($_POST["page"])){
   $page = $_POST["page"];
  }
  else{
   $page = 1;
  }

  $start_from = ($page - 1) * $record_per_page;

  echo $object->get_data_in_table("SELECT * FROM announcements ORDER BY id DESC LIMIT $start_from, $record_per_page");
  echo '<br /><div align="center">';
  echo $object->make_pagination_link("SELECT * FROM announcements ORDER by id DESC", $record_per_page);
  echo '</div><br />';
 }
 
 if($_POST["action"] == "Search")
 {
  $search = mysqli_real_escape_string($object->connect, $_POST["query"]);
  $query = "
  SELECT * FROM announcements 
  WHERE content LIKE '%".$search."%'
  OR dateTime LIKE '%".$search."%'
  ORDER BY id DESC
  ";
  //echo $query;
  echo $object->get_data_in_table($query);  
 }
 
}
?>