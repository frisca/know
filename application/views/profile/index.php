<?php $this->load->view('script_header');?>   
<section>
	<!-- menu start-->
	<?php $this->load->view('menu');?>
	<!-- menu end-->

	<!-- main content start-->
	<div class="main-content">
		<?php echo $this->load->view('header');?>
		<div id="page-wrapper">
			<div class="graphs">
				<h3 class="blank1">Profile</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form">
						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Nama</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="nama" value="<?php echo $profile->nama;?>" disabled>
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Email</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="email" value="<?php echo $profile->email;?>" disabled>
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Username</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="username" value="<?php echo $profile->username;?>" disabled>
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Team</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="team" value="<?php echo $profile->team;?>" disabled>
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Position</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="position" value="<?php echo $profile->position;?>" disabled>
					    </div>
					    <a href="<?php echo base_url('home/index');?>">
					   		<button class="btn-default btn" type="button" style="padding: 9.5px 12px;">Cancel</button>
					   	</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- main content end-->

	<!-- footer start -->
	<?php echo $this->load->view('footer');?>
	<!-- footer end -->
</section>
<?php $this->load->view('script_footer');?>
