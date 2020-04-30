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
				<h3 class="blank1">Add Data Project</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" class="form-horizontal" method="post" action="<?php echo base_url('project/processAdd');?>">
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

						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Product</label>
					        <select id="selector1" class="form-control1" name="id_product" required>
								<?php
									foreach ($product as $key => $value) {
								?>
									<option value="<?php echo $value->id_product;?>"><?php echo $value->nama_product;?></option>	
								<?php
									}
								?>
							</select>
					    </div>

						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Title</label>
					        <input type="text" class="form-control1 input-lg" placeholder="Judul ..." required name="title">
					    </div>
						
						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">Description</label>
						    <textarea cols="80" id="edi" name="description" rows="10"></textarea>
						</div>

						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">Start Date</label>
						    <input type="text" id="start_date" class="form-control1 input-lg" name="start_date" value=""></p>
						</div>

						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">End Date</label>
						    <input type="text" id="end_date" class="form-control1 input-lg" name="end_date" value=""></p>
						</div>

					    <button class="btn-success btn" type="submit" id="project">Save</button>
					    <a href="<?php echo base_url('project/index');?>">
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
					