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
				if($("#start_date").val() > $("#end_date").val()){
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
							$('.subcomment').prepend('<div class="geser"' + 
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
					location.href = "<?php echo base_url('project/lists');?>" + "/" + url;
				},
				open: function(event, ui) {
					$(".ui-autocomplete").css("z-index", 1000)
				}
			})
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