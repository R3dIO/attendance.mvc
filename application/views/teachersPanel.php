<!DOCTYPE html>
<html>
<head>
  <style>
     h3{color: #042c4f}
  </style>
  <title>
    Faculty panel
  </title>
</head>
<body>
<br>

<center>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card card-inverse card-info mb-3" style="margin-bottom:70px; margin-top:90px;background-color: #7abd7a">
      <div class="card-block">
        <h3 class="card-title"><h3 class="text-primary"><?php echo "Welcome ".$user; /*display username welcome message*/ ?></h3></h3>  
        <div class="icon">
          <div class="row">
            <div class="col-1"></div>

  <div class="col-md-2 col-xs-12 col-sm-12">    
    <a class="icon-wrapper" href="class_selector"><i class="fa fa-calendar-check-o fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a>
    <a href="class_selector"><h3>Attendance</h3></a> 
  </div>

  <div class="col-md-2 col-xs-12 col-sm-12">   
    <a class="icon-wrapper" href="#"><i class="fa fa-calendar fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a><br>
    <a href="#"><h3>Schedule</h3></a>
  </div>

  <div class="col-md-2 col-xs-12 col-sm-12">   
    <form method="post" action="http://feedback.ietdavv.edu.in/LoginServlet" id="feedback_form">
      <input type="hidden" name="login_type" value="faculty">
      <input type="hidden" name="username" value="<?php echo $username; ?>">
      <input type="hidden" name="password" value="<?php echo $password; ?>">
      <a class="icon-wrapper" href="#" onclick="document.getElementById('feedback_form').submit();"><i class="fa fa-comments-o fa-4x  custom-icon"><span class="fix-editor">&nbsp;</span></i></a>
      <a href="#" onclick="document.getElementById('feedback_form').submit();"><h3>Feedback</h3></a>
    </form>
  </div>

  <div class="col-md-2 col-xs-12 col-sm-12">   
    <a class="icon-wrapper" href="index.php/Search"><i class="fa fa-pencil-square-o fa-4x  custom-icon"><span class="fix-editor">&nbsp;</span></i></a><br>
    <a href="index.php/Search"><h3>Search</h3></a>
  </div>

  <div class="col-md-2 col-xs-12 col-sm-12">   
    <form method="post" action="http://117.239.195.146:8080/verifyfaculty" id="marks_form">
      <input type="hidden" name="flag" value="faculty">
      <input type="hidden" name="t1" value="<?php echo $username; ?>">
      <input type="hidden" name="t2" value="<?php echo $password; ?>">
      <a class="icon-wrapper" href="#"  onclick="document.getElementById('marks_form').submit();"><i class="fa fa-users fa-4x custom-icon"><span class="fix-editor">&nbsp;</span></i></a>
      <a href="#"  onclick="document.getElementById('marks_form').submit();"><h3>Marks</h3></a>
    </form>
  </div> 

  <div class="col-1"></div>
  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</center>
</body>
</html>
