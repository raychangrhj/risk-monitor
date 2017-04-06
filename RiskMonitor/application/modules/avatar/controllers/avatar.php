<?php
require_once "parser/parser.php";
defined('BASEPATH') OR exit('No direct script access allowed');

class Avatar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('common/common_lib');
		$this->load->library('avatar/avatar_lib');
		$this->load->model('profile/user_model');
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_userdata(array(
				'redirect_url'  => uri_string()
			));
			redirect(base_url().$this->config->item('admin_path').'login/');
		}
	}
	
	public function index()
	{
		$data['avatars'] = $this->common_lib->get_avatar();
	}
	
	public function add_avatar()
	{
		$this->load->view('add_avatar');
	}
	
	public function download_avatar()
	{
		$data["file_name"]=$this->uri->segment(3);
		$this->load->view('download_avatar', $data);
	}
	
	public function view_avatar()
	{
		$data["file_name"]=$this->uri->segment(3);
		$this->load->view('view_avatar', $data);
	}
	
	public function delete_avatar()
	{
		$this->load->view('delete_avatar');
	}
	
	public function get_vat_for_company()
	{
		echo $this->user_model->get_vat_for_company($this->input->post('company_id'));
	}
	
	public function delete_pdf()
	{
		$file_name=$this->input->post('file_name');
		$parser=new Parser();
		$parser->remove($file_name);
		$this->avatar_lib->delete_file($file_name);
	}
	
	public function submit_avatar()
	{
		$avatar_name = $this->input->post('avatar_name');
		$avatar_file = $this->input->post('avatar_file');
		$company_id = $this->input->post('company_id');
		$vat = $this->input->post('vat');
		$file_name = time() . '_' . str_replace(' ', '_', $avatar_name) . '_' . $_FILES['avatar_file']['name'];
		$config['file_name'] = $file_name;
		$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']) . '/uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '1000';
		$this->load->library('upload', $config);
		$this->upload->do_upload('avatar_file');
		
		if(!$this->avatar_lib->validate_uploading())
		{
			$this->session->set_flashdata('error_msg', $this->config->item('avatar_upload_error'));
			$this->load->view('add_avatar');
		}
		else
		{
			$parser=new Parser();
			$admin_id=$this->avatar_lib->get_admin_id();
			$sub_admin_id=$this->session->userdata('user_id');
			$result=$parser->save($admin_id, $sub_admin_id, $company_id, $file_name, $vat);
			if(strcmp($result,"Ok")==0){
				$this->avatar_lib->pdf_uploaded();
				$this->session->set_flashdata('sucess_message', $this->config->item('avatar_success'));
			}else{
				$this->avatar_lib->delete_file($file_name);
				if(strcmp($result,"VatError")==0){
					$this->session->set_flashdata('error_msg', "This pdf file do not belong to '" . $this->user_model->get_company_name($company_id) ."'");
				}else if(strcmp($result,"NoTable")==0){
					$this->session->set_flashdata('error_msg', "The PDF file don't have Table Data!");
				}else{
					$this->session->set_flashdata('error_msg', "The PDF file isn't supported format!");
				}
			}
			redirect(base_url().$this->config->item('avatar_path').'add_avatar');
		}
	}
}
