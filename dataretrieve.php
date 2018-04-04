<?php


include('tcprivate.inc');
include('connection.php');


$admissionno=$_GET['admissionno'];
$filename=$datadirectory."/".$admissionno.".json";
if(file_exists($filename))
{
	$str = file_get_contents($filename);
	echo $str;
}
else{
	
	#$admissionno=10100;
	$sql="SELECT name, departmentname as department FROM student, department WHERE admissionno =$admissionno AND student.departmentid = department.departmentid";
	
	$result=$conn->query($sql);
	
	
	$row = $result->fetch_assoc();
	$row['workingDays']=75;
	$row['lastAttendanceDate']="2018-03-28";
	echo json_encode($row);
}

?>
