<?php 
class Transaction_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
	
	public function add_transaction($data)
	{
		$this->db->insert('transaction_credit', $data);
		return $this->db->insert_id();
	}
	
	public function get_transaction_history_list($super_admin_id)
	{
		$this->db->select('*');
		$this->db->where('super_admin_id', $super_admin_id);
		return $this->db->get('transaction_credit')->result();
	}
}
