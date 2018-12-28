
<head>
	<title>
		Attendance
	</title>
	<style type="text/css">
	  @media screen and (min-width: 768px){
	   .rwd-break { display: none; }
	}
	</style>
</head>

<script type="text/javascript">
function SetSubTh() {

  var subject=document.getElementById("subjectdetailth");
  var hidden_sub=document.getElementById("hidden_subth");
  var hidden=document.getElementById("hiddenth");

  while(subject.options.length)
     subject.remove(0);

  for(i=0;i<hidden.options.length;i++) {
    if(hidden.options[i].value == document.selectclass.classdetail.value) {
	    for(j=0;j<hidden_sub.options.length;j++){
	        if(hidden.options[i].text == hidden_sub.options[j].value) {
		        var op=document.createElement("OPTION");
		        op.value=hidden_sub.options[j].value;
		        op.text=hidden_sub.options[j].text;
		        subject.options.add(op);
		        break;            
	      }
	    }
  	}
  }
}
</script>

<script type="text/javascript">
function SetSubLb() {
  
  var subject=document.getElementById("subjectdetaillb");
  var hidden_sub=document.getElementById("hidden_sublb");
  var hidden=document.getElementById("hiddenlb");
  
  while(subject.options.length)
     subject.remove(0);
  
  for(i=0;i<hidden.options.length;i++) {
    if(hidden.options[i].value == document.selectlab.classdetail.value) {
	    for(j=0;j<hidden_sub.options.length;j++){
	        if(hidden.options[i].text == hidden_sub.options[j].value) {
		        var op=document.createElement("OPTION");
		        op.value=hidden_sub.options[j].value;
		        op.text=hidden_sub.options[j].text;
		        subject.options.add(op);
		        break;
	      }
	    }
  	}
  }
}
</script>

<script type="text/javascript">
  function checkFormth(form)
  {
    if(form.classdetail.value == "Select Class") {
      alert("Error: Please Select Class!");
      form.classdetail.focus();
      return false;
    }

    if(form.subjectdetail.value=="Select Subject") {
      alert("Error: Please Select Subject!");
      form.subjectdetail.focus();
      return false;
    }

    return true;
  }
</script>

<script type="text/javascript">
  function checkFormlb(form)
  {
    if(form.classdetail.value == "Select Class") {
      alert("Error: Please Select Class!");
      form.classdetail.focus();
      return false;
    }

    if(form.subjectdetail.value=="Select Subject") {
      alert("Error: Please Select Subject!");
      form.subjectdetail.focus();
      return false;
    }

    return true;
  }
</script>

<body>
<center>
	<br><br>
		<h1>SELECT CLASS/LAB TO CONTINUE</h1>
	<br><br>
</center>

<?php if($branchListTH=="" && $branchListLB == "") {?>
<center><h4>No Subjects Added!! Contact Admin.</h4></center>
<?php }?>

<div class="col-md-12 row">
<?php if($branchListTH!="") {?>
	<div class="col-md-6 col-xs-12">
		<form  name="selectclass" action="AttendancePanel.php" method="post" onsubmit="return checkFormth(this);"><center>
			<div class="form-group">

   			<div class="col-md-3"></div>  
   				<label for="example-date-input" class="col-col-form-label"><b>Class</b></label><br>
		    <div class="col-md-8">
		        <div class="row">

					    <select class="form-control" id="classdetailth" name="classdetail" onChange="SetSubTh(this)">
					    	<option>Select Class</option>
					   		<?php echo $branchListTH;?>
					    </select>

					    <select class="form-control" id="subjectdetailth" name="subjectdetail" onChange="SetSubTh(this)">
					    	<option>Select Subject</option>
					    </select>
					    <select class="form-control" id="hiddenth" name="hiddenth" hidden>
					   		<?php echo $subjectListTH;?>
					    </select>

					    <select class="form-control" id="hidden_subth" name="hidden_subth" hidden>
					   		<?php echo $subjectCodeTH;?>
					    </select>

						<input type="hidden" name="batch" value='0'>
				</div>
		    </div>

 			</div>
			<button type="submit" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="view.php">View Attendance</button>
		</form>
	</div>
<?php }?>
<br><br><br>

<hr>

<br class="rwd-break">
<?php if($branchListLB!="") { ?>
	<div class="col-md-6 col-xs-12">
		<form name="selectlab" action="AttendancePanel.php" method="post" onsubmit="return checkFormlb(this);"><center>
			<div class="form-group">
			   <div class="col-md-3"></div> 
			   		<label for="example-date-input" class="col-col-form-label"><b>Lab</b></label><br>
			    
			    <div class="col-md-8">
				    <select class="form-control " id="classdetaillb" name="classdetail" onChange="SetSubLb(this)">
				    
				    <option>Select Lab</option>
				   		<?php echo $branchListLB;?>
				    </select>

				    <select class="form-control " id="subjectdetaillb" name="subjectdetail" onChange="SetSubLb(this)">
				  		<option>Select Subject</option>
				    </select>

				    <select class="form-control" id="hiddenlb" name="hiddenlb" hidden>
				   		<?php echo $subjectListLB;?>
				    </select>

				    <select class="form-control" id="hidden_sublb" name="hidden_sublb" hidden>
				   		<?php echo $subjectCodeLB;?>
				    </select>
			    </div>

			<br>
				<div class="form-group">
					<div class="col-md-8">
						Batch:
						<select class="form-control" id="batch" name="batch">
						<option>1</option>
						<option>2</option>
						</select>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="view.php">View Attendance</button>
		</form>
	</div>
<?php } ?>
<br><br><br>

</div>
</div>
<br><br>

<?php if($coordinator) { ?>
	<a href='date_select.php' ><p style="text-align:center">Click here for all subject attendance report</p></a>
<?php } ?>

</center>
</body>
</html>