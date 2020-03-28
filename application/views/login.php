<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Knowledge</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url('assets/css/style.css');?>" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="<?php echo base_url('assets/css/font-awesome.css');?>" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/icon-font.min.css');?>" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="<?php echo base_url('assets/js/Chart.js');?>"></script>
<!-- //chart -->
<!--animate-->
<link href="<?php echo base_url('assets/css/animate.css');?>" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/sweetalert.min.js");?>"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Sign In to</span> <a href="index.html">Knowledge</a></p>
						</div>
						<div class="signin">
							<?php if(validation_errors() != ""){?>
							<div class="alert alert-danger alert-dismissible log-input-left" style="width: 100%">
  								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo validation_errors();?>
							</div>
							<?php }else if($this->session->flashdata('error') != ""){ ?>
							<div class="alert alert-danger alert-dismissible log-input-left" style="width: 100%">
  								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo $this->session->flashdata('error');?>
							</div>	
							<?php } ?>	

							<form action="<?php echo base_url('login/processLogin');?>" method="post">
								<div class="log-input">
									<div class="log-input-left" style="width: 100%">
									   <input type="text" class="user" name="username" placeholder="Username" />
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="log-input">
									<div class="log-input-left" style="width: 100%">
									   <input type="password" class="lock" name="password" placeholder="Password" />
									</div>
									<div class="clearfix"> </div>
								</div>
								<input type="submit" value="Login to your account" style="width: 100%">
							</form>	 
						</div>
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">knowledge.</a></p>
			</footer>
        <!--footer section end-->
	</section>
	
<script src="<?php echo base_url('assets/js/jquery.nicescroll.js');?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js')?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>