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
	$from = $data['from'];
	$to = $data['to'];

	$course=$class['course'];
	$branch=$class['branch'];
	$yr=$class['year'];
	$section=$class['section'];
	$fac_id=$class['coordinator_id'];

	$col='';
	$n=0;
	foreach ($schedule as $key => $value) {
		$sub_id=$value['subject_id'];
		$sch_id=$value['id'];
		$subject = $this->view_attendance_model->getSubject($sub_id);
		$col.="$n,";
		$lec=null;
		$l=1;
		while($l<=$value['last_lecture_no']) {
			$month=substr($value['last_lecture_date'],5,2);
			$year=substr($value['last_lecture_date'],0,4);
			if($value['l'.$l]>=$from && $value['l'.$l]<=$to)
				$lec[]=$l;
			$l++;
		}
		$lec_no=sizeof($lec);
		$cols[]=$subject[0]->subject_code.'('.$lec_no.')';
		$attendance = $this->classes_model->getAttendance($value['id'],$class['id']);
		foreach ($attendance as $ky => $val) {
			$pr=0;
			for($k=0;$k<sizeof($lec);$k++) {
				if($val['l'.$lec[$k]]==1)
					$pr++;
			}
		$p[]=$pr;
		}
		$present[]=$p;
		$p=null;
		$n++;
	}

	$col=substr($col,0,sizeof($col)-1);
	$name=$data['name'];
	$sem='';

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->SetMargins(3,1);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,4,$course.' '.$branch.' '.$yr.'-Year '.$section,0,1,'C');
	$pdf->Ln();
	if($month<='06') {
		$pdf->Cell(0,4,'Session : Jan-Apr '.$year,0,1,'C');
		$sem='e';
	}
	else {
		$pdf->Cell(0,4,'Session : Jul-Nov '.$year,0,1,'C');
		$sem='o';
	}
	switch($yr) {
		case 1:
		if($sem == 'o')
			$s=1;
		else $s=2;
		break;
		case 2:
		if($sem == 'o')
			$s=3;
		else $s=4;
		break;
		case 3:
		if($sem == 'o')
			$s=5;
		else $s=6;
		break;
		case 4:
		if($sem == 'o')
			$s=7;
		else $s=8;
		break;
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

	$student = $this->classes_model->getStudents($col,$class_id);
	//First table: put all columns automatically
	$pdf->Table($student,$present);

	//Second table: specify 3 columns
	$pdf->Ln(10);
	$pdf->AddCol('subject_code',20,'Subject Code','C');
	$pdf->AddCol('subject_name',80,'Subject Name','C');
	$sub_class = $this->classes_model->getclassSubject($course,$branch,$s);
	$pdf->Table($sub_class,null);
	return $pdf->Output('S');
}
}
?>
