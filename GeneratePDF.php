<?php
require('fpdf.php');
$d=date('d_m_Y');

class PDF extends FPDF
{

function Header()
{
    $this->SetFont('Helvetica','',25);
	$this->SetFontSize(40);
    //Move to the right
    $this->Cell(80);
    //Line break
    $this->Ln();
}



//Page footer
function Footer()
{
	$this->SetMargins(10, 10, 10);
	$this->SetY(-20);
    $this->SetFont('Helvetica','I',7);
	$this->SetFontSize(7);
	$this->Write(3, 'This is a computer-generated document and it does not require signature.');
	$this->Ln();
    $this->Ln();
    $this->SetFont('Helvetica','B',7);
	$this->SetFontSize(7);
	$this->Write(3, 'Date Generated: ');
	$tdate = date('F j, Y');
	$this->Write(3,$tdate);
	$this->SetMargins(10, 10, 10);
}

//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

//Simple table
function BasicTable($header,$data)
{ 

 //$this->SetDrawColor(255, 0, 0);
// $w=array(30,80,15,15,20,20);
	$this->SetFillColor(79,129,189);
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.1);
	
	//Header

	$this->SetFont('Arial','B',9);
		$this->Cell(28,10,'Student Number',1,0,'C',true);
		$this->Cell(78,10,'Name',1,0,'C',true);
		$this->Cell(17,10,'College',1,0,'C',true);
		$this->Cell(20,10,'Course',1,0,'C',true);
		$this->Cell(40,10,'Date',1,0,'C',true);
		$this->Ln();
//	for($i=0;$i<count($header);$i++)
//		$this->Cell($w[$i],7,$header[$i],1,0,'L',true);
	// $this->Ln();
	
	//Data
	$this->SetFillColor(184,204,228);
    $this->SetTextColor(0);
    $fill=false;
	$this->SetFont('Arial','',8);
	foreach ($data as $eachResult) 
	{ //width
		// $this->Cell(10);
		$this->Cell(28,6,$eachResult["StudentNumber"],1,0,'C',$fill);
		$this->Cell(78,6,$eachResult["Name"],1,0,'L',$fill);
		$this->Cell(17,6,$eachResult["College"],1,0,'C',$fill);
		$this->Cell(20,6,$eachResult["Course"],1,0,'C',$fill);
		$this->Cell(40,6,$eachResult["Date"],1,0,'C',$fill);
		$this->Ln();
		$fill=!$fill; 	 	 	 	
	}
}

//Better table
}

$pdf=new PDF();

$header=array('StudentNumber','Name','College','Course','Date');
//Data loading
//*** Load MySQL Data ***//

include_once './includes/dbhandler.php';
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

$newStartDate = date("F d, Y", strtotime($startDate));
$newEndDate = date("F d, Y", strtotime($endDate));
if($_GET['users']=='All'){
	  $strSQL = "SELECT * FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%' ORDER BY Date ASC"; 
}else{
	$users = $_GET['users'];
	$strSQL = "SELECT * FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' OR Date LIKE '$startDate%' OR DATE LIKE '$endDate%' AND College = '$users' ORDER BY Date ASC"; 

}

// $strSQL = "SELECT * FROM list";
$objQuery = $dbconn->query($strSQL);
$resultData = array();
for ($i=0;$i<mysqli_num_rows($objQuery);$i++) {
	$result = mysqli_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//


//*** Table 1 ***//
$pdf->AddPage();

	$pdf->SetFont('Times','',8);
	$pdf->Cell(25);
	$pdf->Image('images/icons/logo_circle.jpg',10,5,20,20,'JPG');
	$pdf->Write(3, 'Pamantasan ng Lungsod ng Maynila');
	$pdf->Ln();
	$pdf->Cell(25);
	$pdf->Write(3, 'Celso Al Carunungan Library');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Times','',14);
	$pdf->Cell(0, 14, "Attendance Report", 0, 0, 'C');
	
	$pdf->Ln();
	


	$pdf->SetFont('Times','',10);
	$pdf->Cell(0, 0, $newStartDate.' to '.$newEndDate, 0, 0, 'C');
	
	$pdf->Ln();
	
	// $pdf->Cell(22);
	// $pdf->SetFontSize(8);
	// $pdf->Cell(57);
	// $result=$dbconn->query("select date_format(now(), '%W, %M %d, %Y') as date");
	// $pdf->Write(5, 'As of ');
	// while( $row=mysqli_fetch_array($result) )
	// {
	// 	$pdf->Write(5,$row['date']);
	// }
	// $pdf->Ln();
	
	//count total numbers of visitors
	// $str = "SELECT * FROM `list` WHERE Date >= '$startDate' and Date <= '$endDate' AND College = '$users'"; 
	
	$count = mysqli_num_rows($objQuery);
	$pdf->Cell(0,10,'Total No. of Entry: '.$count,0,0,'R');
	$pdf->Ln();
	


$pdf->BasicTable($header,$resultData);
$pdf->Ln();
$pdf->Ln();


//forme();
//$pdf->Output("$d.pdf","F");

$pdf->Output();

?>