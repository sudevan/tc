
<?php
 // INCLUDE THE phpToPDF.php FILE
//require("fpdf181/fpdf.php"); 
include("tcprivate.inc");	
include("connection.php");
require("code128.php");


/*getting data from POST and store it into student structure*/
//echo "Hello";
//print_r($_POST, $return = null);
foreach ($_POST as $key=>$value) {
	$student->$key=$value;
}

if ($student->admno == '')
{
	$outputfilename="blankapplicationform.pdf";
}
else {
	$outputfilename="studentapplication/".$student->admno.".pdf";
}
$student->name=strtoupper($student->name);

/*store it in actual format display use our format*/
$dateobj=date_create($student->dob);
$dob=date_format($dateobj,"d/m/Y");
$student->dateofApplication=date("d/m/Y");
$dateobj=date_create($student->lastAttendanceDate);
$lastAttendanceDate=date_format($dateobj,"d/m/Y");

$dateobj=date_create($student->promotiondate);
$student->promotiondate=date_format($dateobj,"d/m/Y");

$dateobj=date_create($student->rollRemovedDate);
$student->rollRemovedDate=date_format($dateobj,"d/m/Y");

$student->address = preg_replace('#\R+#', ' ', $student->address);


$filename=$datadirectory."/".$student->admno.".json";
try {
   $fp = fopen($filename, 'w') ;
    if (! $fp) {
        throw new Exception("Could not open the file $filename!");
    }
}
catch (Exception $e) {
    echo "Error (File: ".$e->getFile().", line ".
          $e->getLine()."): ".$e->getMessage();
}

fwrite($fp, json_encode($student));
fclose($fp);


$applicationData["Department "]= $student->department;
$applicationData["Roll No "]= $student->rollno;
$applicationData["Admission No "]= $student->admno;
$applicationData["Name of the student (in block letters) "]= $student->name;
$applicationData["Address (Permanent) "]= $student->address;
$applicationData["Year Of Studies"]= $student->yearOfStudy;
$applicationData["Date of birth "]= $dob;
$applicationData["Particulars regarding Concession or scholarship obtained if any"]= $student->bFeeconcession;
$applicationData["Reason for leaving"]= $student->reasonForLeaving;
$applicationData["Total No of working hours"]= $student->workingDays;
$applicationData[" No.of working hours the pupil attended"]=$student->attendance;
$dueclearlist=array("Head of section"=>"","Workshop"=>"","Applied Science lab"=>"","Library"=>"","Co-op Society"=>"","Physical education"=>"","NSS"=>"","NCC"=>"",
"Hostel"=>"","Academic section"=>"");
$applicationData["Dues if any to be furnished below"]=$dueclearlist;
$applicationData["Amount of caution deposit"]= "500 Rupees";
$applicationData["signature of student"]="";
$applicationData["Date of application"]=$student->dateofApplication;
$applicationData["Order of the principal"]="";


$sql="INSERT INTO tcissue(admissionno) values ($student->admno)";
$result=$conn->query($sql);

$sql="SELECT tcno from tcissue where admissionno=$student->admno";
$result=$conn->query($sql);	
$row = $result->fetch_assoc();
$tcno=$row['tcno'];

/*variables from form*/
$slNO=1; //global variable for item index
$subItemNo=1; //for due list



$pdf=new PDF_Code128('P','mm','A4');
$pdf->AddPage();

/*printing border*/
$pdf->Rect(5, 5, 200, 287, 'D');

/*printing the heading*/
$pdf->SetFont($font,"BU",16);
$pdf->MultiCell(0,6,"{$collegeName}",0,"C");
$pdf->Ln(4);
$pdf->Cell(0,0,$applicationHeader,0,1,C);
$pdf->Ln(3);


$pdf->SetFont($font,"",10);

printfield($pdf,"Application No",$tcno);
/*printing left column description and data*/
foreach ($applicationData as $key=>$value)
{
	if(is_array($value)) {
		printfield($pdf,$key,"");
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

$pdf->Cell(160,10,"Principal",0,0,"R");

$pdf->Code128(10,10,$tcno,30,8);

echo "<h1> Your application no is $tcno </h1> <br> ";
echo "<a href='$outputfilename' download>Click here to download your application</a>";

$pdf->output("F","$outputfilename");


?>