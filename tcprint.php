<?php
include('tcprivate.inc');

$admno=$_GET['admissionno'];

?>
<html>
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

$(document).ready(function(){
	
		$flag=1;
    	$("input").focusout(function(){
    		if($(this).val()==''){
        		$(this).css("border-color", "#FF0000");
        			$('#submit').attr('disabled',true);
        			$(error_msg).text("Check mandatory fields filled or not");
        	}
        	else {
        		$(this).css("border-color", "#00FF00");
        			$('#submit').attr('disabled',false);
        	}
        	if ($(this).name == 'admissionno') {
        		alert("Hello");
        		
        	}
        	
 
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
				<form name="myform">
				<?php 

				foreach ($tcdata as $value) {		
					echo '<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">';
					echo "<label for='$value[0]'>$value[1] *</label>";
					if($value[2]=="select") {
						echo "<select id='$value[0]' name='$value[1]' class='form-control' data-validation='required'>";
						foreach($value[3] as $option)
						{
							echo "<option>$option</option>";
						}	
						echo "</select>";			
					}	
					else
					{
						echo "<input id='$value[0]' name='$value[1]' class='form-control' type='$value[2]' data-validation='required'>";
					}
					echo " <span id='error_$value[0]' class='text-danger'></span>";
					echo '</div>';
				}
				?>
					<div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-8" >
						<label for="disc">Address</label>
						<textarea id="disc" class="form-control" rows="2"></textarea>
					</div>
					 <span id=error_msg class='text-danger'></span>;
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