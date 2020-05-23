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
				<h3 class="blank1">Edit Data Project</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" class="form-horizontal" method="post" action="<?php echo base_url('project/processEdit');?>" enctype="multipart/form-data">
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
							<input type="hidden" name="id" value="<?php echo $project->id_project;?>">
					        <label class="control-label" for="inputWarning1">Product</label>
					        <select id="selector1" class="form-control1" name="id_product" required>
								<?php
									foreach ($product as $key => $value) {
										if($project->id_product == $value->id_product){
								?>
									<option value="<?php echo $value->id_product;?>" selected><?php echo $value->nama_product;?></option>	
								<?php
										}else{
								?>
									<option value="<?php echo $value->id_product;?>"><?php echo $value->nama_product;?></option>	
								<?php 
										}
									}
								?>
							</select>
					    </div>

						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Title</label>
					        <input type="text" class="form-control1 input-lg" placeholder="Judul ..." required name="title" value="<?php echo $project->nama_project;?>">
					    </div>
						
						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">Description</label>
						    <!-- <?php echo $this->ckeditor->editor("textarea name","default textarea value"); ?> -->
						    <textarea cols="80" id="edi" name="description" rows="10"><?php echo $project->description;?></textarea>
						</div>

						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">File</label>
					        <div>
						        <a href="<?php echo base_url('project/download/'.$project->id_project);?>">
									<?php echo $project->files;?>
								</a>
							</div>
					        <input type="file" class="form-control1 input-lg" placeholder="File ..." name="files">
					    </div>

						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">Start Date</label>
						    <input type="text" id="start_date" class="form-control1" name="start_date" value="<?php echo date('d/m/Y', strtotime($project->start_date))?>">
						</div>

						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">End Date</label>
						    <input type="text" id="end_date" class="form-control1" name="end_date" value="<?php echo date('d/m/Y', strtotime($project->end_date))?>">
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
					