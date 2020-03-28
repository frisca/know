<div class="left-side sticky-left-side">
	<div class="logo">
		<h1><a href="index.html">Knowledge</a></h1>
	</div>
	<div class="logo-icon text-center">
		<a href="<?php echo base_url('home/index');?>"><i class="lnr lnr-home"></i> </a>
	</div>
	<div class="left-side-inner">
		<ul class="nav nav-pills nav-stacked custom-nav">
			<li><a href="<?php echo base_url('user/index')?>"><i class="lnr lnr-magnifier"></i> <span>Search</span></a></li>
		<?php if($this->session->userdata('role') == 1){?>
			<li><a href="<?php echo base_url('user/index')?>"><i class="lnr lnr-users"></i> <span>User</span></a></li>
		<?php }else if($this->session->userdata('role') == 2){?>
			<li><a href="<?php echo base_url('product/index')?>"><i class="lnr lnr-book"></i> <span>Product</span></a></li>
			<li><a href="<?php echo base_url('project/index')?>"><i class="lnr lnr-plus-circle"></i> <span>Project</span></a></li>
		<?php }else{ ?>
			<li><a href="<?php echo base_url('project/index')?>"><i class="lnr lnr-plus-circle"></i> <span>Project</span></a></li>
		<?php } ?>
		</ul>
	</div>
</div>