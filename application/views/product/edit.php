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
				<h3 class="blank1">Edit Data Product</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" class="form-horizontal" method="post" action="<?php echo base_url('product/processEdit');?>">
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
						
						<input type="hidden" class="form-control1" id="inputWarning1" name="id" value="<?php echo $product->id_product?>">
						<div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Nama</label>
					        <input type="text" class="form-control1" id="inputWarning1" name="nama" value="<?php echo $product->nama_product?>">
					    </div>
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Deskripsi</label>
					        <textarea class="form-control1" name="description" rows="25" cols="25" required><?php echo $product->description?></textarea>
					    </div>
					    <button class="btn-success btn" type="submit">Save</button>
					    <a href="<?php echo base_url('product/index');?>">
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
					