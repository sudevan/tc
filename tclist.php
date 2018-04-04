<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sample PHP Database Application</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php

include("connection.php");
$sql="SELECT * from tcissue where 	tcissuedate IS NULL order 	by admissionno";
	
$result=$conn->query($sql);

	echo "<div class='container'>";
		echo "<div class='row-fluid'>";
		
			echo "<div class='col-xs-6'>";
			echo "<div class='table-responsive'>";
if ($result->num_rows > 0) {

    echo "<table class='table table-striped table-bordered table-hover' ><tr><th>Application No</th><th>Admission No</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$admissionno=$row['admissionno'];
    	$sql="SELECT name from student where admissionno='$admissionno'";
    	
    	$result_new=$conn->query($sql);	
		$row_new= $result_new->fetch_assoc();
		$name=$row_new['name'];
		
        echo "<tr><td>".$row["tcno"];
        echo "</td><td>";
        echo "<a href=tcprocess.php?admissionno=$admissionno >";
        echo $row["admissionno"];
        echo "</a>";
        echo "</td><td>";
        echo $name;
        echo"</td></tr>";
    }
    echo "</table>";
    echo "</div> </div> </div> </div>";
} else {
    echo "0 results";
}
 mysqli_close($conn);

?>