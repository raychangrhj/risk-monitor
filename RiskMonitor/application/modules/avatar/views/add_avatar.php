<?php 
$this->load->view('common/header');
$this->load->view('common/sidebar');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Avatar Type</h1>
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
				<span id='pdf_uploading_error' error_message="<?php echo $this->session->flashdata('error_msg'); ?>" />
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					Please fill in the following Fields to add Avatart to the system.
				</div>
				<div class="panel-body">
					<form role="form" enctype="multipart/form-data" method="post" id="validation_form" action="<?php echo base_url(); ?><?php echo $this->config->item('avatar_path'); ?>submit_avatar">
						<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
						<input type='hidden' name='user_id' id='user_id' value='0' />
						<div class="row">
							<div class="col-lg-9" style="float:none; margin:0 auto;">
								<div class="row">
									<div class="col-lg-12">
										<fieldset>
											<legend><span>A</span>vatar</legend>
											<?php
												$user_id=$this->session->userdata('user_id');
												if(strcmp($this->session->userdata('user_type'), $this->config->item('user_level_admin'))==0)
												{
													$company_list=$this->user_model->get_company_list_by_admin_id($user_id, $this->config->item('user_level_user'));
												}
												else
												{
													$company_list=$this->user_model->get_company_list_by_sub_admin_id($user_id, $this->config->item('user_level_user'));
												}
											?>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group col-lg-3"><label>Company Name</label></div>
													<div class="form-group col-lg-6">
														<select class='form-control' id='company_list' style='width:200px' name='company_id'>
														<?php
														for($i=0;$i<count($company_list);$i++){
															echo '<option value=' . $company_list[$i]->id . '>' . $company_list[$i]->company_name . '</option>';
														}
														?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group col-lg-3"><label>VAT</label></div>
													<div class="form-group col-lg-6">
														<input type="text" class="form-control" id='vat' name='vat' />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group col-lg-3"><label>Avatar Name</label></div>
													<div class="form-group col-lg-6">
														<input class="form-control" type="text"  data-validation="required" data-validation-error-msg="Avatar Name field is required." name="avatar_name" value="<?php echo set_value('avatar_name');?>" />
														<div class="help-block form-error"><?php echo form_error('avatar_name'); ?></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group col-lg-3"><label>Avatar File</label></div>
													<div class="form-group col-lg-6">
														<input class="input-xlarge"  type="file" data-validation="required" data-validation-error-msg="Please select an Image." name="avatar_file" />
														<div class="help-block form-error"><?php echo form_error('avatar_file'); ?></div>
													</div>
												</div>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-12">
											<div class="text-center">
												<input type="submit" value="SAVE" class="btn btn-default" />
												<input type="submit" value="CANCEL" class="btn btn-default" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('common/footer');
?>
