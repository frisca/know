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
				<h3 class="blank1">Edit Profile</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" method="post" action="<?php echo base_url('profile/processEdit');?>">
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
					        <label class="control-label" for="inputWarning1">Nama</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="nama" value="<?php echo $profile->nama;?>">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Email</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="email" value="<?php echo $profile->email;?>">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Username</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="username" value="<?php echo $profile->username;?>">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Password</label>
					        <input type="password" class="form-control1" id="inputWarning1" name="password">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Team</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="team" value="<?php echo $profile->team;?>">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Position</label>
					        <?php 
					        	if($this->session->userdata('role') == 1){
					        ?>
					       	 	<input type="text" class="form-control1" id="inputWarning1" name="position" value="<?php echo $profile->position;?>" disabled>
					       	<?php
					       		}else{
					       	?>
								<select id="selector1" class="form-control1" name="position">
						        	<?php if($profile->position == 'Supervisor'){?>
										<option value="Supervisor" selected>Supervisor</option>
										<option value="Non Supervisor">Non Supervisor</option>
									<?php }else{ ?>
										<option value="Supervisor">Supervisor</option>
										<option value="Non Supervisor" selected>Non Supervisor</option>
									<?php } ?>
								</select>
					       	<?php 
					       		}
					       	?>
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
