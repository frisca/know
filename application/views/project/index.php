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
				<h3 class="blank1">Project</h3>
				<div class="xs tabls">
					<a href="<?php echo base_url('project/add')?>">
						<?php if($this->session->userdata('role') != 1){ ?>
							<button class="btn btn-primary" type="button" style="float: right;margin-bottom: 20px;">Add</button>
						<?php } ?>
					</a>
					<div class="clearfix"></div>
					<?php if($this->session->flashdata('success') != ""){ ?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('success');?>
					</div>	
					<?php }else if($this->session->flashdata('error') != ""){ ?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('error');?>
					</div>	
					<?php } ?>
					<div class="bs-example4" data-example-id="contextual-table">
						<table id="example" class="table table-striped table-bordered" style="width:100%">						 	
							<thead>
								<tr>
								  <th>Title</th>
								  <th>Start Date</th>
								  <th>End Date</th>
								  <th>Status</th>
								  <th>Action</th>
								</tr>
						  	</thead>
							<tbody>
								<?php
									foreach ($project as $key => $value){
								?>
								<tr>
									<td><?php echo $value->nama_project;?></td>
									<td><?php echo date('d/m/Y', strtotime($value->start_date));?></td>
									<td><?php echo date('d/m/Y', strtotime($value->end_date));?></td>
									<td>
										<?php if($value->status == 0) { ?>
											Upcoming
										<?php }else if($value->status == 1){ ?>
											Ongoing
										<?php }else{ ?>
											Release
										<?php } ?>
									</td>
									<td>
										<?php if($value->status != 2){ ?>
										<a href="<?php echo base_url('project/edit/' . $value->id_project)?>">
											<button class="btn btn-warning" type="button" style="padding: 8.5px 12px;"
											data-toggle="tooltip" data-placement="bottom" title="Edit">
												<i class="lnr lnr-pencil"></i>
											</button>
										</a>
										<a href="<?php echo base_url('project/delete/' . $value->id_project)?>">
											<button class="btn btn-danger" type="button" style="padding: 8.5px 12px;"
											data-toggle="tooltip" data-placement="bottom" title="Delete">
												<i class="lnr lnr-trash"></i>
											</button>
										</a>
										<?php }else{ ?>
											<button class="btn btn-success release" type="button" style="padding: 9.5px 12px;"
											data-toggle="tooltip" data-placement="bottom" title="Release" 
											projectid="<?php echo $value->id_project;?>" 
											release="<?php if($value->release != 0){ echo $value->release; }else{ echo 0;} ?>">
												<i class="lnr lnr-checkmark-circle"></i>
											</button>
										<?php } ?>
										<a href="<?php echo base_url('project/views/' . $value->id_project)?>">
											<button class="btn btn-info" type="button" title="View">
												<i class="lnr lnr-eye"></i>
											</button>
										</a>
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- main content end-->

	<div id="show_modal" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Release Project</h4>
				</div>
				<form action="<?php echo base_url('project/updateRelease')?>" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="id_project" value="" id="projectid">
						<div class="form-group has-warning">
							<label class="control-label" for="inputWarning1">Release</label>
							<input type="text" class="form-control1 input-lg" placeholder="Ex: 1.0 " required name="release"
							id="release">
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- footer start -->
	<?php echo $this->load->view('footer');?>
	<!-- footer end -->
</section>
<?php $this->load->view('script_footer');?>
					