<?php 
class common_lib {
	function __construct()
	{		
		$this->ci =& get_instance();
		$this->ci->load->model('common/common_model');
		
	}
	public function add_billinginfo_data($data)
	{
		$billing_id = $this->ci->common_model->add_billinginfo_data($data);
		return $billing_id;
	}
	public function add_tree_data($data)
	{
		$tree_id = $this->ci->common_model->add_tree_data($data);
		return $tree_id;
	}
	public function get_treename_by_userid($user_id)
	{
		$tree_name = $this->ci->common_model->get_treename_by_userid($user_id);
		return $tree_name;
	}
	public function update_tree_data($data,$tree_id)
	{
		$tree_id = $this->ci->common_model->update_tree_data($data,$tree_id);
		return $tree_id;
	}
	public function add_user_data($data, $password)
	{
		$user_id = $this->ci->common_model->add_user_data($data,$password);
		return $user_id;
	}
	public function update_user_data($data, $user_id)
	{
		$user_id = $this->ci->common_model->update_user_data($data,$user_id);
		return $user_id;
	}
	
	public function set_user_pincode($user_id, $pincode)
	{
		$result = $this->ci->common_model->set_user_pincode($user_id, $pincode);
		return $result;
	}
	public function check_email_exist($email,$level_id,$user_id = 0)
	{
		$result = $this->ci->common_model->check_email_exist($email,$level_id,$user_id);
		return $result;
	}
	public function get_payments()
	{
		$result = $this->ci->common_model->get_payments();
		return $result;
	}
	public function get_fleet_sizes()
	{
		$result = $this->ci->common_model->get_fleet_sizes();
		return $result;
	}
	public function get_cities()
	{
		$result = $this->ci->common_model->get_cities();
		return $result;
	}
	public function get_countries()
	{
		$result = $this->ci->common_model->get_countries();
		return $result;
	}
	public function get_designation_id($designation_name)
	{
		$result = $this->ci->common_model->get_designation_id($designation_name);
		return $result;
	}
	public function validate_password($password)
	{
		$check_letter = preg_match("/[a-z]/", $password, $matchletter);
		$erro = '';
		if($check_letter == 0){
			$erro .= 'letter, ';	
		}
		$check_capital_letter = preg_match("/[A-Z]/", $password, $matchcapital);
		if($check_capital_letter == 0){
			$erro .= 'Capital Letter, ';	
		}
		$check_number = preg_match("/[0-9]/", $password, $matchesnum);
		if($check_number == 0){
			$erro .= 'Number';	
		}
		if($check_letter == 0 || $check_capital_letter == 0 || $check_number == 0){
			return $erro;
			//exit;
		}
		else{
			return false;
		}
	}
	function random_primary_id()
	{
		$character_set_array = array();
		$character_set_array[] = array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
		$character_set_array[] = array('count' => 1, 'characters' => '-');
		$character_set_array[] = array('count' => 3, 'characters' => '0123456789');
		
		$temp_array = array();
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		//shuffle($temp_array);
		return implode('', $temp_array);
	}
	public function check_primary_id($id)
	{
		$result = $this->ci->common_model->get_primary_id($id);
		return $result;
	}
	public function insert_primary_id($id)
	{
		$result = $this->ci->common_model->insert_primary_id($id);
		return $result;
	}
	function random_general_id()
	{
		$character_set_array = array();
		$character_set_array[] = array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
		$character_set_array[] = array('count' => 4, 'characters' => '0123456789');
		//$character_set_array[] = array('count' => 2, 'characters' => '!@#$?');
		$temp_array = array();
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		//shuffle($temp_array);
		return implode('', $temp_array);
	}
	function random_pass()
	{
		$character_set_array = array();
		$character_set_array[] = array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
		$character_set_array[] = array('count' => 2, 'characters' => '0123456789');
		$character_set_array[] = array('count' => 2, 'characters' => '!@#$?}');
		$temp_array = array();
		foreach ($character_set_array as $character_set) {
			for ($i = 0; $i < $character_set['count']; $i++) {
				$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
			}
		}
		shuffle($temp_array);
		return implode('', $temp_array);
	}
}

