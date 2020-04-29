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

		function updateUpcoming(){
			$.getJSON("<?php echo base_url('project/statusUpcoming');?>", function(data){
				console.log('response: ', data);
			});
		}

		function updateOngoing(){
			$.getJSON("<?php echo base_url('project/statusOngoing');?>", function(data){
				console.log('response: ', data);
			});
		}

		function updateRelease(){
			$.getJSON("<?php echo base_url('project/statusRelease');?>", function(data){
				console.log('response: ', data);
			});
		}

		// setInterval(function(){updateUpcoming()}, 1000);
		// setInterval(function(){updateOngoing()}, 1000);
		// setInterval(function(){updateRelease()}, 1000);
	</script>
</body>
</html>