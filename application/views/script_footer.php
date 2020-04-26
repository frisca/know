	<script src="<?php echo base_url('assets/js/jquery.nicescroll.js');?>"></script>
	<script src="<?php echo base_url('assets/js/scripts.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    		$('#example').DataTable();
    		$( "#start_date" ).datepicker({dateFormat: 'dd/mm/yy'});
    		$( "#end_date" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
    		CKEDITOR.replace('edi');
    		$('#comments').keypress(function(event){
			    var keycode = (event.keyCode ? event.keyCode : event.which);
			    if(keycode == '13'){
			  //       $('.subcomment').prepend('<div class="geser"' + 
			  //       	'style="margin-left: 100px;margin-top: -4px;">' +
					//  	'<div class="media" style="padding-bottom: 5px;">' +
					// 	    '<div class="media-left">' +
					// 	      '<img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">' +
					// 	    '</div>' +
					// 	    '<div class="media-body">' +
					// 	      '<h4 class="media-heading title"><?php echo $this->session->userdata('username');?></h4>' +
					// 	      '<p class="komen">' +
					// 	          $(this).val() +
					// 	      '</p>' +
					// 	    '</div>' +
					// 	'</div>' +
					// '</div>'); 
					comment = $('input[name="comment"]').val();
                	idUser = <?php echo $this->session->userdata('id');?>;
                	idProject = <?php echo $project->id_project;?>;

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
						// $.ajax(
			   //              {
			   //                  type:"post",
			   //                  url: "<?php echo base_url('project/insertComment');?>",
			   //                  data: { 
			   //                  	comment: comment, 
			   //                  	idUser : idUser,
			   //                  	idProject : idProject
			   //                  },
			   //                  dataType : "json",
			   //                  success:function(response)
			   //                  {
			   //                  	// console.log(response);
			   //                   //    if(response == 20){
			   //                      	$('.subcomment').prepend('<div class="geser"' + 
						// 		        	'style="margin-left: 100px;margin-top: -4px;">' +
						// 				 	'<div class="media" style="padding-bottom: 5px;">' +
						// 					    '<div class="media-left">' +
						// 					      '<img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">' +
						// 					    '</div>' +
						// 					    '<div class="media-body">' +
						// 					      '<h4 class="media-heading title"><?php echo $this->session->userdata('username');?></h4>' +
						// 					      '<p class="komen">' +
						// 					          $(this).val() +
						// 					      '</p>' +
						// 					    '</div>' +
						// 					'</div>' +
						// 				'</div>'); 
			   //                      // }
			   //                  }
			   //              }
			   //          );
			        }else{
			        	alert("Comment tidak boleh kosong");
			        	return false;
			        }
			    }
			});
		});
	</script>
</body>
</html>