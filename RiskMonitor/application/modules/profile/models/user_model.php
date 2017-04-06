<?php 
class User_model extends CI_Model
{
	public $default_user;
	
	function __construct()
	{
		parent::__construct();
		$this->default_user=new stdClass();
		$this->default_user->admin_id='0';
		$this->default_user->sub_admin_id='0';
		$this->default_user->first_name='';
		$this->default_user->last_name='';
		$this->default_user->user_name='';
		$this->default_user->company_id='0';
		$this->default_user->address='';
		$this->default_user->vat='';
		$this->default_user->zip_code='';
		$this->default_user->phone_number='';
		$this->default_user->email='';
		$this->default_user->website='';
		$this->default_user->image='';
		$this->default_user->active_status='';
		$this->default_user->credits='0';
	}
	
	public function get_user($user_name, $password)
	{
		$this->db->select('*');
		$this->db->where('user_name', $user_name);
		$this->db->where('password', md5($password));
		return $this->db->get('user')->row();
	}
	
	public function get_user_by_id($user_id)
	{
		$this->db->select('*');
		$this->db->where('id', $user_id);
		$query=$this->db->get('user');
		$result=$query->row();
		return $result?$result:$this->default_user;
	}
	
	public function get_user_count_of_company($sub_admin_id, $company_id)
	{
		$this->db->select('*');
		$this->db->where('sub_admin_id', $sub_admin_id);
		$this->db->where('company_id', $company_id);
		return count($this->db->get('user')->result());
		
	}
	
	public function get_user_by_user_name($user_name)
	{
		$this->db->select('*');
		$this->db->where('user_name', $user_name);
		$query=$this->db->get('user');
		$result=$query->row();
		return $result?$result:$this->default_user;
	}
	
	public function get_user_list_by_user_type($user_type)
	{
		$this->db->select('*');
		$this->db->where('user_type', $user_type);
		return $this->db->get('user')->result();
	}
	
	public function get_user_list_by_admin_id($admin_id, $user_type)
	{
		$this->db->select('*');
		$this->db->where('admin_id', $admin_id);
		$this->db->where('user_type', $user_type);
		return $this->db->get('user')->result();
	}
	
	public function get_user_list_by_sub_admin_id($sub_admin_id, $user_type)
	{
		$this->db->select('*');
		$this->db->where('sub_admin_id', $sub_admin_id);
		$this->db->where('user_type', $user_type);
		return $this->db->get('user')->result();
	}
	
	public function add_user($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}
	
	public function update_user($user_id, $data)
	{
		$this->db->where('id', $user_id);
		$this->db->update('user', $data);
	}
	
	public function get_company_id($user_name)
	{
		$this->db->where('user_name', $user_name);
		$row=$this->db->get('user')->row();
		return $row?$row->company_id:0;
	}
	
	public function get_company_name($company_id)
	{
		$this->db->where('id', $company_id);
		$row=$this->db->get('company')->row();
		return $row?$row->company_name:'';
	}
	
	public function get_vat_for_company($company_id)
	{
		$this->db->where('id', $company_id);
		$row=$this->db->get('company')->row();
		return $row?$row->vat:'';
	}
	
	public function get_all_company_list()
	{
		$this->db->select('*');
		return $this->db->get('company')->result();
	}
	
	public function get_company_list_by_id($company_id)
	{
		$this->db->select('*');
		$all_company=$this->db->get('company')->result();
		if($company_id>0)
		{
			$this->db->where('id', $company_id);
			$query=$this->db->get('company');
			if($query->num_rows()>0)
			{
				return array($query->row());
			}
		}
		return $all_company;
	}
	
	public function get_company_list_by_admin_id($admin_id, $company_type)
	{
		$this->db->select('*');
		$this->db->where('admin_id', $admin_id);
		$this->db->where('company_type', $company_type);
		return $this->db->get('company')->result();
	}
	
	public function get_company_list_by_sub_admin_id($sub_admin_id, $company_type)
	{
		$this->db->select('*');
		$this->db->where('sub_admin_id', $sub_admin_id);
		$this->db->where('company_type', $company_type);
		return $this->db->get('company')->result();
	}
	
	public function get_company_list_by_user_id($user_id)
	{
		$company_id=$this->get_user_by_id($user_id)->company_id;
		return $this->get_company_list_by_id($company_id);
	}
	
	public function get_company_list_by_user_name($user_name)
	{
		$company_id=$this->get_user_by_user_name($user_name)->company_id;
		return $this->get_company_list_by_id($company_id);
	}
	
	public function add_company($data)
	{
		$this->db->insert('company', $data);
		return $this->db->insert_id();
	}
	
	public function update_company($company_id, $data)
	{
		$this->db->where('id', $company_id);
		$this->db->update('company', $data);
	}
	
	public function delete_company($company_id)
	{
		$this->db->where('id', $company_id);
		$this->db->delete('company');
	}
}
