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
						  	<div>
						  		<a href="<?php echo base_url('project/download/'.$project->id_project);?>">
									<?php echo $project->files;?>
								</a>
							</div>
							<br>
							<?php
								if(!empty($projects)){
									foreach($projects as $values){
										if($values->id_project == $project->linked_to){
							?>
							<div>
								<span>
									Project Linked to :
									<a href="<?php echo base_url('project/views/' . $values->id_project);?>"><?php echo $values->nama_project;?></a>
								</span>
							</div>
							<?php
										}
									}
								}
							?>
						</div>
						<div class="cardbox-base">
							<ul>
							   <li><a><i class="fa fa-comments"></i></a></li>
							   <li><a><em class="mr-5"><?php echo $count;?></em></a></li>
						  	</ul>			   
						</div>
						<?php 
						  if($this->session->userdata('role') != 1){
						?>
						<div class="cardbox-comments">
						  	<span class="comment-avatar float-left" style="width: 4%;">
						   		<a href=""><img class="rounded-circle" src="<?php echo base_url('assets/images/10.jpg');?>"></a>                            
						  	</span>
						  	<div class="search">
                                <input type="hidden" value="<?php echo $project->id_project;?>" id="projectid">
						   		<input placeholder="Write a comment" type="text" style="width: 1313px;" id="comments" name="comment">
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
									      <h4 class="media-heading title"><?php echo $value->nama;?></h4>
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
						<?php
							}else{
						?>
						<div class="subcomment" style="margin-top: 20px;margin-left: -64px;">
							<?php 
								foreach($comment as $key=>$value){
							?>
								<div class="geser" style="margin-left: 100px;margin-top: -4px;">
								 	<div class="media" style="padding-bottom: 5px;">
									    <div class="media-left">
									      <img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">
									    </div>
									    <div class="media-body">
									      <h4 class="media-heading title"><?php echo $value->nama;?></h4>
									      <p class="komen">
									          <?php echo $value->comment;?>
									      </p>
										  <div class="search e_comments" id="e_comment" style="margin-top: 35px;right: 1px;width: 86%;display:none;">
												<input type="hidden" value="<?php echo $value->id_comment;?>" id="commentid">
												<input placeholder="Write a comment" type="text" style="width: 1241px;margin-left: 28px;" id="e_comment" name="e_comment"
												value="<?php echo $value->comment;?>">
											</div><!--/. Search -->
											<?php
												if($value->id_user == $this->session->userdata('id')){
											?>
											<div style="font-size:11px;color:blue;cursor:pointer;margin-top:1px;" class="buttons">
										    	<span class="cancel_comment" style="display:none;">Cancel</span>
										  		<span class="edit_comment">Edit</span>&nbsp;
												<span class="delete_comment" commentid="<?php echo $value->id_comment;?>">Delete</span>
											</div>
											<?php
												}
											?>
									    </div>
									</div>
								</div>
							<?php
								}
							?>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
            <a href="<?php echo base_url('release/lists/' . $project->release);?>">
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