<!-- header-starts -->
<div class="header-section">
 
<!--toggle button start-->
<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
<!--toggle button end-->

<!--notification menu start -->
<div class="menu-right">
	<div class="user-panel-top">  	
		<div class="profile_details_left">
			<ul class="nofitications-dropdown">
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
					<ul class="dropdown-menu">
						<li>
							<div class="notification_header">
								<h3>You have 3 new messages</h3>
							</div>
						</li>
						<li><a href="#">
						   <div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet</p>
							<p><span>1 hour ago</span></p>
							</div>
						   <div class="clearfix"></div>	
						 </a></li>
						 <li class="odd"><a href="#">
							<div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet </p>
							<p><span>1 hour ago</span></p>
							</div>
						  <div class="clearfix"></div>	
						 </a></li>
						<li><a href="#">
						   <div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet </p>
							<p><span>1 hour ago</span></p>
							</div>
						   <div class="clearfix"></div>	
						</a></li>
						<li>
							<div class="notification_bottom">
								<a href="#">See all messages</a>
							</div> 
						</li>
					</ul>
				</li> -->
				<li class="login_box" id="loginContainer">
					<div class="search-box">
						<div id="sb-search" class="sb-search sb-search-open" style="position:static;">
							<form>
								<input class="sb-search-input" placeholder="Enter your search project..." type="search" id="search">
								
							</form>
						</div>
					</div>
					<!-- <script src="<?php echo base_url('assets/js/classie.js');?>"></script>
					<script src="<?php echo base_url('assets/js/uisearch.js');?>"></script>
					<script>
						new UISearch( document.getElementById( 'sb-search' ) );
					</script> -->
				</li>
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
					<ul class="dropdown-menu">
						<li>
							<div class="notification_header">
								<h3>You have 3 new notification</h3>
							</div>
						</li>
						<li><a href="#">
							<div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet</p>
							<p><span>1 hour ago</span></p>
							</div>
						  <div class="clearfix"></div>	
						 </a></li>
						 <li class="odd"><a href="#">
							<div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet </p>
							<p><span>1 hour ago</span></p>
							</div>
						   <div class="clearfix"></div>	
						 </a></li>
						 <li><a href="#">
							<div class="user_img"><img src="images/1.png" alt=""></div>
						   <div class="notification_desc">
							<p>Lorem ipsum dolor sit amet </p>
							<p><span>1 hour ago</span></p>
							</div>
						   <div class="clearfix"></div>	
						 </a></li>
						 <li>
							<div class="notification_bottom">
								<a href="#">See all notification</a>
							</div> 
						</li>
					</ul>
				</li>	
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">22</span></a>
					<ul class="dropdown-menu">
						<li>
							<div class="notification_header">
								<h3>You have 8 pending task</h3>
							</div>
						</li>
						<li><a href="#">
								<div class="task-info">
								<span class="task-desc">Database update</span><span class="percentage">40%</span>
								<div class="clearfix"></div>	
							   </div>
								<div class="progress progress-striped active">
								 <div class="bar yellow" style="width:40%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
							   <div class="clearfix"></div>	
							</div>
						   
							<div class="progress progress-striped active">
								 <div class="bar green" style="width:90%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
								<div class="clearfix"></div>	
							</div>
						   <div class="progress progress-striped active">
								 <div class="bar red" style="width: 33%;"></div>
							</div>
						</a></li>
						<li><a href="#">
							<div class="task-info">
								<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
							   <div class="clearfix"></div>	
							</div>
							<div class="progress progress-striped active">
								 <div class="bar  blue" style="width: 80%;"></div>
							</div>
						</a></li>
						<li>
							<div class="notification_bottom">
								<a href="#">See all pending task</a>
							</div> 
						</li>
					</ul>
				</li>		   							   		 -->
				<div class="clearfix"></div>	
			</ul>
		</div>
		<div class="profile_details">		
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile_img">	
							<span style="background:url(<?php echo base_url('assets/images/1.jpg');?>) no-repeat center"> </span> 
								<?php if($this->session->userdata('role') == 1){?>
								<div class="user-name">
									<p><?php echo $nama;?><span>Administrator</span></p>
								</div>
								<?php }else if($this->session->userdata('role') == 2){?>
								<div class="user-name">
									<p><?php echo $nama;?><span>Supervisor</span></p>
								</div>
								<?php }else{ ?>
								<div class="user-name">
									<p><?php echo $nama;?><span>Staff</span></p>
								</div>
								<?php } ?>
								<i class="lnr lnr-chevron-down"></i>
								<i class="lnr lnr-chevron-up"></i>
							<div class="clearfix"></div>	
						</div>	
					</a>
					<ul class="dropdown-menu drp-mnu">
						<li> <a href="<?php echo base_url('profile/changePassword');?>"><i class="fa fa-cog"></i>Change Password</a> </li> 
						<li> <a href="<?php echo base_url('profile/edit')?>"><i class="fa fa-user"></i>Edit Profile</a> </li> 
						<li> <a href="<?php echo base_url('login/logout')?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
					</ul>
				</li>
				<div class="clearfix"> </div>
			</ul>
		</div>	
	</div>
</div>
<!--notification menu end -->

</div>
<!-- header-ends -->
