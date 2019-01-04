<h4>Total Lectures: <?php echo $divider;?></h4>
<div class="row">
<div class="col-md-5"></div>
 
 <br>
<button type="button" class="btn btn-info col-md-2" id="test" data-toggle="collapse" data-target="#demo">Show Features</button>

<p align="right" class="col-md-5">
<?php echo 'Academic Session - '.$session;?>
</p>
</div>

<table align="center" border="0" cellspacing="5" cellpadding="5">
        <tbody>
        <tr id="percentage">
            <td><b>Percentage <=</b></td>
            <td><input class="col-md-12" type="text" id="max" name="max"></td>
         
        </tr>
</tbody>
</table>


<form class="btn-sm" action="<?php echo base_url(); ?>index.php/edit_attendance" method="post" name="edit" onsubmit="return dateCheck(this);">
   
<input class="col-md-2" type="number" id="relbox" name="limit"> 
<button id="relative" class="btn btn-primary" onclick="relative_view('<?php echo base_url(); ?>')">Relative</button>   
<p> </p>
<div class="row ">
<div class="col-md-1 ml-auto">
<a href="admin/generate_pdf.php?schedule=<?php echo $schedule;?>">
<input type="button"  id="pdf" name="schedule" style="align-content: left; border: black; margin-bottom: 5px;  "  class="btn btn-warning" value="PDF"></a>
</div>
<div class="col-sm-3 col-md-11 mx-auto"><button type="submit" id="edit" title="First check a button on any date to edit" class="btn-sm btn-success btn-block" style="float: center; width: 25%; margin-right: 90px;">EDIT</button></div>
<br>
</div>
<input type="hidden" name="classdetail" value="<?php echo $class;?>">
<input type="hidden" name="subjectdetail" value="<?php echo $subject;?>">
<input type="hidden" name="batch" value="<?php echo $batch;?>">

<!-- self form submission-->
<div id="tabshow">
<div  style="margin-left: 20px;margin-right: 20px;" >  
  <table id="scroll" class="table table-bordered hover stripe row-border order-column">

  <thead class="thead-dark">
   
    <tr>

      <th>Roll No.</th>

      <th>Name</th>

      <?php echo $date;?>

      <th>Present No.</th>

      <th>Percentage</th>

    </tr>  
  </thead>
  <tbody id="changeOrder">
<?php echo $list; ?>
  </tbody>
</table>
</section>
</div>
</div>
  <div class="card-block">
    <blockquote class="card-blockquote">
    <div class="col-4">
  </div>
<div class="row">
</div>
</blockquote>
</div>
</div>
</form>
</div>