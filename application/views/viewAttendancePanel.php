

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
<script type="text/javascript">
  function init_table(div) {
    var index = [];
    for(i=2;i<=(parseInt(div)+1);i++) 
      index.push(i);
    var trg = JSON.parse(JSON.stringify(index));
    if(div>6) {
      table = $('#scroll').DataTable( {
                      scrollY:        "500px",
                      scrollX:        true,
                      scrollCollapse: true,
                      paging:         false,
                      columnDefs: [ { orderable: false,  width: '20%',targets: trg } ],
                      fixedColumns:   true,
                      fixedColumns:   {
                          leftColumns: 2,
                          rightColumns: 1
                      },
                      responsive: true,
                      ordering : true,
                      dom: 'Bfrtip',
                      buttons: [
                          'copy', 'excel', 
                      ],
                  } );
      } else {
        table = $('#scroll').DataTable( {
                      scrollY:        "500px",
                      scrollX:        true,
                      scrollCollapse: true,
                      paging:         false,
                      columnDefs: [ { orderable: false,  width: '20%',targets: trg } ],
                      responsive: true,
                      ordering : true,
                      dom: 'Bfrtip',
                      buttons: [
                          'copy', 'excel', 
                      ],
                  } );
      }
            $('#min, #max').keyup( function() {
                table.draw();
            } );
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
  }
</script>
<script>
$(document).ready(function() {
    var table;
    init_table(<?php echo $divider; ?>);
} );
</script>
<script type="text/javascript">
  function dateCheck(){
        if(!document.edit.dateEdit.value)
        {
            alert("Please select a date!!");
            return false;
        }
        
        return true;
        
    }
</script>

</head>

<!-- ********************************************test boundary*********************************************************************-->

<body>



<center>


<?php if(!$list=="") { ?>
    <br>
  <div id="tabpage">
  <?php echo $table; ?>
</div>
<?php } else echo "<br><br><br><br><div class=\"col-xs-12\" style=\"height:200px;\"><h4>No Attendance To Show!!</h4></div>"; ?>
</center>
</body>
</html>

