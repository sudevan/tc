<!doctype html>
<html lang="en-US">
<head>

	 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>GPTC Palakkad TC Application</title>
  <meta name="author" content="vidhya" >
  <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
  <script type="text/javascript" src="js/switchery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript"> 


var obj, dbParam, xmlhttp;

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var myObj = JSON.parse(this.responseText)
        document.getElementById("name").value = myObj.name;
        
         $("#tcform").show();
    }
};



	$(document).ready(function(){
    $("button").click(function(){
    	dbParam=document.getElementById("recvadmissionno").value;
    	document.getElementById("admno").value=dbParam;
    	xmlhttp.open("GET", "conection.php?admissionno=" + dbParam, true);
		xmlhttp.send();
       
    });
	});

	function stopRKey(evt) { 
	  var evt = (evt) ? evt : ((event) ? event : null); 
	  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
	  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 
	
	document.onkeypress = stopRKey; 
	
	</script>
	</head>

<body>
  <div id="wrapper">
  
  <h1>Transfer Certificate Registration </h1>
      <div class="col-2">
    <label>
      Admission No
      <input placeholder="What is your admission?" id="recvadmissionno" name="recvadmissionno" >
    </label>
  </div>
  <div class="col-2">
    <label>
  		<button type="Button" id="startbutton">Start </button>
  		</label>
  </div>
  <form action="tcreg.php" method="POST" target="_blank" id="tcform" style="display: none;">

   <div class="col-3">
    <label>
      Class Roll No
      <input placeholder="What is your Class Roll no?" id="rollno" name="rollno" >
    </label>
  </div>
  <div class="col-3">
    <label>
      Email ID
      <input placeholder="Email id" id="email" name="email" >
    </label>
  </div>
  <div class="col-3">
    <label>
      Mobile Number
      <input placeholder="What is the best # to reach you?" id="phone" name="phone" >
    </label>
  </div>
   <div class="col-3">
    <label>
      Relationship With Guardian
      <select id="guardianrelation" name="	" >
        <option>Father</option>
        <option>Mother</option>
        <option>Uncle</option>
        <option>Husband</option>
      </select>
    </label>
  </div>
   <div class="col-3">
    <label>
      Religion
      <input placeholder="Religion of the student" id="religion" name="religion" >
    </label>
    </div>
     <div class="col-3">
    <label>
      Community
      <input placeholder="Community of the student" id="community" name="community" >
    </label>
    </div>
     <div class="col-3">
    <label>
      nationality
      <select id="nationality" name="nationality" >
      <option>Indian</option>
      </select>
      </label>
    </div>
     <div class="col-3">
    <label>
      Department
      <select id="department" name="department" >
        <option>Civil Engineering</option>
        <option>Computer Hardware Engineering</option>
        <option>Electronics Engineering</option>
        <option>Electrical and Electronics Engineering</option>
        <option>Instrumentation Engineering</option>
        <option>Mechanical Engineering</option>
      </select>
    </label>
  </div>
  <div class="col-3">
    <label>
      Year Of Study
       <select id="yearOfStudy" name="yearOfStudy" >
        <option>2015-2018</option>
        </select>
    </label>
  </div>
     <div class="col-3">
    <label>
      class in which the pupil was last enrolled
      <select id="lastenrolledClass" name="lastenrolledClass" >
        <option>Final year</option>
      </select>
    </label>
  </div>
  <div class="col-3">
    <label>
      Date of admission or promote to that class
      <input type="date" id="promotiondate" name="promotiondate" >
    </label>
  </div>
 <div class="col-3">
    <label>
      whether qualified for promotion to that class
       <select id="b_promoted" name="b_promoted" >
        <option>Yes</option>
        </select>
    </label>
    </div>
    <div class="col-3">
    <label>
      whether the pupil has paid all the fee due to the institution
       <select id="b_feepaid" name="b_feepaid" >
        <option>Yes</option>
        </select>
    </label>
  </div>
  <div class="col-3">
    <label>
      whether the pupil was in receipt of fee concession
       <select id="bFeeconcession" name="bFeeconcession" >
        <option>No</option>
         <option>Yes</option>
        </select>
    </label>
  </div>
   <div class="col-3">
    <label>
     Date of pupil's last attendance at institution
      <input input type="date" id="lastAttendanceDate" name="lastAttendanceDate" >
    </label>
  </div>
   <div class="col-3">
    <label>
     Date on which the name ws removed from the rolls
      <input input type="date" id="rollRemovedDate" name="rollRemovedDate" >
    </label>
  </div>
  <div class="col-3">
    <label>
      Number of working days upto the date
       <select id="workingDays" name="workingDays" >
        <option>81 Days</option>
        </select>
    </label>
  </div>
  <div class="col-3">
    <label>
      number of working days pupil attended
      <input placeholder="" id="attendance" name="attendance" >
    </label>
  </div>
   
    <div class="col-3">
    <label>
      Reason For Leaving
       <select id="reasonForLeaving" name="reasonForLeaving" >
        <option>Course completed</option>
        </select>
    </label>
  </div>
   <div class="col-3">
    <label>
      Institution to which the pupil intend proceeding
      <input id="proceedinginstitute" name="proceedinginstitute" >
    </label>
    </div>
   <div class="col-2">
    <label>
      Identification marks of student, if any
      <input type="textarea" placeholder="As per SSLC" id="idmark" name="idmarks" >
    </label>
  </div>
  <div  class="col-2">
    <label>
      Address
      <input type="textarea" placeholder="Address coma separates" id="address" name="address" >
    </label>
  </div>
  <div class="col-submit">
    <button class="submitbtn">Submit Form</button>
  </div>
  </form>
  </div>
<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
</body>
</html>
