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
				<h3 class="blank1">FAQ</h3>
				<div class="xs tabls">
					<a href="<?php echo base_url('faq/add')?>">
						<?php if($this->session->userdata('role') == 2){ ?>
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
								  <th>Question</th>
								  <th>Answer</th>
								  <th>Action</th>
								</tr>
						  	</thead>
							<tbody>
								<?php 
									if(!empty($faq)){
										foreach ($faq as $key => $value) {
								?>
								<tr>
									<td><?php echo $value->question;?></td>
									<td><?php echo $value->answer;?></td>
									<td>
										<?php if($this->session->userdata('role') != 3){?>
										<a href="<?php echo base_url('faq/edit/' . $value->id_faq)?>">
											<button class="btn btn-warning" type="button" title="Edit">
												<i class="lnr lnr-pencil"></i>
											</button>
										</a>
										<a href="<?php echo base_url('faq/delete/' . $value->id_faq)?>">
											<button class="btn btn-danger" type="button" style="padding: 8.5px 12px;" 
											title="Delete">
												<i class="lnr lnr-trash"></i>
											</button>
										</a>
										<?php } ?>
										<a href="<?php echo base_url('faq/detail/' . $value->id_faq)?>">
											<button class="btn btn-info" type="button" title="View">
												<i class="lnr lnr-eye"></i>
											</button>
										</a>
									</td>
								</tr>
								<?php
										}
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
					