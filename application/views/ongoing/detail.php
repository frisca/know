<?php $this->load->view('script_header');?>   
<section>
	<!-- menu start-->
	<?php $this->load->view('menu');?>
	<!-- menu end-->

	<!-- main content start-->
	<div class="main-content">
		<?php echo $this->load->view('header');?>
		<div id="page-wrapper">
			<h3 class="blank1"><?php echo $project->nama_project;?></h3>
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
			<div class="row">	
			   	<div class="col-md-12">
					<div class="cardbox shadow-lg bg-white" style="box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;    background-color: #fff!important;">
						<div class="cardbox-heading" style="border-bottom: 2px solid #f4f4f4;">
						  	<!-- START dropdown-->
							<?php if($project->created_by == $this->session->userdata('id')){?>
								<div class="dropdown float-right">
									<button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown" aria-expanded="false">
										<em class="fa fa-ellipsis-h"></em>
									</button>
									<div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
										<a class="dropdown-item" href="<?php echo base_url('ongoing/edit/' . $project->id_project);?>">Edit</a>
										<a class="dropdown-item" href="<?php echo base_url('ongoing/delete/' . $project->id_project . '/' . $project->id_product);?>">Delete</a>
									</div>
								</div><!--/ dropdown -->
							<?php } ?>
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
						  	<span class="comment-avatar float-left" style="width: 4%;">
						   		<a href=""><img class="rounded-circle" src="<?php echo base_url('assets/images/10.jpg');?>"></a>                            
						  	</span>
						  	<div class="search">
						   		<input placeholder="Write a comment" type="text" style="width: 1626px;;" id="comments" name="comment">
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
            <a href="<?php echo base_url('project/lists/' . $project->id_product);?>">
                <button class="btn-default btn" type="button" style="padding: 9.5px 12px;margin-top: 20px;">Back</button>
            </a>
		</div>
	</div>
	<!-- main content end-->

	<!-- footer start -->
	<?php echo $this->load->view('footer');?>
	<!-- footer end -->
</section>
<!-- <script>
	$(document).ready({
		$('#comments').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				comment = $('input[name="comment"]').val();
				idUser = <?php echo $this->session->userdata('id');?>;
				idProject = <?php if(empty($project)){ echo 0; }else{ echo $project->id_project; }?>;

				console.log(comment, idUser, idProject);
				if(comment != ""){
					$.post( "<?php echo base_url('project/insertComment');?>", { comment: comment, idUser : idUser, idProject : idProject }, function(data){
						if(data == 20){
							$('.subcomment').prepend('<div class="geser"' + 
								'style="margin-left: 100px;margin-top: -4px;">' +
								'<div class="media" style="padding-bottom: 5px;">' +
									'<div class="media-left">' +
										'<img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">' +
									'</div>' +
									'<div class="media-body">' +
										'<h4 class="media-heading title"><?php echo $this->session->userdata('username');?></h4>' +
										'<p class="komen">' +
											$('input[name="comment"]').val() +
										'</p>' +
									'</div>' +
								'</div>' +
							'</div>');
						}
					}, 'json');
				}else{
					alert("Comment tidak boleh kosong");
					return false;
				}
			}
		});
	});
</script> -->
<?php $this->load->view('script_footer');?>