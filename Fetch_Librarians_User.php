<?php
include 'CRUD_LIBRARIANS1.php';
$object = new Crud();
if(isset($_POST["action"])){

 if($_POST["action"] == "Load"){
 

  echo $object->get_data_in_table("SELECT * FROM librarians ORDER BY name ASC");
  
 }
 
 if($_POST["action"] == "Search")
 {
  $search = mysqli_real_escape_string($object->connect, $_POST["query"]);
  $query = "
  SELECT * FROM librarians 
  WHERE name LIKE '%".$search."%'
  OR section LIKE '%".$search."%'
  ORDER BY name DESC
  ";
  //echo $query;
  echo $object->get_data_in_table($query);  
 }
 
}
?>