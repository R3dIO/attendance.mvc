
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
    if(form.classdetail.value == "Select Lab") {
      alert("Error: Please Select Lab!");
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
	window.addEventListener("pageshow", function(event) {
		var history = event.persisted || (typeof window.performance != "undefined" & window.performance.navigation.type === 2);
		if(history) {
			window.location.reload(true);
		}
	});
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
		<form  name="selectclass" action="<?php echo base_url(); ?>index.php/show_panel" method="post" onsubmit="return checkFormth(this);"><center>
			<div class="form-group">

   			<div class="col-md-3"></div>  
   				<label for="example-date-input" class="col-col-form-label"><b>Class</b></label><br>
		    <div class="col-md-8">
		        <div class="row">

					    <select class="form-control" id="classdetailth" name="classdetail" onChange="loadSubjects('<?php echo base_url(); ?>', <?php echo $id; ?>,'theory')">
					    	<option>Select Class</option>
					   		<?php echo $branchListTH;?>
					    </select>

					    <select class="form-control" id="subjectdetailth" name="subjectdetail" onChange="SetSubTh(this)">
					    	<option>Select Subject</option>
					    </select>
		
						<input type="hidden" name="batch" value='0'>
				</div>
		    </div>

 			</div>
			<button type="submit" id="newth" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;
			<button type="submit" id="viewth" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="<?php echo base_url(); ?>index.php/view_attendance">View Attendance</button>
		</form>
	</div>
<?php }?>
<br><br><br>

<hr>

<br class="rwd-break">
<?php if($branchListLB!="") { ?>
	<div class="col-md-6 col-xs-12">
		<form name="selectlab" action="<?php echo base_url(); ?>index.php/show_panel" method="post" onsubmit="return checkFormlb(this);"><center>
			<div class="form-group">
			   <div class="col-md-3"></div> 
			   		<label for="example-date-input" class="col-col-form-label"><b>Lab</b></label><br>
			    
			    <div class="col-md-8">
				    <select class="form-control " id="classdetaillb" name="classdetail" onChange="loadSubjects('<?php echo base_url(); ?>', <?php echo $id; ?>,'lab')">
				    
				    <option>Select Lab</option>
				   		<?php echo $branchListLB;?>
				    </select>

				    <select class="form-control " id="subjectdetaillb" name="subjectdetail" onChange="SetSubLb(this)">
				  		<option>Select Subject</option>
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
			<button type="submit" id="newlb" class="btn btn-primary col-md-5" style="padding-left:40px;padding-right:40px">New Attendance</button>&nbsp;&nbsp;&nbsp;
			<button type="submit" id="viewlb" class="btn btn-info col-md-5" style="padding-left:40px;padding-right:40px" formaction="<?php echo base_url(); ?>index.php/view_attendance">View Attendance</button>
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
