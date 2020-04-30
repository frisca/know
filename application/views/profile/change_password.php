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
				<h3 class="blank1">Change Password</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" method="post" action="<?php echo base_url('profile/processChangePassword');?>">
						<?php if(validation_errors() != ""){?>
							<div class="alert alert-danger form-group">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo validation_errors();?>
							</div>
						<?php } ?>

						<?php if($this->session->flashdata('error') != ""){?>
							<div class="alert alert-danger form-group">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo $this->session->flashdata('error');?>
							</div>
						<?php } ?>

						<?php if($this->session->flashdata('success') != ""){?>
							<div class="alert alert-success form-group">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo $this->session->flashdata('success');?>
							</div>
						<?php } ?>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Old Password</label>
					        <input type="password" class="form-control1" name="old_password" required>
					    </div>
                        <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">New Password</label>
					        <input type="password" class="form-control1" name="new_password" required>
					    </div>
                        <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Confirm Password</label>
					        <input type="password" class="form-control1" name="confirm_password" required>
					    </div>
					    <button class="btn-success btn" type="submit">Save</button>
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
