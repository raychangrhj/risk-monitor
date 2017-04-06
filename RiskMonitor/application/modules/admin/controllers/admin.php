<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		if($this->session->userdata('user_type') != $this->config->item('user_level_admin')){
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
			'profile_setting_user_type' => $this->config->item('user_level_admin'),
			'profile_setting_user_id' => $this->session->userdata('user_id')
		));
		$this->load->view('view_profile');
	}
	
	public function add_sub_admin_user()
	{
		$this->session->set_userdata(array(
			'profile_access_type' => $this->config->item('profile_other_add'),
			'profile_setting_user_type' => $this->config->item('user_level_sub_admin'),
			'profile_setting_user_id' => 0
		));
		$this->load->view('add_sub_admin_user');
	}
	
	public function active_inactive()
	{
		$this->session->set_userdata(array(
			'profile_access_type' => $this->config->item('profile_other_set'),
			'profile_setting_user_type' => $this->config->item('user_level_sub_admin'),
			'profile_setting_user_id' => -1,
			'user_list' => array()
		));
		$this->load->view('active_inactive_sub_admin_user');
	}
	
	public function exchange_user()
	{
		$this->load->view('exchange_user');
	}
	
	public function user_type_changed()
	{
		$profile_setting_user_type=$this->input->post('user_type');
		$this->session->set_userdata(array(
			'profile_setting_user_type' => $profile_setting_user_type,
			'profile_setting_user_id' => -1,
			'user_list' => $this->user_model->get_user_list_by_admin_id($this->session->userdata('user_id'), $profile_setting_user_type)
		));
		$this->load->view('active_inactive_sub_admin_user');
	}
	
	public function set_other_profile()
	{
		$this->session->set_userdata(array(
			'profile_setting_user_id' => $this->uri->segment(3)
		));
		$this->load->view('active_inactive_sub_admin_user');
	}
	
	public function manage_company()
	{
		$user_id=$this->session->userdata('user_id');
		$sub_admin_company_list=$this->user_model->get_company_list_by_admin_id($user_id, $this->config->item('user_level_sub_admin'));
		$user_company_list=$this->user_model->get_company_list_by_admin_id($user_id, $this->config->item('user_level_user'));
		$this->session->set_userdata(array(
			'company_list' => array_merge($sub_admin_company_list, $user_company_list)
		));
		$this->load->view('manage_company');
	}
}
