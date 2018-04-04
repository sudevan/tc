<?php
 // INCLUDE THE phpToPDF.php FILE

require("fpdf181/fpdf.php");
include("tcprivate.inc");
include('connection.php');

foreach ($_POST as $key=>$value) {
	$student->$key=$value;
}


//	$str = file_get_contents($filename);
//	$student=json_decode($str);
	
	/* display use our format*/
	$dateobj=date_create($student->dob);
	$dob=date_format($dateobj,"d/m/Y");
	$new_birth_date = explode('/', $dob);

	$birth_day=dateTowords($new_birth_date[0]);
	$birth_year=numberTowords($new_birth_date[2]);
	$dateObj = DateTime::createFromFormat('!m', $new_birth_date[1]);//Convert the number into month name
	$birth_month = strtoupper($dateObj->format('F')); 
	
	
	$datewords= "$birth_day $birth_month $birth_year";
	$student->datOfOIssue=date("d/m/	Y");
	$student->tcPreparedBy="";
	$student->tcVerifiedBy="";

	$tc=array(
	"ADMN NO" => $student->admno,
	"Name of Educational Institution"=>$collegeName,
	"Name of Pupil ( in Block Letters )"=>$student->name,
	"Name of Guardian with relationship with pupil"=>$student->guardianname.",".$student->guardianrelation,
	"Religion, Community and Nationality of Student"=>$student->religion." , ". $student->community,
	"Date of Birth according to admission Register ( In figures and words )"=> "$dob ( $datewords )",
	"Date of Admission or promotion to that class"=>$student->promotiondate,
	"Whether qualified for promotion to that class"=>$student->b_promoted,
	"Whether the pupil has paid all the fee due to the institution"=>$student->b_feepaid,
	"Date of pupil's last attendance at Institution"=>$student->lastAttendanceDate,
	"Date on which the name was removed from the rolls"=>$student->rollRemovedDate,
	"No of working days upto the date"=>$student->workingDays,
	"No.of working days the pupil attended"=>$student->attendance,
	"Date of application for certificate"=>$student->dateofApplication,
	"Date of issue of the certificate"=>$student->datOfOIssue,
	"Reason for leaving the institution"=>$student->reasonForLeaving,
	"Institution to which the pupil intends proceeding"=>$student->proceedinginstitute,
	"Date of last successful vaccination"=>"",
	"Identification marks of student, if any"=>"",
	"Prepared by    "=>$student->tcPreparedBy,
	"Verified by  "=>$student->tcVerifiedBy,
	
	);

$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();

/*printing border*/
$pdf->Rect(5, 5, 200, 287, 'D');

$pdf->Rect(5+1, 5+1, 200-2, 287-2, 'D');
/*printing the heading*/
$pdf->SetFont($font,"BU",16);
$pdf->Cell(0,0,$tcheading,0,1,C);
$pdf->Ln(5);

$pdf->SetFont($font,"",12);

foreach ($tc as $key=>$value)
{
	if(is_array($value)) {
		
		foreach ($value as $subkey=>$subvalue)
		{
			/*in sub menu print with a tab offset*/
			printfield($pdf,$subkey,$subvalue,4);
		}
	}	
	else {
		printfield($pdf,$key,$value);
		
	}


	
}
$pdf->Ln(10);
$place="Palakkad";
$pdf->Cell(0,$linegap,"Place : $place ",0,1,"L");
$pdf->Cell(0,$linegap,"Date : $student->datOfOIssue ",0,1,"L");
$pdf->Cell(0,10,"Signature of Head of Institution",0,0,"R");
$pdf->output();



?>