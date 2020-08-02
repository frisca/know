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
				<h3 class="blank1">View Data Project</h3>
				<div class="panel-body panel-body-inputin">
					<table  class="table table-striped table-bordered" style="width:100%">
						<tbody>
							<tr>
								<th>Product</th>
								<td>
									<?php
										foreach ($product as $key => $value) {
											if($project->id_product == $value->id_product){
												echo $value->nama_product;
											}
										}
									?>
								</td>
							</tr>
							<tr>
								<th>Title</th>
								<td><?php echo $project->nama_project;?></td>
							</tr>
							<tr>
								<th>Description</th>
								<td>
									<?php echo $project->description;?>
									<br>
									<a href="<?php echo base_url('project/download/'.$project->id_project);?>">
										<?php echo $project->files;?>
									</a>
								</td>
							</tr>
							<tr>
								<th>Linked To</th>
								<td>
									<?php
										if(!empty($projects)){
											foreach($projects as $values){
												if($values->id_project == $project->linked_to){
									?>
												
												<a href="<?php echo base_url('project/views/' . $values->id_project);?>"><?php echo $values->nama_project;?></a>
									<?php
												}
											}
										}
									?>
								</td>
							</tr>
							<tr>
								<th>Start Date</th>
								<td><?php echo date('d/m/Y', strtotime($project->start_date))?></td>
							</tr>
							<tr>
								<th>End Date</th>
								<td><?php echo date('d/m/Y', strtotime($project->end_date))?></td>
							</tr>
						</tbody>
					</table>
					<a href="<?php echo base_url('project/index');?>">
				   		<button class="btn-default btn" type="button" style="padding: 9.5px 12px;">Cancel</button>
				   	</a>
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
					