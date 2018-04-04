
<!doctype html>	
<?php
include('tcprivate.inc');
?>

<html lang="en">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style type="text/css">
	.palel-primary
	{
		border-color: #bce8f1;
	}
	.panel-primary>.panel-heading
	{
		background:#bce8f1;
		
	}
	.panel-primary>.panel-body
	{
		background-color: #EDEDED;
	}
	 /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	
</style>

<script type="text/javascript" >

var obj, dbParam, xmlhttp;

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var myObj = JSON.parse(this.responseText,true)
    	myObj.collegeName=<?php echo "'$collegeName'"; ?>;
	if ( typeof(myObj.name) !='undefined') {document.getElementById('name').value = myObj.name;
}if ( typeof(myObj.guardianname) !='undefined') {document.getElementById('guardianname').value = myObj.guardianname;
}if ( typeof(myObj.collegeName) !='undefined') {document.getElementById('collegeName').value = myObj.collegeName;
}if ( typeof(myObj.guardianrelation) !='undefined') {document.getElementById('guardianrelation').value = myObj.guardianrelation;
}if ( typeof(myObj.religion) !='undefined') {document.getElementById('religion').value = myObj.religion;
}if ( typeof(myObj.community) !='undefined') {document.getElementById('community').value = myObj.community;
}if ( typeof(myObj.Nationality) !='undefined') {document.getElementById('Nationality').value = myObj.Nationality;
}if ( typeof(myObj.dob) !='undefined') {document.getElementById('dob').valueAsDate =new Date(myObj.dob);
}if ( typeof(myObj.b_promoted) !='undefined') {document.getElementById('b_promoted').value = myObj.b_promoted;
}if ( typeof(myObj.reasonForLeaving) !='undefined') {document.getElementById('reasonForLeaving').value = myObj.reasonForLeaving;
}if ( typeof(myObj.proceedinginstitute) !='undefined') {document.getElementById('proceedinginstitute').value = myObj.proceedinginstitute;
}
if ( typeof(myObj.address) !='undefined') {document.getElementById('address').value = myObj.address;
} 
if ( typeof(myObj.workingDays) !='undefined') {document.getElementById('workingDays').value = myObj.workingDays;
}
if ( typeof(myObj.attendance) !='undefined') {document.getElementById('attendance').value = myObj.attendance;
} 
if ( typeof(myObj.lastAttendanceDate) !='undefined') {document.getElementById('lastAttendanceDate').value = myObj.lastAttendanceDate;
}  
        
    }
};


$(window).load(function(){
		
		var admno=<?php echo $_GET['admissionno'];?>;
		if (admno != '') {
		document.getElementById("admno").readOnly=true;
		dbParam=admno;	
    	document.getElementById("admno").value=dbParam;
    	xmlhttp.open("GET", "dataretrieve.php?admissionno=" + dbParam, true);
		xmlhttp.send();    
			
		}
 
});
$(document).ready(function(){
		

		$flag=1;
    	$("input").focusout(function(){
    		if($(this).val()=='' && $(this).attr('data-validation') == 'required'){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			 $("#error_msg").text("* You have to enter your !");
        	}
        	else
        	{
        		$(this).css("border-color", "#2eb82e");
        		$('#submit').attr('disabled',false);
        		$("#error_msg").text("");
			if($(this).attr('name') == 'admno')
			{
				document.getElementById("admno").readOnly=true;
			 	dbParam=document.getElementById("admno").value;
    				document.getElementById("admno").value=dbParam;
    				xmlhttp.open("GET", "dataretrieve.php?admissionno=" + dbParam, true);
				xmlhttp.send();
			}

        	}
       });
      	
	$("#reset").click(function(){
		document.getElementById("admno").readOnly=false;
	});
	});


</script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="row">
    <div >
		<div class="panel panel-primary">
			<div class="panel-heading">Student details 
			</div>
			<div class="panel-body">
				<form name="myform" action="tcpdfgen.php" method="POST" target="_blank"	>
				<?php 

				function displayinputfield($value) {
					
					echo "<div class='form-group col-xs-10 col-sm-4 col-md-4 col-lg-4'>\n";
					echo "<label for='$value[0]'>$value[1]</label>\n";
					
					if($value[3]=="select") {
						echo "<select id='$value[0]' name='$value[0]' class='form-control' data-validation='$value[2]' >\n";
						foreach($value[4] as $option)
						{
							echo "<option>$option</option>\n";
						}	
						echo "</select>\n";			
					}	
					else
					{
						echo "<input id='$value[0]' name='$value[0]' class='form-control' type='$value[3]' data-validation='$value[2]'>\n";
					}
					echo " <span id='error_$value[0]' class='text-danger'></span>\n";
					echo "</div>\n";
					
				}
				
				foreach ($tcdata as $value) {		
					displayinputfield($value);
				}
			
				?>
				<div class="form-group col-xs-10" >
				<label for="address">Address</label>
					<textarea id="address" placeholder="Address" class="form-control" name="address" rows="2" ></textarea>
				</div>
				<div class="form-group  col-xs-10 col-sm-4 col-md-4 col-lg-4" >
					<span>Download the application </span>
					<span id="error_msg" class='text-danger'></span>;
				</div>
					<div class="col-submit col-xs-12" >
					<button id="submit" type="submit" value="submit" class="btn btn-primary center">Submit</button>

					<button id="reset" type="reset" value="reset" class="btn btn-primary center">Reset</button>
					</div>
				</form>

			</div>
			 <div class="panel-footer">Contact sudevank@gmail.com or 7200668804</div>
		</div>
	</div>
</div>
</body>
</html>
