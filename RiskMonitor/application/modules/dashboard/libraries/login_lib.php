<?php 
class login_lib {

	public function validate_login($user,$password)
	{	
		$this->ci =& get_instance();
		$this->ci->load->model('login/login_model');
		$result=$this->ci->login_model->get_login($user,$password);

		if(count($result)>0)		
			{	
				$array=array(
				'user_id'=>$result->userid,
				'username'=>$result->username,
				'type'=>$result->type,
				'logged_in'=>true
			);
			$this->ci->session->set_userdata($array);
			return true;
			}
			else
			{			
				return false;			
			}
		
	}
	
}

