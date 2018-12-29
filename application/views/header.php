
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo base_url(); ?>css/maincss.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-grid.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-reboot.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/footer.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</head>

<style type="text/css">
  @media screen and (min-width: 768px){
   .rwd-break { display: none; }
}
</style>
<center>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#defaultNavbar1" aria-controls="defaultNavbar1" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
  </button>
  <img class="col-xs-12 " src="<?php echo base_url(); ?>res/davv.png" width="100" height="100" class="d-inline-block align-center" alt="iet-davv">
  <a class="navbar-brand col-md-5 col-xs-12 " href="#">
    <h2 style="color:aliceblue" >
      <b>Institute of <br class="rwd-break">Engineering & <br class="rwd-break"> Technology 
        <h6 class="col-md-12 col-xs-12 text-right" style="color:aliceblue;margin-top: auto;margin-left: 90px ">
          <?php echo $domain_name;?>
        </h6>
      </b>
    </h2>
  </a>
  <br>

  <div class="collapse navbar-collapse " id="defaultNavbar1">
    <br><br>
      <div class=" col-md-3 col-xs-12"></div>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <div class="col-md-3 "> <a class="nav-link" href="<?php echo base_url(); ?>index.php" style="color: aliceblue">Home<span class="sr-only">(current)</span></a></div>
        </li>
        <li class="nav-item">
           <div class="col-md-3 "> <a class="nav-link" href="about.php" style="color: aliceblue">About</a></div>
        </li>
        <li class="nav-item">
          <div class="col-md-3 ">  <a class="nav-link" href="logout.php" style="color: aliceblue">Logout</a></div>
        </li>
        <li class="nav-item">
          <div class="col-md-3 ">  <input  class="btn btn-primary" type="button" value="Back" onclick="window.history.back()" /></div>
        </li>  
      </ul>
  </div>

</nav>
</center>
