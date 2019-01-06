
<!doctype html>
<html>
<head>   
 <style type="text/css">
   a:link {
    text-decoration: none;
    color:black;
}
 </style>
<body>
 
<div class="container">
<br>   
<div class="row mx-auto"> 
<div class="col-md-2"></div>
<div class="col-md-8">
  <label for="search">Search:</label>
  <input type="text" class="form-control" id="search" 
        placeholder="Enter Name , Enrollment Number or Roll Number of student" name="enroll">
</div> 
<div class="col-md-2">
    <br>
    <button id="view" type="submit" class="btn btn-primary" align="center">Search</button>
</div>
</div>
<div class="col-md-10 mx-auto" style="position:absolute;z-index:15;">
    <div id="loading" style="display:none;">
         <img src="<?php echo base_url();?>/res/loading.gif" width=20%>
    </div>
</div>
    <div class="mx-auto col-md-8" id="display"></div>
</div> 

<div class="modal" id="myModal" style="border-radius:25px;" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Student Detail</h4>
      </div>

      <div class="modal-body" id="modal-body">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<br><br><br><br><br><br>
</body>
<script>
function fill(Value) {
   $('#search').val(Value);
   $('#display').hide();
}
 
$(document).ready(function() {
   $("#view").click(function() {
      var studentId = $('#search').val();
      $("#loading").show();
      if (studentId == "") {
          $("#display").html(""); 
       }
       else {
           $.ajax({
               type: "POST",
               url:  "<?php echo base_url();?>index.php/Search/searchStudent", 
               data: {
                   search: studentId
               },
               success: function(html) {
                  console.log(html);
                  $("#display").html(html).show();
                  $("#loading").hide();  
               }
           });
       }
   });
});
 
function get_detail(enrol) {
  $.post("<?php echo base_url();?>index.php/Search/studentDetails",{
          enroll:enrol
        }, function(data){
            console.log(data);
            $( "#modal-body" ).html( data );
            $('#myModal').modal('show');
        });
}
 
 </script>
</html>


