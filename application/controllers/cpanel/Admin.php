<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User');
	}
	public function __destruct(){
	}

	//List action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Admin Manager',
			'template' 	=> 	'cpanel/admin/index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//check_Email - Thao
	public function check_Email(){
		$Email = $this->input->post('email');
		$where = array('email' => $Email);
		if($this->query_sql->check_exists($where)){
			//trả về thông báo lỗi
			$this->form_validation->set_message(__FUNCTION__,'Email này đã tồn tại');
			return false;
		}
		return true;
	}

	//Add action
	public function add()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add New',
			'template' 	=> 	'cpanel/admin/form',
			'path_url'  =>  'cpanel/admin'
		);
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('email','Email', 'required|min_length[3]|callback_check_Email');
			//Random password
			$rand_salt = $this->Encrypts->genRndSalt();
			$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
			if($this->input->post('active') != NULL){
				$active = 1;
			}else{
				$active = 0;
			}
			$data_insert = array(
				'email' 			=> 	trim($this->input->post('email')),
				'password' 			=> 	$encrypt_pass,
				'text_pass' 		=>  trim($this->input->post('password')),
				'type'				=>	'admin',
				'fullname' 			=> 	trim($this->input->post('fullname')),
				'phone' 			=> 	trim($this->input->post('phone')),
				'salt' 				=>  $rand_salt,
				'active'			=>	$active,
				'created_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600),
				'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->User->addAdmin('tbl_admin', $data_insert);
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Thêm mới thành công!!',
				));
				redirect('cpanel/admin/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Thêm mới lỗi!!',
				));
				redirect('cpanel/admin/index',$data);
			}
		}
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);

		//code anh hieu
		// $data = array(
		// 	'data_index'	=> $this->get_index(),
		// 	'title'		=>	'Add New',
		// 	'template' 	=> 	'cpanel/admin/form'
		// );
		// $this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
