<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('dashboard/dashboard_model');
		if(!$this->session->userdata('logged_in'))
		{
			$newdata = array(
			   'redirect_url'  => uri_string(),
            );
			$this->session->set_userdata($newdata);
			redirect(base_url() . $this->config->item('login_path') . 'login/');
		}
	}
	public function index()
	{
		$this->load->view('dashboard');
	}	
}
