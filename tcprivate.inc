<?php

//$collegeName="GOVERNMENT POLYTECHNIC COLLEGE \r\nPALAKKAD";
$collegeName="IPT AND GPTC SHORANUR";
$applicationHeader="APPLICATION FOR T.C , C.C AND REFUND OF CAUTION DEPOSIT";
#saving the student data to file
$datadirectory="studentdata";
$tcheading="TRANSFER CERTIFICATE";
$font="Times";

$descriptionwidth=90; //widthof the data in leftside content of the form
$studentdatawidth=80; //data length of right side data
$linegap=8.4; // line width

$tcdata=array(
array("admno","ADMN NO","required","text"),
array("collegeName","Name of Educational Institution","required","text"),
array("name","Name of Pupil ( in Block Letters )","required","text"),
array("guardianname","Name of Guardian","required","text"),
array("guardianrelation","Guardian relationship with pupil","required","select",array("Father","Mother","Uncle","Husband")),
array("religion","Religion","required","text"),
array("community","Community","required","text"),
array("Nationality"," Nationality ","required","select",array("Indian")),
array("dob","Date of Birth according to admission Register ( In figures )","required","date"),
//array("dobwords","Date of Birth according to admission Register ( in words )","required","text"),
array("promotiondate","Date of Admission or promotion to that class","required","date"),
array("b_promoted","Whether qualified for promotion to that class","required","text"),
array("b_feepaid","Whether the pupil has paid all the fee due to the institution","required","select",array("No","Yes")),
array("lastAttendanceDate","Date of pupil's last attendance at Institution","required","date"),
array("rollRemovedDate","Date on which the name was removed from the rolls","required","date"),
array("workingDays","No of working days up-to the date","required","text"),
array("attendance","No.of working days the pupil attended","required","text"),
array("dateofApplication","Date of application for certificate","required","date"),
array("datOfOIssue","Date of issue of the certificate","required","date"),
array("reasonForLeaving","Reason for leaving the institution","required","text"),
array("proceedinginstitute","Institution to which the pupil intends proceeding","required","text"),
array("vaccination","Date of last successful vaccination","required","date"),
array("idmark","Identification marks of student, if any","required","text"),
array("preparedby","Prepared by    ","required","text"),
array("verifiedby","Verified by  ","required","text")
);

$tcapplicationdata=array(

array("admno","ADMN NO","required","text"),
array("name","Name of Pupil ( in Block Letters )","required","text"),
array("department","Department","required","select",array("Civil Engineering","Computer Hardware Engineering","Electronics Engineering",
"Electrical and Electronics Engineering","Instrumentation Engineering","Mechanical Engineering")),
array("rollno","Class Roll no","required","text"),
array("email","Email Address","required","text"),
array("phone","Mobile Number","required","text"),
array("guardianname","Name of Guardian","required","text"),
array("guardianrelation","Guardian relationship with pupil","required","select",array("Father","Mother","Uncle","Husband")),
array("religion","Religion","required","text"),
array("community","Community","required","text"),

array("Nationality"," Nationality ","required","select",array("Indian")),
array("dob","Date of Birth according to admission Register ( In figures )","required","date"),
array("b_promoted","Whether qualified for promotion to that class","required","select",array(Yes)),
array("workingDays","No of working days up-to the date","required","text"),
array("attendance","No.of working days the pupil attended","required","text"),

array("lastAttendanceDate","Date on which the name was removed from the rolls","required","date"),
array("reasonForLeaving","Reason for leaving the institution","required","select",array("Course Completed")),
//array("proceedinginstitute","Institution to which the pupil intends proceeding","optional","text"),
array("yearOfStudy","Years Of Study","select",array("2015-2018")),
array("lastenrolledClass","class in which the pupil was last enrolled","optional","select",array("Final year")),
array("bFeeconcession","whether the pupil was in receipt of fee concession","required","select",array("No","Yes")),

);


$tcapplicationdatahidden=array(

"collegeName","lastAttendanceDate","rollRemovedDate",
);


function printfield($pdf,$item,$value="",$taboffset=0) {

	global $slNO,$linegap,$descriptionwidth,$studentdatawidth,$subItemNo;
	
		
	if($taboffset > 0)
	{
		$pdf->Cell($taboffset,$linegap,"",0,0,"L");
		$no=$subItemNo;
		$subItemNo++;
		
	}
	else {
		$no=$slNO;
		$slNO++;
	}
		

	//$pdf->Cell(6,$linegap,$no.".",0,0,"R");	
	
	$stringwidth=$pdf->GetStringWidth($item);
	if($stringwidth > $descriptionwidth) {
		//wraping text if the length not fit in cells
		$x = $pdf->GetX() + $descriptionwidth;
    	$y = $pdf->GetY()+$linegap;
		$pdf->MultiCell($descriptionwidth-$taboffset,$linegap,$item,0,"L",0);
		$multilineprinted=true;
		$nexlinex = $pdf->GetX();
    	$nextliney = $pdf->GetY();
		$pdf->SetXY($x,$y);
		
	}
	else {
			$pdf->Cell($descriptionwidth-$taboffset,$linegap,$item,0,0,"L");
		}
		
	$pdf->Cell(10,$linegap,":",0,0,"C");
	
	$stringwidth=$pdf->GetStringWidth($value);
	if($stringwidth > $studentdatawidth ) {
		$pdf->MultiCell(0,$linegap,$value,0,"L");
		$multilineprinted=false;
	}
	else {
			
		$pdf->Cell(0,$linegap,$value,0,1,"L");
	}
	if($multilineprinted) {
		$pdf->SetXY($nexlinex,$nextliney);
	}


}

function dateTowords($num)
{
	$num=(int)$num;
	$datestring = array(
	1=>"FIRST",
	2=>"SECOND",
	3=>"THIRD",
	4=>"FOURTH",
	5=>"FIFTH"	
	);
	$rettext="";
	if($num < 5)
	{
		return $datestring[$num];
	}
	return(numberTowords($num));

}

function numberTowords($num)
{ 
	$ones = array(
	0 =>"ZERO", 
	1 => "ONE", 
	2 => "TWO", 
	3 => "THREE", 
	4 => "FOUR", 
	5 => "FIVE", 
	6 => "SIX", 
	7 => "SEVEN", 
	8 => "EIGHT", 
	9 => "NINE", 
	10 => "TEN", 
	11 => "ELEVEN", 
	12 => "TWELVE", 
	13 => "THIRTEEN", 
	14 => "FOURTEEN", 
	15 => "FIFTEEN", 
	16 => "SIXTEEN", 
	17 => "SEVENTEEN", 
	18 => "EIGHTEEN", 
	19 => "NINETEEN",
	"014" => "FOURTEEN" 
	); 
	$tens = array( 
	0 => "ZERO",
	1 => "TEN",
	2 => "TWENTY", 
	3 => "THIRTY", 
	4 => "FORTY", 
	5 => "FIFTY", 
	6 => "SIXTY", 
	7 => "SEVENTY", 
	8 => "EIGHTY", 
	9 => "NINETY" 
	); 
	$hundreds = array( 
	"HUNDRED", 
	"THOUSAND", 
	"MILLION", 
	"BILLION", 
	"TRILLION", 
	"QUARDRILLION" 
	); //limit t quadrillion 
	
	$num = number_format($num,2,".",","); 
	$num_arr = explode(".",$num); 
	$wholenum = $num_arr[0]; 
	$decnum = $num_arr[1]; 
	$whole_arr = array_reverse(explode(",",$wholenum)); 
	krsort($whole_arr,1); 
	$rettxt = ""; 
	foreach($whole_arr as $key => $i){
		while(substr($i,0,1)=="0")
			$i=substr($i,1,5);
		if($i < 20){ 
			$rettxt .= $ones[$i]; 
		}elseif($i < 100){ 
			if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
			if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
		}else{ 
			if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
			if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
			if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
		} 
		if($key > 0){ 
			$rettxt .= " ".$hundreds[$key]." "; 
		} 
	} 
	if($decnum > 0){ 
		$rettxt .= " and "; 
	if($decnum < 20){ 
		$rettxt .= $ones[$decnum]; 
	}elseif($decnum < 100){ 
		$rettxt .= $tens[substr($decnum,0,1)]; 
		$rettxt .= " ".$ones[substr($decnum,1,1)]; 
		} 
	} 
	return $rettxt; 
} 

?>