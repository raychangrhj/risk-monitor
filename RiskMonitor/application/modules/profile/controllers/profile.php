<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('avatar/avatar_lib');
		$this->load->model('profile/user_model');
		$this->load->model('profile/transaction_model');
	}
	
	public function index()
	{
	}
	
	public function view_profile()
	{
		switch ($this->session->userdata('user_type'))
		{
			case $this->config->item('user_level_amb'):
				redirect(base_url() . $this->config->item('amb_path') . 'view_profile');
				break;
			case $this->config->item('user_level_super_admin'):
				redirect(base_url() . $this->config->item('super_admin_path') . 'view_profile');
				break;
			case $this->config->item('user_level_admin'):
				redirect(base_url() . $this->config->item('admin_path') . 'view_profile');
				break;
			case $this->config->item('user_level_sub_admin'):
				redirect(base_url() . $this->config->item('sub_admin_path') . 'view_profile');
				break;
			case $this->config->item('user_level_user'):
				redirect(base_url() . $this->config->item('user_path') . 'view_profile');
				break;
			default:
				redirect(base_url() . $this->config->item('dashboard_path'));
		}
	}
	
	public function get_company_list()
	{
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->input->post('user_type');
		$profile_access_type=$this->session->userdata('profile_access_type');
		
		if(strcmp($profile_access_type, $this->config->item('profile_self_set'))==0 || strcmp($profile_access_type, $this->config->item('profile_other_set'))==0)
		{
			$company_list=$this->user_model->get_company_list_by_user_id($this->session->userdata('profile_setting_user_id'));
		}
		else
		{
			if(strcmp($this->session->userdata('user_type'), $this->config->item('user_level_admin'))==0)
			{
				$company_list=$this->user_model->get_company_list_by_admin_id($user_id, $user_type);
			}
			else
			{
				$company_list=$this->user_model->get_company_list_by_sub_admin_id($user_id, $user_type);
			}
		}
		$company_list_string='';
		for($i=0;$i<count($company_list);$i++)
		{
			$company_list_string .= '@@' . $company_list[$i]->id . '##' . $company_list[$i]->company_name;
		}
		echo $company_list_string;
	}
	
	public function get_company_info()
	{
		$empty_company=new stdClass();
		$empty_company->address='';
		$empty_company->vat='';
		$empty_company->zip_code='';
		$empty_company->website='';
		
		$company_id=$this->input->post('company_id');
		if($company_id=='null')
		{
			$company=$empty_company;
		}
		else
		{
			$company_list=$this->user_model->get_company_list_by_id($company_id);
			if(count($company_list)>0)
			{
				$company=$company_list[0];
			}
			else
			{
				$company=$empty_company;
			}
		}
		echo $company->address . '##' . $company->vat . '##' . $company->zip_code . '##' . $company->website;
	}
	
	public function add_company()
	{
		$company_data = array(
			'admin_id' => $this->avatar_lib->get_admin_id(),
			'sub_admin_id' => $this->session->userdata('user_id'),
			'company_type' => $this->input->post('company_type'),
			'company_name' => $this->input->post('company_name'),
			'address' => $this->input->post('address'),
			'vat' => $this->input->post('vat'),
			'zip_code' => $this->input->post('zip_code'),
			'website' => $this->input->post('website')
		);
		$this->user_model->add_company($company_data);
	}
	
	public function update_company()
	{
		$company_data = array(
			'company_name' => $this->input->post('company_name'),
			'address' => $this->input->post('address'),
			'vat' => $this->input->post('vat'),
			'zip_code' => $this->input->post('zip_code'),
			'website' => $this->input->post('website')
		);
		$this->user_model->update_company($this->input->post('company_id'), $company_data);
	}
	
	public function delete_company()
	{
		$this->user_model->delete_company($this->input->post('company_id'));
	}
	
	public function submit_profile()
 	{
		$profile_data = array(
			'user_type' => $this->input->post('user_type'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'user_name' => $this->input->post('user_name'),
			'password' => md5($this->input->post('password')),
			'company_id' => $this->input->post('company_id'),
			//'address' => $this->input->post('address'),
			//'vat' => $this->input->post('vat'),
			//'zip_code' => $this->input->post('zip_code'),
			'phone_number' => $this->input->post('phone_number'),
			'email' => $this->input->post('email')//,
			//'website' => $this->input->post('website')
		);
		/*if($this->session->userdata('user_type')==$this->config->item('user_level_super_admin') && $this->session->userdata('profile_setting_user_type')==$this->config->item('user_level_admin'))
		{
			$profile_data['credits']=$this->input->post('credits');
		}*/
		$this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[4]|max_length[20]|xss_clean');
		/*$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]|xss_clean|callback_check_validation');
		$this->form_validation->set_rules('confirm_password', 'Confirm Passoword', 'required|matches[password]|min_length[8]|max_length[15]|xss_clean');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email|max_length[100]|xss_clean|callback_email_exists['.$user_id.']');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9().-]+$/]|min_length[4]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'required|max_length[100]|xss_clean');*/
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error_msg', $this->config->item('profile_validation_error'));
		}
		else if($profile_data['password'] != md5($this->input->post('confirm_password')))
		{
			$this->session->set_flashdata('error_msg', $this->config->item('profile_confirm_password_error'));
		}
		else
		{
			if($this->session->userdata('profile_access_type') == $this->config->item('profile_self_set'))
			{
				$this->user_model->update_user($this->session->userdata('profile_setting_user_id'), $profile_data);
			}
			else if($this->session->userdata('profile_access_type') == $this->config->item('profile_other_add'))
			{
				$profile_data['admin_id']=$this->avatar_lib->get_admin_id();
				$profile_data['sub_admin_id']=$this->session->userdata('user_id');
				$profile_data['company_name']=$this->user_model->get_company_name($profile_data['company_id']);
				$profile_id = $this->user_model->add_user($profile_data);
				$this->session->set_userdata(array(
					'profile_setting_user_id' => $profile_id
				));
			}
			else if($this->session->userdata('profile_access_type') == $this->config->item('profile_other_set'))
			{
				$this->user_model->update_user($this->session->userdata('profile_setting_user_id'), $profile_data);
			}
			if($this->session->userdata('profile_setting_user_id')>0)
			{
				$this->session->set_flashdata('sucess_message', $this->config->item('profile_success'));
			}
			else{
				$this->session->set_flashdata('error_msg', $this->config->item('profile_error'));
			}
		}
		switch ($this->session->userdata('user_type'))
		{
			case $this->config->item('user_level_amb'):
				if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
				{
					redirect(base_url() . $this->config->item('amb_path') . 'view_profile');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_add'))
				{
					redirect(base_url() . $this->config->item('amb_path') . 'add_super_admin');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_set'))
				{
					redirect(base_url() . $this->config->item('amb_path') . 'user_type_changed');
				}
				break;
			case $this->config->item('user_level_super_admin'):
				if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
				{
					redirect(base_url() . $this->config->item('super_admin_path') . 'view_profile');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_add'))
				{
					redirect(base_url() . $this->config->item('super_admin_path') . 'add_admin');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_set'))
				{
					redirect(base_url() . $this->config->item('super_admin_path') . 'user_type_changed');
				}
				break;
			case $this->config->item('user_level_admin'):
				if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
				{
					redirect(base_url() . $this->config->item('admin_path') . 'view_profile');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_add'))
				{
					redirect(base_url() . $this->config->item('admin_path') . 'add_sub_admin_user');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_set'))
				{
					redirect(base_url() . $this->config->item('admin_path') . 'user_type_changed');
				}
				break;
			case $this->config->item('user_level_sub_admin'):
				if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
				{
					redirect(base_url() . $this->config->item('sub_admin_path') . 'view_profile');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_add'))
				{
					redirect(base_url() . $this->config->item('sub_admin_path') . 'add_user');
				}
				else if($this->session->userdata('profile_access_type')==$this->config->item('profile_other_set'))
				{
					redirect(base_url() . $this->config->item('sub_admin_path') . 'user_type_changed');
				}
				break;
			case $this->config->item('user_level_user'):
				if($this->session->userdata('profile_access_type')==$this->config->item('profile_self_set'))
				{
					redirect(base_url() . $this->config->item('user_path') . 'view_profile');
				}
				break;
			default:
				redirect(base_url() . $this->config->item('dashboard_path'));
		}
  	}
	
	public function update_active_status()
 	{
		$active_status=$this->input->post('active_status');
		$updated_data=array('active_status' => $active_status==1?$this->config->item('user_status_active'):$this->config->item('user_status_inactive'));
		$this->user_model->update_user($user_id=$this->input->post('user_id'), $updated_data);
  	}
	
	public function get_credits()
	{
		$user_info=$this->user_model->get_user_by_id($this->input->post('user_id'));
		echo $user_info->credits;
	}
	
	public function add_credits()
	{
		$super_admin_id=$this->session->userdata('user_id');
		$admin_id=$this->input->post('user_id');
		$admin_name=$this->user_model->get_user_by_id($admin_id)->user_name;
		$current_credits=$this->input->post('current_credits');
		$new_credits=$this->input->post('new_credits');
		
		$updated_credits_data=array('credits' => $current_credits + $new_credits);
		$this->user_model->update_user($admin_id, $updated_credits_data);
		
		$updated_transaction_data=array(
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'super_admin_id' => $super_admin_id,
			'admin_id' => $admin_id,
			'admin_name' => $admin_name,
			'credits' => $new_credits
		);
		$this->transaction_model->add_transaction($updated_transaction_data);
		
		echo $current_credits + $new_credits;
	}
	
	public function transfer_user()
	{
		$user_type=$this->session->userdata('user_type');
		$sub_admin_id=$this->session->userdata('user_id');
		$target_user_id=$this->input->post('target_user_id');
		$user_id_list = explode('#', $this->input->post('user_id_list'));
		for($i=0;$i<count($user_id_list)-1;$i++)
		{
			$updated_data=array('sub_admin_id' => $target_user_id);
			$this->user_model->update_user($user_id_list[$i], $updated_data);
			$company_id=$this->user_model->get_user_by_id($user_id_list[$i])->company_id;
			$count=$this->user_model->get_user_count_of_company($sub_admin_id, $company_id);
			if($user_type==$this->config->item('user_level_admin'))
			{
				$this->user_model->update_company($company_id, $updated_data);
			}
			if($user_type==$this->config->item('user_level_sub_admin') && $count==0)
			{
				$this->user_model->update_company($company_id, $updated_data);
			}
		}
		echo 'OK';
	}
}
