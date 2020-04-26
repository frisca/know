<?php $this->load->view('script_header');?>   
<section>
	<!-- menu start-->
	<?php $this->load->view('menu');?>
	<!-- menu end-->

	<!-- main content start-->
	<div class="main-content">
		<?php echo $this->load->view('header');?>
		<div id="page-wrapper">
			<div class="row">	
			   	<div class="col-md-12">
					<div class="cardbox shadow-lg bg-white" style="box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;    background-color: #fff!important;">
						<div class="cardbox-heading" style="border-bottom: 2px solid #f4f4f4;">
						  	<!-- START dropdown-->
						  	<div class="dropdown float-right">
							   	<button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown" aria-expanded="false">
									<em class="fa fa-ellipsis-h"></em>
							   	</button>
						   		<div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
								<a class="dropdown-item" href="#">Edit Post</a>
						   	</div>
						  	</div><!--/ dropdown -->
						  	<div class="media m-0" style="margin: 0!important;">
						   		<div class="d-flex mr-3">
									<a href="">
										<img class="img-fluid rounded-circle" src="<?php echo base_url('assets/images/10.jpg');?>" alt="User">
									</a>
						   		</div>
						   		<div class="media-body">
						    		<p class="m-0"><?php echo $project->nama;?></p>
									<small><span><i class="icon ion-md-pin"></i> <?php echo $project->email;?></span></small>
						   		</div>
						  	</div><!--/ media -->
						</div><!--/ cardbox-heading -->
						<div class="cardbox-item" style="padding: 15px 50px 25px 17px;border-bottom: 2px solid #f4f4f4;">
						  <div><?php echo $project->description;?></div>
						</div>
						<div class="cardbox-base">
							<ul>
							   <li><a><i class="fa fa-comments"></i></a></li>
							   <li><a><em class="mr-5"><?php echo $count;?></em></a></li>
						  	</ul>			   
						</div>
						<div class="cardbox-comments">
						  	<span class="comment-avatar float-left" style="width: 5%;">
						   		<a href=""><img class="rounded-circle" src="<?php echo base_url('assets/images/10.jpg');?>"></a>                            
						  	</span>
						  	<div class="search">
						   		<input placeholder="Write a comment" type="text" style="width: 1308px;" id="comments" name="comment">
						  	</div><!--/. Search -->
						</div>
						<div class="subcomment">
							<?php 
								foreach($comment as $key=>$value){
							?>
								<div class="geser" style="margin-left: 100px;margin-top: -4px;">
								 	<div class="media" style="padding-bottom: 5px;">
									    <div class="media-left">
									      <img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">
									    </div>
									    <div class="media-body">
									      <h4 class="media-heading title"><?php echo $value->username;?></h4>
									      <p class="komen">
									          <?php echo $value->comment;?>
									      </p>
									    </div>
									</div>
								</div>
							<?php
								}
							?>
						</div>
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