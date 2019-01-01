

<head><title>View attendance</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/buttons.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/fixedColumns.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<style>

 th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
   
</style>

<!-- ********************************************test boundar*********************************************************************-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>js/dataTables.fixedColumns.min.js"></script>
<script>
$(document).ready(function() {

    var table = $('#scroll').DataTable( {
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [ { orderable: false,  width: '20%',targets: [<?php for ($i=2;$i<=($divider+1);$i++){echo $i.',' ;}?>] } ],
        <?php if($divider>6){
        echo"
        fixedColumns:   true,
        fixedColumns:   {
            leftColumns: 2,
            rightColumns: 1
        },";}?>
        responsive: true,
        ordering : true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 
        ],
    } );
    
} );
</script>
<script>
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var per = parseFloat( data[<?php echo $divider+3;?>] ) || 0; 
        // use data for the percentage column
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && per <= max ) ||
             ( min <= per   && isNaN( max ) ) ||
             ( min <= per   && per <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#scroll').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
    
</script>
<script>
    function dateCheck(){
        if(!document.edit.date1.value)
        {
            alert("Please select a date");
            return false;
        }
        
        return true;
        
    }
 $( document ).ready(function() {
    $('td.status').each(function( index ) {
          if($( this ).text()== 'A'){
             $(this).css("background-color","#FF6947");
             //$(this).addClass('bg-warning');  
          }
          else if($( this ).text()== 'P'){
             $(this).css("background-color","#66ED44");
             //$(this).addClass('bg-success');
          }
    });
});

//$("#relative").click(function() {
//    location.reload(true);
//});

</script>
<script>
    $(document).ready(
    function(){          
            
            $("#edit").hide();
            $("#relative").hide();
            //$("#pdf").hide();   
            $("#relbox").hide();
            $("#percentage").hide();
            
        $("#test").click(function () {
            $("#edit").toggle();
            $("#relative").toggle();
           // $("#pdf").toggle();   
            $("#relbox").toggle();
            $("#percentage").toggle();
            if($("#test").text()=="Show Features"){$("#test").text("Hide Features");}
             else{$("#test").text("Show Features");}  });
        
         $('html, body').animate({
        scrollTop: $('#tabshow').offset().top
                                 }, 'fast');  
                                 

    });
</script>

</head>

<!-- ********************************************test boundary*********************************************************************-->

<body>



<center>


<?php if(!$list=="") { ?>
<br>

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


<form class="btn-sm" action="edit_panel.php" method="post" name="edit" onsubmit="return dateCheck(this);">
   
<button type="submit" name='relative' id="relative" class="btn btn-primary" value="1" formaction="view.php" >Relative</button>
<input class="col-md-2" type="number" id="relbox" name="limit">    
<p> </p>
<div class="row ">
<div class="col-md-1 ml-auto">
<a href="admin/generate_pdf.php?schedule=<?php echo $schedule;?>">
<input type="button"  id="pdf" name="schedule" style="align-content: left; border: black; margin-bottom: 5px;  "  class="btn btn-warning" value="PDF"></a>
</div>
<div class="col-sm-3 col-md-11 mx-auto"><input type="submit" id="edit" title="First check a button on any date to edit" value="EDIT" class="btn-sm btn-success btn-block" style="float: center; width: 25%; margin-right: 90px; "></div>
<br>
</div>
<!-- self form submission-->
<form  method="post">
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
</form>
</form>
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
<?php } else echo "<br><br><br><br><div class=\"col-xs-12\" style=\"height:200px;\"><h4>No Attendance To Show!!</h4></div>"; ?>
</center>
</body>
</html>

