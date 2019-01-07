<?php
require('mysql_table_full.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetLineWidth(0.4);
	$this->Rect(2,2,$this->GetPageWidth()-4,$this->GetPageHeight()-4);
	$this->Rect(2.7,2.7,$this->GetPageWidth()-5.4,$this->GetPageHeight()-5.4);
	$this->SetLineWidth(0.2);
	if($this->PageNo()>1)
		$this->Ln();
	//Ensure table header is output
	parent::Header();
}
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',6);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
function getPdf($data) {
	$class = $data['class'];
	$schedule = $data['schedule'];
	$name=$data['name'];
	$student = $data['student'];
	$sub_class = $data['sub_class'];
	$month = $data['month'];
	$year = $data['year'];
	$cols = $data['cols'];
	$present = $data['present'];

	$course=$class['course'];
	$branch=$class['branch'];
	$yr=$class['year'];
	$section=$class['section'];

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->SetMargins(3,1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,4,$course.' '.$branch.' '.$yr.'-Year '.$section,0,1,'C');
	$pdf->Ln();
	if($month<='06') {
		$pdf->Cell(0,4,'Session : Jan-Apr '.$year,0,1,'C');
	}
	else {
		$pdf->Cell(0,4,'Session : Jul-Nov '.$year,0,1,'C');
	}

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,4,'Class Coordinator : '.$name,0,1,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->AddCol('roll_no',15,'Roll No','C');
	$pdf->AddCol('name',35,'Name','C');
	for($i=0,$j=1;$i<sizeof($cols);$i++,$j++)
		$pdf->AddCol("$j",18,$cols[$i],'C');

	//First table: put all columns automatically
	$pdf->Table($student,$present);

	//Second table: specify 3 columns
	$pdf->Ln(10);
	$pdf->AddCol('subject_code',20,'Subject Code','C');
	$pdf->AddCol('subject_name',80,'Subject Name','C');
	$pdf->Table($sub_class,null);
	return $pdf->Output('S');
}
}
?>
