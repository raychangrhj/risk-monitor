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
	
	public function get_designation_id($designation_name)
	{
		$this->db->select('designation_id');
		$this->db->where('designation_name',$designation_name);
		$query=$this->db->get('designation');	
		$ret = $query->row();
		return $ret;
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
	/*public function get_treename_by_userid($user_id)
	{
		$this->db->select('tree.tree_name');
		$this->db->from('user');
		$this->db->join('tree', 'tree.tree_id = user.tree_id', 'left');
		$this->db->where('user.user_id', $user_id);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->tree_name;

	}*/	
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
	public function update_tree_data($data,$tree_id)
	{
		
		
	//	echo $tree_id; exit;
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
	
	
	/*public function get_designations()
	{
		$this->db->select('*');
		$query = $this->db->get('designation');	
		return $query->result_array();
	}*/
	public function get_avatar()
	{
		$this->db->select('*');
		$query = $this->db->get('avatar');	
		return $query->result_array();
	}
	
	
	public function insert_record($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();		
	}
	public function all_record($table,$colum)
	{
		$this->db->select('*');
		$this->db->where($colum, 0);
		$query = $this->db->get($table);	
		return $query->result_array();		
	}
	public function delete_record($table,$data,$colum,$id)
	{
		$this->db->where($colum, $id);
		$this->db->update($table,$data); 
		return $this->db->affected_rows();		
	}
	public function single_record($table,$colum,$id)
	{
		$this->db->where($colum, $id);
		$query = $this->db->get($table);	
		return $query->row();		
	}
	public function update_record($table,$colum,$id,$data)
	{
		$this->db->where($colum, $id);
		$this->db->update($table,$data); 
		return $this->db->affected_rows();		
	}
	
}

?>