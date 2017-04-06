<?php
$profile_setting_user_id=$this->session->userdata('profile_setting_user_id');
if($profile_setting_user_id>=0)
{
	$this->load->library('profile/user_model');
	$user_info=$this->user_model->get_user_by_id($profile_setting_user_id);
	$manager_info=$this->user_model->get_user_by_id($user_info->sub_admin_id);
?>
	<div class="panel-body">
		<input type='hidden' id='base_url' value="<?php echo base_url(); ?>" />
		<form role="form" method="post" id="validation_form" action="<?php echo base_url(); ?><?php echo $this->config->item('profile_path'); ?>submit_profile">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<fieldset>
									<legend><span>U</span>ser <span>I</span>nfo</legend>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-6">
												<?php
												if($user_info->sub_admin_id>0)
												{
													echo '<label>Created Admin Name : </label>' . $manager_info->first_name . ' ' . $manager_info->last_name . '(' . $manager_info->user_type . ')';
												}
												?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>User Type<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<select class="form-control" id='user_type'  name="user_type">
													<?php
													$user_type_list=array(
														'<option value=' . $this->config->item('user_level_amb') . '>AMB User</option>',
														'<option value=' . $this->config->item('user_level_super_admin') . '>Super Admin</option>',
														'<option value=' . $this->config->item('user_level_admin') . '>Admin</option>',
														'<option value=' . $this->config->item('user_level_sub_admin') . '>Sub Admin</option>',
														'<option value=' . $this->config->item('user_level_user') . '>User</option>'
													);
													$credits_show='none';
													$credits_enable='disabled';
													if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
													{
														switch($this->session->userdata('user_type'))
														{
															case $this->config->item('user_level_amb'):
																echo $user_type_list[0];break;
															case $this->config->item('user_level_super_admin'):
																echo $user_type_list[1];break;
															case $this->config->item('user_level_admin'):
																$credits_show='yes';
																echo $user_type_list[2];break;
															case $this->config->item('user_level_sub_admin'):
																echo $user_type_list[3];break;
															case $this->config->item('user_level_user'):
																echo $user_type_list[4];break;
														}
													}
													if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_add'))
													{
														switch($this->session->userdata('user_type'))
														{
															case $this->config->item('user_level_amb'):
																echo $user_type_list[1];break;
															case $this->config->item('user_level_super_admin'):
																$credits_show='yes';
																//$credits_enable='enabled';
																echo $user_type_list[2];break;
															case $this->config->item('user_level_admin'):
																echo $user_type_list[3];
																echo $user_type_list[4];break;
															case $this->config->item('user_level_sub_admin'):
																echo $user_type_list[4];break;
														}
													}
													if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_set'))
													{
														switch($this->session->userdata('profile_setting_user_type'))
														{
															case $this->config->item('user_level_super_admin'):
																echo $user_type_list[1];break;
															case $this->config->item('user_level_admin'):
																$credits_show='yes';
																//$credits_enable='enabled';
																echo $user_type_list[2];break;
															case $this->config->item('user_level_sub_admin'):
																echo $user_type_list[3];break;
															case $this->config->item('user_level_user'):
																echo $user_type_list[4];break;
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>First Name<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input placeholder="First Name" class="form-control" name="first_name"  data-validation="required" data-validation-error-msg="First Name field is required." value="<?php echo $user_info->first_name; ?>"/>
												<div class="help-block form-error"><?php echo form_error('first_name'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Last Name<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input placeholder="Last Name" class="form-control" name="last_name"  data-validation="required" data-validation-error-msg="Last Name field is required." value="<?php echo $user_info->last_name; ?>"/>
												<div class="help-block form-error"><?php echo form_error('last_name'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>User Name<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input placeholder="User Name" class="form-control" name="user_name"  data-validation="required" data-validation-error-msg="User Name field is required." value="<?php echo $user_info->user_name; ?>"/>
												<div class="help-block form-error"><?php echo form_error('username'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Enter Password<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input type="password" class="form-control" id="password"  data-indicator="pwindicator" placeholder="Enter Password" name="password" type="password"  data-validation="required" data-validation-error-msg="Password field is required." value="" />
												<div id="pwindicator"><div class="bar"></div><div class="label"></div></div>
												<div class="help-block form-error"><?php echo form_error('password'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Confirm Password<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirm_password" type="password"  data-validation="required" data-validation-error-msg="Confirm Password field is required." value="" />
												<div class="help-block form-error"><?php echo form_error('confirm_password'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Company<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<select class='form-control' id='company_id' name='company_id'></select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Address<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<textarea class="form-control" id="address" rows="3" disabled ></textarea>
												<div class="help-block form-error"><?php echo form_error('gi_address'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>VAT<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input class="form-control" id="vat" disabled />
												<div class="help-block form-error"><?php echo form_error('vat'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Zip Code<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input class="form-control" id="zip_code" disabled />
												<div class="help-block form-error"><?php echo form_error('zip_code'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Phone Number<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input placeholder="Phone Number" class="form-control" name="phone_number"  data-validation="required number" data-validation-error-msg="Phone Number field is required.(Only Numbers)" value="<?php echo $user_info->phone_number; ?>"/>
												<div class="help-block form-error"><?php echo form_error('phone_number'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>E-Mail<span class="text-danger">*</span></label></div>
											<div class="form-group col-lg-6">
												<input placeholder="Admin E-mail" data-validation="required email" data-validation-error-msg="Email field is Rquired.Follow (test@demo.com)." id="resellermail" class="form-control" name="email" value="<?php echo $user_info->email; ?>"/>
												<i class="fa fa-spinner fa-spin email_exists_loader"></i>
												<div class="help-block form-error"><?php echo form_error('oa_email'); ?></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Web Site</label></div>
											<div class="form-group col-lg-6">
												<input class="form-control" id="website" disabled />
												<div class="help-block form-error"><?php echo form_error('website'); ?></div>
											</div>
										</div>
									</div>
									<div class="row" style="display:<?php echo $credits_show; ?>">
										<div class="col-lg-12">
											<div class="form-group col-lg-3"><label>Credits</label></div>
											<div class="form-group col-lg-6">
												<input placeholder="0" class="form-control" name="credits"  value="<?php echo $user_info->credits; ?>" <?php echo $credits_enable; ?> />
												<div class="help-block form-error"><?php echo form_error('credits'); ?></div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<input type="submit" value="Submit" class="btn btn-default" />
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php } ?>