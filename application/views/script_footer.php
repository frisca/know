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

			// $('input[name="start_date"]').val($("#start_date").val());
			// $('input[name="end_date"]').val($("#end_date").val());
			
    		// $('#start_date').datepicker().on('changeDate', function (ev) {
			// 	$('#start_date').Close();
			// });

			// $('#start_date').change(function() {
			// 	var val = $(this).val();
			// 	$('input[name="start_date"]').val(val);
			// });

			$("#start_date").datepicker({
				changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd/mm/yy',
                showOtherMonths:true,
                selectOtherMonths: true,
				onSelect: function(dateText, datePicker) {
				$(this).attr('value', dateText);
				}
			});

    		$("#end_date").datepicker({
				changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd/mm/yy',
                showOtherMonths:true,
                selectOtherMonths: true,
				onSelect: function(dateText, datePicker) {
				$(this).attr('value', dateText);
				}
			});

    		CKEDITOR.replace('edi');
			$('[data-toggle="tooltip"]').tooltip();

			$("#project").click(function(){
				var start_date = getDate($('#start_date').val()) ;
    			var end_date = getDate($('#end_date').val());
				if(start_date >= end_date){
					alert('Start date must less than End Date');
					return false;
				}
			});

			$('.release').click(function(){
				var id = $(this).attr('projectid');
				var release = $(this).attr('release');
				$('#projectid').val(id);
				$('#release').val(release);
				$('#show_modal').modal({backdrop: 'static', keyboard: true, show: true});
			});

			// 
			$('#comments').keypress(function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					comment = $('input[name="comment"]').val();
					idUser = <?php echo $this->session->userdata('id');?>;
					idProject = $("#projectid").val();

					console.log(comment, idUser, idProject);
					if(comment != ""){
						$.post( "<?php echo base_url('comment/insertComment');?>", { comment: comment, idUser : idUser, idProject : idProject }, function(data){
							console.log('response: ', data);
							$('.subcomment').append('<div class="geser"' + 
								'style="margin-left: 100px;margin-top: -4px;">' +
								'<div class="media" style="padding-bottom: 5px;">' +
									'<div class="media-left">' +
										'<img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">' +
									'</div>' +
									'<div class="media-body">' +
										'<h4 class="media-heading title">' + data.nama + '</h4>' +
										'<p class="komen">' +
											data.comment +
										'</p>' +
										'<div class="search e_comments" id="e_comment" style="margin-top: 35px;right: 1px;width: 86%;display:none;">' +
											'<input type="hidden" value="'+data.id_comment+'" id="commentid">' +
											'<input placeholder="Write a comment" type="text" style="width: 1241px;margin-left: 28px;" id="e_comment" name="e_comment" value="'+data.comment+'">'+
										'</div>' +
										'<div style="font-size:11px;color:blue;cursor:pointer;margin-top:1px;" class="buttons">' +
											'<span class="cancel_comment" style="display:none;">Cancel</span>' +
											'<span class="edit_comment">Edit</span>&nbsp;'+
											'<span class="delete_comment" commentid="'+data.id_comment+'">Delete</span>'+
										'</div>' +
									'</div>' +
								'</div>' +
							'</div>');
						}, 'json');
					}else{
						alert("Comment tidak boleh kosong");
						return false;
					}
					$('#comments').val('');
				}
			});


			$('#search').autocomplete({
				source: "<?php echo site_url('project/get_autocomplete/?');?>",
				select: function(event, ui) {
					var url = ui.item.value;
					location.href = "<?php echo base_url('project/views');?>" + "/" + url;
				},
				open: function(event, ui) {
					$(".ui-autocomplete").css("z-index", 1000)
				}
			});

			// $('div span.edit_comment').on('click', function(event){
			// 	// alert('test');
			// 	$(this).parents('.media-body').find('.e_comments').css('display', 'inline-block');
			// 	$(this).parents('.media-body').find('.komen').css('display', 'none');
			// 	// $(this).closest('.komen').css('display', 'none');
			// 	// $(this).closest('.edit_comment').css('display', 'none');
			// 	$(this).css('display', 'none');
			// 	$(this).parents('.media-body').find('.cancel_comment').css('display', 'inline-block');
			// 	$(this).parents('.media-body').find('.delete_comment').css('display', 'none');
			// 	$("#comments").attr("disabled", true);
			// });

			$(document).on('click', 'div span.edit_comment', function(event){
				// alert('test');
				$(this).parents('.media-body').find('.e_comments').css('display', 'inline-block');
				$(this).parents('.media-body').find('.komen').css('display', 'none');
				// $(this).closest('.komen').css('display', 'none');
				// $(this).closest('.edit_comment').css('display', 'none');
				$(this).css('display', 'none');
				$(this).parents('.media-body').find('.cancel_comment').css('display', 'inline-block');
				$(this).parents('.media-body').find('.delete_comment').css('display', 'none');
				$("#comments").attr("disabled", true);
			});

			$(document).on('click', 'div span.cancel_comment', function(){
				$(this).parents('.media-body').find('.e_comments').css('display', 'none');
				$(this).parents('.media-body').find('.komen').css('display', 'inline-block');
				// $(this).closest('.komen').css('display', 'none');
				// $(this).closest('.edit_comment').css('display', 'none');
				$(this).css('display', 'none');
				$(this).parents('.media-body').find('.edit_comment').css('display', 'inline-block');
				$(this).parents('.media-body').find('.delete_comment').css('display', 'inline-block');
				$("#comments").attr("disabled", false);
			});

			$(document).on('keypress', '#e_comment', function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					comment = $('input[name="e_comment"]').val();
					idComment = $("#commentid").val();

					console.log(comment, idComment);
					if(comment != ""){
						$.post( "<?php echo base_url('comment/editComment');?>", { comment: comment, idComment : idComment }, function(data){
							console.log('response: ', data);
							// $('.subcomment').append('<div class="geser"' + 
							// 	'style="margin-left: 100px;margin-top: -4px;">' +
							// 	'<div class="media" style="padding-bottom: 5px;">' +
							// 		'<div class="media-left">' +
							// 			'<img src="<?php echo base_url('assets/images/10.jpg');?>" style="width:40px">' +
							// 		'</div>' +
							// 		'<div class="media-body">' +
							// 			'<h4 class="media-heading title">' + data.nama + '</h4>' +
							// 			'<p class="komen">' +
							// 				data.comment +
							// 			'</p>' +
							// 		'</div>' +
							// 	'</div>' +
							// '</div>');
							
							$(event.target).parents('.media-body').find('.komen').text(data.comment);
							$(event.target).parents('.media-body').find('.komen').css('display', 'inline-block');
							$('.e_comments').css('display', 'none');
							$('.edit_comment').css('display', 'inline-block');
							$('.delete_comment').css('display', 'inline-block');
							$('.cancel_comment').css('display', 'none');
							$("#comments").attr("disabled", false);
						}, 'json');
					}else{
						alert("Comment tidak boleh kosong");
						return false;
					}
					$('#e_comment').val('');
				}
			});

			$(document).on('click', 'div span.delete_comment', function(event){
				// idComment = $(this).find("#commentid").val();
				idComment = $(this).attr("commentid");
				console.log('idComment: ', idComment);
				$.post( "<?php echo base_url('comment/deleteComment');?>", { idComment : idComment }, function(data){
					console.log('data: ', data)
					if(data == true){
						$(this).parents('.geser').remove();
					}else{
						alert('Failed delete comment');
					}
					// $(this).parents('.geser').remove();
				}, 'json');
				$(this).parents('.geser').remove();
			});
		});

		function getDate(input)
		{
		 from = input.split("/");
		return new Date(from[2], from[1] - 1, from[0]);   
		}

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

		setInterval(function(){updateUpcoming()}, 1000);
		setInterval(function(){updateOngoing()}, 1000);
		setInterval(function(){updateRelease()}, 1000);
	</script>
</body>
</html>