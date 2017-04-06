<?php 
	$this->load->view('common/header');
	$this->load->view('common/sidebar');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Sub Admin & User</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('sucess_message')) { ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('sucess_message'); ?>
				</div>
			<?php } ?>
			<?php if($this->session->flashdata('error_msg')) { ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('error_msg'); ?>
				</div>
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading">Please fill in the following Fields to add a Admin or User to the system</div>
				<?php $this->load->view('profile/set_profile'); ?>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
