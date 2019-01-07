
<head><title>Select Dates</title></head>


<body>

<center>
<br><br>
<h3><?php echo $course.' '.$branch.' '.$year.'-Year '.$section; ?></h3>
<!--form--><br><br>

<h5>ENTER DATES TO CONTINUE</h5><br><br></center>
<?php if(false) {?>
<center><h4>No Subjects Added!! Contact Admin.</h4></center>
<?php }?>

<div class="container">

<?php if(true) {?>
<center>
<input type="hidden" id="class_id" value="<?php echo $class_id; ?>">
<div class="form-group">
        <label for="example-date-input" class="col-form-label">From</label>
        <div class="col-4">
            <input class="form-control" type="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo  date("Y-m-d");?>" id="datePicker1" name="from" required>
        </div>
 </div>
 <div class="form-group">
        <label for="example-date-input" class="col-form-label">To</label>
        <div class="col-4">
            <input class="form-control" type="date" value="<?php date_default_timezone_set("Asia/Kolkata"); echo  date("Y-m-d");?>" id="datePicker2" name="to" required>
        </div>
 </div>

<br><br><button onclick="generate_full_report('<?php echo base_url(); ?>')" class="btn btn-success">Submit</button>

<?php }?>
<br><br><br>
</div>

</center>

</body>

</html>