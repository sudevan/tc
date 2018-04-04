
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
	
	
</style>

<script type="text/javascript" >

var obj, dbParam, xmlhttp;

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var myObj = JSON.parse(this.responseText,true)
      
      <?php
      	foreach ($tcapplicationdata as $value) {
      		

 			echo "if ( typeof(myObj.$value[0]) !='undefined') {";
 				
 				echo "document.getElementById('$value[0]').value = myObj.$value[0];\n";
 				
 			echo"}"	;      		
      		
  	}
     		
      ?>
        
    }
};


$(document).ready(function(){
	
		$flag=1;
    	$("input").focusout(function(){
    		if($(this).val()=='' && $(this).attr('data-validation') == 'required'){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			if ($(this).attr('name') == 'admno') {
        				$('#load').attr('disabled',true);
        			}
        			
        			$(error_msg).text("Check mandatory fields filled or not");
        	}
        	else {
        		$(this).css("border-color", "#00FF00");
        		$('#submit').attr('disabled',false);
        		if ($(this).attr('name') == 'admno') {
        				$('#load').attr('disabled',false);
        			}
        	}
        	
       });
       $("#load").click(function(){
    	dbParam=document.getElementById("reqadmno").value;
    	document.getElementById("admno").value=dbParam;
    	xmlhttp.open("GET", "conection.php?admissionno=" + dbParam, true);
		xmlhttp.send();
	});
	
    	
	});
</script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="row">
    <div >
		<div class="panel panel-primary">
			<div class="panel-heading">Student details in case of any query contact sudevank@gmail.com or 7200668804
			</div>
			<div class="panel-body">
			<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
			<label for='reqadmno'>Admission No</label>
			<input id='reqadmno' name='reqadmno' class='form-control' type='text' data-validation='required'>
			<button id='load' name='load' > Load data </button>
			</div>
				<form name="myform" action="tcregpdfgen.php" method="POST"	>
				<input id='admno' name='admno' class='form-control' type='hidden'>
				<?php 

				function displayinputfield($value) {
					
					echo "<div class='form-group col-xs-10 col-sm-4 col-md-4 col-lg-4'>\n";
					echo "<label for='$value[0]'>$value[1]</label>\n";
					if($value[2]=="select") {
						echo "<select id='$value[0]' name='$value[0]' class='form-control' data-validation='notrequired'>\n";
						foreach($value[3] as $option)
						{
							echo "<option>$option</option>\n";
						}	
						echo "</select>\n";			
					}	
					else
					{
						echo "<input id='$value[0]' name='$value[0]' class='form-control' type='$value[2]' data-validation='required'>\n";
					}
					echo " <span id='error_$value[0]' class='text-danger'></span>\n";
					echo "</div>\n";
				}
				
				foreach ($tcapplicationdata as $value) {		
					displayinputfield($value);
				}
			
				?>
				<div class="form-group " >
					<label for="address">Address</label>
					<textarea id="address" placeholder="Address" name="address" class="form-control" rows="2"></textarea>
						<span>Download and print the application </span>
					 <span id="error_msg" class='text-danger'></span>;
					</div>

					<div class="col-submit">
					<button id="submit" type="submit" value="submit" class="btn btn-primary center">Submit</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
</body>
</html>
