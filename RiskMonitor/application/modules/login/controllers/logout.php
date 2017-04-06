<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();			
	}
	
	public function index()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('company_id');
		$this->session->unset_userdata('logged_in');
		redirect(base_url() . $this->config->item('login_path') . 'login');
	}
}
