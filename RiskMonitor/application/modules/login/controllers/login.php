<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->library('profile/profile_lib');
		if(!$this->session->userdata('redirect_url'))
		{
			$newdata = array(
				'redirect_url'  => 'dashboard/',
			);
			$this->session->set_userdata($newdata);
		}
		if($this->session->userdata('logged_in'))
		{
			redirect(base_url().'dashboard/');
		}
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function login_verify()
	{
		$user_name=$this->input->post('user_name');
		$password=$this->input->post('password');
		$this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[4]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$status = $this->profile_lib->validate_user($user_name, $password);
			if($status == true)
			{
				if($this->session->userdata('redirect_url')){
					$url = $this->session->userdata('redirect_url');
					$this->session->unset_userdata('redirect_url');
					redirect(base_url() . $url);
				}
				else{
					redirect(base_url() . 'dashboard/');
				}
			}
			else if($status == 0)
			{
				$this->session->set_flashdata('user_name', $this->input->post('user_name'));
				$this->session->set_flashdata('login_error', $this->config->item('login_inactive'));
				redirect(base_url() . $this->config->item('login_path') . 'login');
			}
			else
			{
				$this->session->set_flashdata('user_name', $this->input->post('user_name'));
				$this->session->set_flashdata('login_error', $this->config->item('login_invalid_username_password'));
				redirect(base_url() . $this->config->item('login_path') . 'login');
			}
		}
	}
}
