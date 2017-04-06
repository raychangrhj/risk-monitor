<?php 
class common_model extends CI_Model
{
	public function get_level_id($levelname)
	{
		$this->db->select('level_id');
		$this->db->where('level_name',$levelname);
		$query=$this->db->get('levels');	
		$ret = $query->row();
		return $ret->level_id;
	}
	public function add_tree_data($data)
	{
		$this->db->insert('tree',$data);
		$tree_id = $this->db->insert_id();	
		return $tree_id;
	}
	public function add_billinginfo_data($data)
	{
		$this->db->insert('billing_info',$data);
		$billing_id = $this->db->insert_id();	
		return $billing_id;
	}
	public function get_designation_id($designation_name)
	{
		$this->db->select('designation_id');
		$this->db->where('designation_name',$designation_name);
		$query=$this->db->get('designation');	
		$ret = $query->row();
		return $ret->designation_id;
	}
	public function get_primary_id($id)
	{
		$this->db->where('auto_id', $id);
		$this->db->from('auto_ids');
		return $this->db->count_all_results();
	}
	public function add_to_db($id)
	{
		$this->db->where('auto_id', $id);
		$this->db->from('auto_ids');
		return $this->db->count_all_results();
	}
	public function get_treename_by_userid($user_id)
	{
		$this->db->select('tree.tree_name');
		$this->db->from('user');
		$this->db->join('tree', 'tree.tree_id = user.tree_id', 'left');
		$this->db->where('user.user_id', $user_id);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->tree_name;

	}	
	public function check_email_exist($email, $level_id, $user_id)
	{
		$this->db->where('email',$email);
		$this->db->where('level_id',$level_id);
		if($user_id != 0){
			$this->db->where('user_id !=',$user_id);
		}
		$this->db->from('user');	
		return $this->db->count_all_results();
	}
	public function add_user_data($data, $password)
	{
		
		$hash_pass="password('".$password."')";
		$this->db->set('password',$hash_pass,FALSE);
		$this->db->insert('user',$data);
		$user_id = $this->db->insert_id();	
		return $user_id;
	}
	public function insert_primary_id($id)
	{
		$this->db->set('auto_id',$id);
		$this->db->insert('auto_ids'); 
		return $this->db->affected_rows();	
	}
	public function set_user_pincode($user_id, $pincode)
	{
		$this->db->set('pincode',$pincode);
		$this->db->where('user_id', $user_id);
		$this->db->update('user'); 
		return $this->db->affected_rows();	
	}
	public function update_tree_data($data, $tree_id)
	{
		$this->db->where('tree_id', $tree_id);
		$this->db->update('tree',$data); 
		return $this->db->affected_rows();	
	}
	public function update_user_data($data, $user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user',$data); 
		return $this->db->affected_rows();	
	}
	public function get_payments()
	{
		$this->db->select('*');
		$query = $this->db->get('payment_info');	
		return $query->result_array();
	}
	public function get_fleet_sizes()
	{
		$this->db->select('*');
		$query = $this->db->get('fleet_sizes');	
		return $query->result_array();
	}
	public function get_cities()
	{
		$this->db->select('*');
		$query = $this->db->get('city');	
		return $query->result_array();
	}
	public function get_countries()
	{
		$this->db->select('*');
		$query = $this->db->get('country');	
		return $query->result_array();
	}
}

?>