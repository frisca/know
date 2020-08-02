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
					<div class="bs-example4" data-example-id="contextual-table">
						<table class="table table-striped" style="width:100%">						 	
							<tbody>
                                <?php
                                    $no=1;
                                    if(!empty($faq)){
                                        foreach($faq as $value){
                                ?>
								<tr>
								  <td width="18"><?php echo $no;?>. </td>
								  <td colspan="3"><?php echo $value->question?></td>
								</tr>
                                <tr>
								  <td width="18"></td>
								  <td width="20">Answer</td>
                                  <td width="10">:</td>
                                  <td><?php echo $value->answer;?></td>
								</tr>
                                <?php
                                            $no++;
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
					