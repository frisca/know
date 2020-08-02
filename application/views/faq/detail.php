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
				<h3 class="blank1">Lihat Data FAQ</h3>
				<div class="panel-body panel-body-inputin">
					<form role="form" class="form-horizontal">
					    <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Question</label>
					        <textarea cols="80" id="edi" name="question" rows="10" required
                            disabled><?php echo $faq->question;?></textarea>
					    </div>
                        <div class="form-group has-warning">
					        <label class="control-label" for="inputWarning1">Answer</label>
					        <textarea cols="80" id="edi2" name="answer" rows="10" required
                            disabled><?php echo $faq->answer;?></textarea>
					    </div>
					    <a href="<?php echo base_url('faq/index');?>">
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
					