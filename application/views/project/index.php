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
						<?php if($this->session->userdata('role') == 2){ ?>
							<button class="btn btn-primary" type="button" style="float: right;margin-bottom: 20px;">Tambah</button>
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
								  <th>Nama</th>
								  <th>Dari Tanggal</th>
								  <th>Sampai Tanggal</th>
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
									</tc>
									<td>
										<a href="<?php echo base_url('project/edit/' . $value->id_project)?>">
											<button class="btn btn-warning" type="button" style="padding: 8.5px 12px;">
												<i class="lnr lnr-pencil"></i>
											</button>
										</a>
										<a href="<?php echo base_url('project/delete/' . $value->id_project)?>">
											<button class="btn btn-danger" type="button" style="padding: 8.5px 12px;">
												<i class="lnr lnr-trash"></i>
											</button>
										</a>
										<a href="<?php echo base_url('project/confirm/' . $value->id_project)?>">
											<button class="btn btn-success" type="button" style="padding: 9.5px 12px;">
												<i class="lnr lnr-checkmark-circle"></i>
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

	<!-- footer start -->
	<?php echo $this->load->view('footer');?>
	<!-- footer end -->
</section>
<?php $this->load->view('script_footer');?>
					