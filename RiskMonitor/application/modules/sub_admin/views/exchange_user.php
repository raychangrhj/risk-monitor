<?php
$this->load->view('common/header');
$this->load->view('common/sidebar');
$this->load->model('profile/user_model');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Exchange User</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default" />
			<button class='transfer_button'>Transfer To Admin</button>
			<div class="panel-heading" style="overflow-y:scroll;">
				<table class="table table-striped table-bordered table-hover">
					User List
					<thead>
						<tr>
							<th>Company Name</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>User Name</th>
							<th>E-Mail</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$user_list=$this->user_model->get_user_list_by_sub_admin_id($this->session->userdata('user_id'), $this->config->item('user_level_user'));
						for($i=0;$i<count($user_list);$i++){
						?>
						<tr id='table_row_<?php echo $i; ?>'>
							<td><input type='checkbox' id='check_<?php echo $i; ?>' user_id='<?php echo $user_list[$i]->id ?>' /><?php echo $user_list[$i]->company_name; ?></td>
							<td><?php echo $user_list[$i]->first_name; ?></td>
							<td><?php echo $user_list[$i]->last_name; ?></td>
							<td><?php echo $user_list[$i]->user_name; ?></td>
							<td><?php echo $user_list[$i]->email; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
			<input type='hidden' id='user_count' value="<?php echo count($user_list); ?>" />
			<input type='hidden' id='target_user_id' removable='true' value="<?php echo $this->session->userdata('admin_id'); ?>" />
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
