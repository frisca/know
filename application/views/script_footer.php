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
		});
	</script>
</body>
</html>