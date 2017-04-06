<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->library('common/common_lib');
		$this->load->model('profile/user_model');
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_userdata(array(
				'redirect_url'  => uri_string(),
				'editting_company_id' => -1
			));
			redirect(base_url() . $this->config->item('login_path') . 'login/');
		}
		if($this->session->userdata('user_type') != $this->config->item('user_level_user')){
			$this->session->set_flashdata('error_msg', 'You do not have permission to access');
			redirect(base_url() . $this->config->item('dashboard_path'));
		}
	}
	
	public function index()
	{
	}
	
	public function view_profile()
	{
		$this->session->set_userdata(array(
			'profile_access_type' => $this->config->item('profile_self_set'),
			'profile_setting_user_type' => $this->config->item('user_level_user'),
			'profile_setting_user_id' => $this->session->userdata('user_id')
		));
		$this->load->view('view_profile');
	}
}
