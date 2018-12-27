
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HOME</title>

<script type="text/javascript">

  function checkForm(form)
  {
    if(form.username.value == "") {

      alert("Error: Username cannot be blank!");

      form.username.focus();

      return false;
    }
    re = /^\w+$/;

    if(!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }

    if(form.password.value != "" && form.password.value ) {
      if(form.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.password.focus();
        return false;
      }

      if(form.password.value == form.username.value) {

        alert("Error: Password must be different from Username!");

        form.password.focus();

        return false;

      }

      re = /[a-z]/;

      if(!re.test(form.password.value)) {

        alert("Error: password must contain at least one lowercase letter (a-z)!");

        form.password.focus();

        return false;

      }

    } else {

      alert("Error: Please check that you've entered and confirmed your password!");

      form.password.focus();

      return false;

    }

    return true;

  }

</script>
<body>
<center>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href="css/maincss.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/index.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap-grid.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap-reboot.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/footer.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>.css/font-awesome.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

	<style type="text/css">
	  @media screen and (min-width: 768px){
	   .rwd-break { display: none; }
	}
	</style>
</head>

<center>

	<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <img class="col-xs-12" src="<?php echo base_url(); ?>/res/davv.png" width="100" height="100" class="d-inline-block align-center" alt="iet-davv">
	    <a class="navbar-brand col-md-5 col-xs-12 " href="#"><h2 style="color:aliceblue" ><b>Institute of <br class="rwd-break">Engineering & <br class="rwd-break"> Technology 
	    <h6 class="col-md-12 col-xs-12 text-right" style="color:aliceblue;margin-top: auto;margin-left: 90px ">Faculty Information System</h6></b></h2></a>
	  <br>
	  	<p style="color: aliceblue"></p>
	  <br>
	  	<div class="collapse navbar-collapse " id="navbarSupportedContent">
		<br><br>
	  	<div class="col-md-5"></div>
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		       <div class="col-md-2"> <a class="nav-link" href="about.php" style="color: aliceblue">About</a></div>
		      </li>
		    </ul>
	    </div>
	</nav>



	<div class="login" style="vertical-align: middle;padding-top: 50px;padding-bottom: 20px">
			<div class="col-md-4" >
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col rounded">
								<a href="#" class="active" id="login-form-link"><h3>Please Login</h3></a>
							</div>
						</div>
						<hr>
					</div>

					<div class="panel-body">
						<div class="row">
						    <div class="col-md-12">
							<form id="login-form" action="<?php echo site_url('login/verify'); ?>" method="post" role="form" style="display: block;" onsubmit="return checkForm(this);">
								
								<div class="form-group">
								     <input type="text" class="form-control" id="username" name="username" placeholder="Username">
								</div>

								<div class="form-group">
								      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>

								<div class="form-group">
								    <div class="row">
										<div class="col-md-6 mx-auto">
									        <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login btn-primary" value="Log In">	Log In
									        </button>
										</div>
									</div>
								</div>

							    <div class="form-group">
									<div class="row">
										<div class="col-md-12">
											<div class="text-center">
													<div class="container">
														<a href="http://proxy.ietdavv.edu.in:8080/login/public/forgottenpassword" class="forgot-password">Forgot Password?</a>
	                                                </div>
												</div>
											</div>
										</div>
									</div>

								</form>
								</div>
						</div>
					</div>

				</div>
			</div>
	</div>
</center>
</body>
</html>
