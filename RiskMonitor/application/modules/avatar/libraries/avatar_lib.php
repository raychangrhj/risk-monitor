<?php  
class Avatar_lib
{
	function __construct()
	{		
		$this->ci=&get_instance();
		$this->ci->load->model('profile/user_model');
	}

	public function pdf_uploaded()
	{
		$admin_id=$this->get_admin_id();
		$current_credits=$this->get_credits_of_admin();
		$updated_data=array('credits' => $current_credits - 1);
		$this->ci->user_model->update_user($admin_id, $updated_data);
	}
	
	public function validate_uploading()
	{
		$current_credits=$this->get_credits_of_admin();
		return $current_credits>0;
	}
	
	public function get_admin_id()
	{
		$admin_id=$this->ci->session->userdata('user_id');
		if($this->ci->session->userdata('user_type')!=$this->ci->config->item('user_level_admin'))
		{
			$admin_id=$this->ci->user_model->get_user_by_id($admin_id)->admin_id;
		}
		return $admin_id;
	}
	
	public function get_credits_of_admin()
	{
		return $this->ci->user_model->get_user_by_id($this->get_admin_id())->credits;
	}
	
	public function delete_file($file_name)
	{
		$this->ci->load->helper('file');
		unlink(dirname($_SERVER['SCRIPT_FILENAME']) . '/uploads/' . $file_name);
	}
}
