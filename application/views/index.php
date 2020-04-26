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
				<div class="col_1">
					<?php
						foreach ($product as $key => $value) {
					?>
						<div class="col-md-3 span_9" style="margin-top: 30px;">
							<div class="activity_box activity_box1" style="min-height: 120px;">
								<a href="<?php echo base_url("project/detail/" . $value->id_product);?>">
									<h3 style="text-align: center;background: lightseagreen;"><?php echo $value->nama_product?></h3>
								</a>
								<div style="text-align: justify;margin: 10px 10px 10px 10px;"><?php echo $value->description?></div>
							</div>
						</div>
					<?php
						}
					?>
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