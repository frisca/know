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
					<div class="bs-example4" data-example-id="contextual-table">
						<table id="example" class="table table-striped table-bordered" style="width:100%">						 	
							<thead>
								<tr>
								  <th>Title</th>
								  <th>Start Date</th>
								  <th>End Date</th>
								</tr>
						  	</thead>
							<tbody>
								<?php
									foreach ($project as $key => $value){
								?>
								<tr>
									<td><a href="<?php echo base_url('release/detail/' . $value->id_project);?>"><?php echo $value->nama_project;?></a></td>
									<td><?php echo date('d/m/Y', strtotime($value->start_date));?></td>
									<td><?php echo date('d/m/Y', strtotime($value->end_date));?></td>
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
					