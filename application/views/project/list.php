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
				<h3 class="blank1"><?php echo $product->nama_product;?></h3>
				<div class="col_1">
					<div class="col-md-4 span_8">
						<div class="activity_box activity_box1">
							<h3>Release</h3>
							<div class="scrollbar scrollbar1" id="style-2">
								<?php
									foreach ($project as $key => $value){
										if($value->status == 2 && $value->release != 0 || $value->release != null){
								?>
								<div class="activity-row">
									<div class="col-xs-3 activity-img"><img src="<?php echo base_url('assets/images/file.png');?>" class="img-responsive" alt=""></div>
									<div class="col-xs-7 activity-desc">
										<h5>
											<a href="<?php echo base_url('product/detail/' . $product->id_product);?>"><?php echo $value->nama_product;?></a>
												- 
											<a href="<?php echo base_url('release/lists/' . $value->release);?>">Release <?php echo $value->release;?></a>
										</h5>
										<p><?php echo $product->description;?></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php
										}
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4 span_8">
						<div class="activity_box">
							<h3>Ongoing</h3>
							<div class="scrollbar scrollbar1" id="style-2">
								<?php
									foreach ($project as $key => $value){
										if($value->status == 1){
								?>
								<div class="activity-row">
									<div class="col-xs-3 activity-img"><img src="<?php echo base_url('assets/images/file.png');?>" class="img-responsive" alt=""></div>
									<div class="col-xs-7 activity-desc">
									<h5>
										<a href="<?php echo base_url('product/detail/' . $product->id_product);?>"><?php echo $value->nama_product;?></a>
											- 
										<a href="<?php echo base_url('ongoing/detail/' . $value->id_project);?>"><?php echo $value->nama_project;?></a>
									</h5>
									<p><?php echo $product->description;?></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php
										}
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-4 span_8">
						<div class="activity_box activity_box2">
							<h3>Upcoming</h3>
							<div class="scrollbar scrollbar1" id="style-2">
								<?php
									foreach ($project as $key => $value){
										if($value->status == 0 && $value->status != null){
								?>
								<div class="activity-row">
									<div class="col-xs-3 activity-img"><img src="<?php echo base_url('assets/images/file.png');?>" class="img-responsive" alt=""></div>
									<div class="col-xs-7 activity-desc">
									<h5>
										<a href="<?php echo base_url('product/detail/' . $product->id_product);?>"><?php echo $value->nama_product;?></a>
											- 
										<a href="<?php echo base_url('project/ongoing/' . $value->id_project);?>"><?php echo $value->nama_project;?></a>
									</h5>
									<p><?php echo $product->description;?></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php
										}
									}
								?>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<a href="<?php echo base_url('home/index');?>">
				   		<button class="btn-default btn" type="button" style="padding: 9.5px 12px;margin-top: 20px;">Back</button>
				   	</a>
					<div class="clearfix"> </div>
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