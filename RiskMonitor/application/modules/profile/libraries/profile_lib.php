<?php 
class Profile_lib
{
	function __construct()
	{		
		$this->ci=&get_instance();
		$this->ci->load->model('profile/user_model');
	}

	public function validate_user($user_name, $password)
	{
		$user_list=$this->ci->user_model->get_user($user_name, $password);
		if(count($user_list)>0)
		{
			if($user_list->active_status != $this->ci->config->item('user_status_active'))
			{
				return 0;
			}
			$this->ci->session->set_userdata(array(
				'user_id' => $user_list->id,
				'admin_id' => $user_list->admin_id,
				'user_type' => $user_list->user_type,
				'user_name' => $user_list->user_name,
				'company_id' => $user_list->company_id,
				'logged_in' => true,
				'profile_setting_user_type' => $user_list->user_type,
				'profile_setting_user_id' => $user_list->id,
				'user_list' => array()
			));
			return true;
		}
		else
		{
			return false;			
		}
	}

	public function get_user_list($user_name, $password)
	{
		$user_list=$this->ci->user_model->get_user($user_name, $password);
		if(count($user_list)>0)
		{
			if($user_list->active_status != $this->ci->config->item('user_status_active'))
			{
				return 0;
			}
			$this->ci->session->set_userdata(array(
				'user_id' => $user_list->id,
				'user_type' => $user_list->user_type,
				'user_name' => $user_list->user_name,
				'company_id' => $user_list->company_id,
				'logged_in' => true
			));
			return true;
		}
		else
		{
			return false;			
		}
	}
	
	public function get_sub_admin_name($user_id, $admin_id, $sub_admin_id)
	{
		if($admin_id==$sub_admin_id)return '';
		$sub_admin_info=$this->ci->user_model->get_user_by_id($sub_admin_id);
		return $sub_admin_info->user_name;
	}
}
