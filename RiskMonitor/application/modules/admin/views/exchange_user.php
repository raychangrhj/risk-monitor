<?php
$this->load->view('common/header');
$this->load->view('common/sidebar');
$this->load->library('profile/profile_lib');
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
			<button class='transfer_button'>Transfer To Subadmin</button>
			<div class="panel-heading" style="overflow-y:scroll;">
				SubAdmin List
				<select class='form-control' id='target_user_id' removable='false' style='width:200px'>
				<?php
				echo '<option value=' . $this->session->userdata['user_id'] . '>' . $this->session->userdata['user_name'] . '</option>';
				$sub_admin_list=$this->user_model->get_user_list_by_admin_id($this->session->userdata('user_id'), $this->config->item('user_level_sub_admin'));
				for($i=0;$i<count($sub_admin_list);$i++){
					echo '<option value=' . $sub_admin_list[$i]->id . '>' . $sub_admin_list[$i]->user_name . '</option>';
				}
				?>
				</select>
			</div>
			<div class="panel-heading" style="overflow-y:scroll;">
				<table class="table table-striped table-bordered table-hover">
					User List
					<thead>
						<tr>
							<th>Company Name</th>
							<th>SubAdmin Name</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>User Name</th>
							<th>E-Mail</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$user_list=$this->user_model->get_user_list_by_admin_id($this->session->userdata('user_id'), $this->config->item('user_level_user'));
						for($i=0;$i<count($user_list);$i++){
						?>
						<tr id='table_row_<?php echo $i; ?>'>
							<td><input type='checkbox' id='check_<?php echo $i; ?>' user_id='<?php echo $user_list[$i]->id ?>' /><?php echo $user_list[$i]->company_name; ?></td>
							<td><?php echo $this->profile_lib->get_sub_admin_name($user_list[$i]->id, $user_list[$i]->admin_id, $user_list[$i]->sub_admin_id); ?></td>
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
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
