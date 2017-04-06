<?php 
	$this->load->view('common/header');
	$this->load->view('common/sidebar');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Manage User</h1>
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
			<form role='form' method='post' action="<?php echo base_url() . $this->config->item('super_admin_path') . 'user_type_changed/'; ?>" />
				<select class="form-control" name="user_type" style="width:200px">
					<?php
					$profile_setting_user_type=$this->session->userdata('profile_setting_user_type');
					echo '<option value=' . $this->config->item('user_level_admin') . ($this->config->item('user_level_admin')==$profile_setting_user_type?' selected':'') . '>Admin</option>';
					?>
				</select>
				<input type='submit' value='Show Users'/>
				<p>
			</form>
			<div class="panel panel-default">
				<div class="panel-heading">Users are Shown Below</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<?php $this->load->view('profile/set_profile'); ?>
					</div>
					<div class="dataTable_wrapper">
						<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Company Name</th>
									<th width="120">First Name</th>
									<th width="120">Last Name</th>
									<th width="120">User Name</th>
									<th>E-Mail</th>
									<?php if($profile_setting_user_type==$this->config->item('user_level_admin')){ ?>
									<th width="150">Credits</th>
									<?php } ?>
									<th width="150">Active</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$user_list=$this->session->userdata('user_list');
								for($i=0; $i<count($user_list); $i++){
								?>
								<tr id="row-<?php echo $user_list[$i]->id; ?>">
									<td><?php echo $user_list[$i]->company_name; ?></td>
									<td><?php echo $user_list[$i]->first_name; ?></td>
									<td><?php echo $user_list[$i]->last_name; ?></td>
									<td><?php echo $user_list[$i]->user_name; ?></td>
									<td><?php echo $user_list[$i]->email; ?></td>
									<?php if($profile_setting_user_type==$this->config->item('user_level_admin')){ ?>
									<td>
										<input style='width:50px' id="credits_label_<?php echo $user_list[$i]->id; ?>" disabled value='<?php echo $user_list[$i]->credits; ?>' />
										<button type="button" class="add_credits" data-id="<?php echo $user_list[$i]->id; ?>" >+</button>
									</td>
									<?php } ?>
									<td class="right">
										<a href="<?php echo base_url() . $this->config->item('super_admin_path') . 'set_other_profile/' . $user_list[$i]->id; ?>" class="edit_btn"><i class="fa fa-pencil-square-o"></i></a>
										<input type="checkbox" class="active_inactive" data-id="<?php echo $user_list[$i]->id; ?>" data-offstyle="danger" data-onstyle="success"  <?php if($user_list[$i]->active_status == $this->config->item('user_status_active')){ echo "checked='checked'"; } ?> />
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
