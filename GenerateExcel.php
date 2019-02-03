<?php
require_once './includes/dbhandlerpdo.php';

//  GET THE DATA
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];


$newStartDate = date("F d, Y", strtotime($startDate));
$newEndDate = date("F d, Y", strtotime($endDate));


if($_GET['users']=='All'){
$users = $_GET['users'];
$stmt=$dbconnpdo->prepare("SELECT StudentNumber, Name, College,Course,Date FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%' ORDER BY Date ASC");
$stmt->execute();
$count = $dbconnpdo->query("SELECT count(*) FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%'")->fetchColumn(); 

}else{
$users = $_GET['users'];
$stmt=$dbconnpdo->prepare("SELECT StudentNumber, Name, College,Course,Date FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%' AND College = '$users' ORDER BY Date ASC");
$stmt->execute();
$count = $dbconnpdo->query("SELECT count(*) FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%' AND College = '$users' ")->fetchColumn(); 

}

 
 $hostname=$_SERVER['SERVER_NAME'];

// $columnHeader ='';
// $columnHeader = "Sr NO"."\t"."Product Code"."\t"."Product Description"."\t"."Unit of Measurement"."\t"."Price"."\t"."Main Quantity"."\t"."Retail Quantity"."\t"."Status"."\t"."Remarks";
// $txt = "This is a system generated report";
// $date = "Printed Date: ".date("F j, Y"); 
header('Content-type: application/excel');
$filename = 'AttendanceFor';
$filename.=$startDate.'to'.$endDate.$users.'.xls';
header('Content-Disposition: attachment; filename='.$filename);

$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#000000;}
.tg td{font-family:Calibri, sans-serif;font-size:13px;padding:8px;border-style:solid;border-width:thin;overflow:hidden;word-break:normal;border-color:#000000;color:#669;background-color:#e8edff;}
.tg th{font-family:Calibri, sans-serif;font-size:13px;font-weight:bold;padding:10px 5px;border-style:solid;border-width:thin;overflow:hidden;word-break:normal;border-color:#000000;color:#039;background-color:#b9c9fe;}
.tg .tg-x9jq{background-color:#4f81bd;color:#ffffff;border-color:#000000;text-align:center}
.tg .tg-xk5f{background-color:#b8cce4;color:#000000;border-color:#000000;text-align:center}
.tg .tg-gcw3{background-color:#dce6f1;color:#000000;border-color:#000000;text-align:center}
.tg .tg-gege{background-color:#FFFFFF;color:#000000;border-color:#000000;text-align:center}
img{
  width:100;
  height:100;
}
</style>
</head>

<body>
<table class="tg" style="undefined;table-layout: auto; width: 100%;">
<tr>
  <th colspan=5 class="tg-gege"><img src="http://'.$hostname.'/WebLibrarySystem/images/icons/logo_circle_small.png" alt="archives_logo" style="float:left;"   width=60px; height=60px;  ></img>Pamantasan ng Lungsod ng Maynila<br> 
  Celso Al Carunungan Library<br>Attendance Report<br>
  '.$newStartDate.' to '.$newEndDate.'
  <p style="text-align: right;">Total No. of Entry: '.$count.'</p></th>
</tr>

<colgroup>
<col style="width: 80px">
<col style="width: 220px">
<col style="width: 80px">
<col style="width: 80px">
<col style="width: 150px">
</colgroup>
  <tr>
    <th class="tg-x9jq">Student Number</th>
    <th class="tg-x9jq">Name</th>
    <th class="tg-x9jq">College</th>
    <th class="tg-x9jq">Course</th>
    <th class="tg-x9jq">Date</th>
    
  </tr>';

$class=0; 
while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
{
  if ($class==0){
     // $rowData = '';
    $data.='<tr>';
      foreach($rec as $value)
     {
       // $value = '"' . $value . '"' . "\t";
       // $rowData .= $value;
     
        $data.=' <td class="tg-xk5f">';
      $data.= $value;
      $data.='</td>';
     }
     // $setData .= trim($rowData)."\n";
     $class=1;
     
      $data.='</tr>';
      
  }
  else{
       // $rowData = '';
    
    $data.='<tr>';
    
      foreach($rec as $value)
     {
       // $value = '"' . $value . '"' . "\t";
       // $rowData .= $value;
    
         $data.='<td class="tg-gcw3">';
      $data.= $value;
      $data.='</td>';
       
     }
     // $setData .= trim($rowData)."\n";
     $class=0;
    
       $data.='</tr>';
       
  }

 
}
 
$data.='</body></table>';



// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=catalogue.xls");
// header("Pragma: no-cache");
// header("Expires: 0");
 
// ucwords($columnHeader)."\n".$setData."\n".$txt."\n".$date."\n";
 


echo $data;
?>
