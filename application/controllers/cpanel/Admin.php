<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}
	public function __destruct(){
	}

	//List admin -Thao
	public function index()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$data = array(
			'data_index'	=>  $this->get_index(),
			'title'			=>	'Admin Manager',
			'path_url'		=>	'cpanel/admin/',
			'control'		=>	'admin',
			'template' 		=> 	'cpanel/admin/index'
		);
		$data['datas'] = $this->UserModel->getAll('tbl_admin','*',array('type' => 'admin'),'id desc');
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//check_Email - Thao
	public function check_Email(){
		$Email = $this->input->post('email');
		$where = array('email' => $Email);
		if($this->UserModel->check_exists($where)){
			//trả về thông báo lỗi
			$this->form_validation->set_message(__FUNCTION__,'Email này đã tồn tại');
			return false;
		}
		return true;
	}

	//Add admin - Thao
	public function add()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('email','Email', 'required|valid_email|min_length[3]|callback_check_Email');
			$this->form_validation->set_rules('password','Password', 'required|min_length[3]');
			$this->form_validation->set_rules('fullname','Fullname', 'required|min_length[2]');
			$this->form_validation->set_rules('phone','Phone', 'required|numeric|min_length[9]');
			if($this->form_validation->run()){
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
				$result = $this->UserModel->add('tbl_admin', $data_insert);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Add admin successful!!',
					));
					redirect('cpanel/admin/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Add admin error!!',
					));
					redirect('cpanel/admin/index',$data);
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Add New',
			'template' 		=> 	'cpanel/admin/form',
			'path_url'  	=>  'cpanel/admin'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	public function edit($id=0){
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//edit data
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('password','Password', 'required|min_length[3]');
			$this->form_validation->set_rules('fullname','Fullname', 'required|min_length[2]');
			$this->form_validation->set_rules('phone','Phone', 'required|numeric|min_length[9]');
			if($this->form_validation->run()){
				//Random password
				$rand_salt = $this->Encrypts->genRndSalt();
				$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
				if($this->input->post('active') != NULL){
					$active = 1;
				}else{
					$active = 0;
				}
				$data_update = array(
					'password' 			=> 	$encrypt_pass,
					'text_pass' 		=>  trim($this->input->post('password')),
					'type'				=>	'admin',
					'fullname' 			=> 	trim($this->input->post('fullname')),
					'phone' 			=> 	trim($this->input->post('phone')),
					'salt' 				=>  $rand_salt,
					'active'			=>	$active,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModel->edit('tbl_admin', $data_update, array('id' => $id));
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update admin successful!!',
					));
					redirect('cpanel/admin/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update admin error!!',
					));
					redirect('cpanel/admin/index',$data);
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Edit admin',
			'template' 	=> 	'cpanel/admin/edit',
			'path_url'  =>  'cpanel/admin'
		);
		$data['datas'] = $this->UserModel->select_row('tbl_admin', '*', array('id' => $id));
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

	public function active()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$active = $_POST['active'];
		$data_update['active'] = $active;
		$this->UserModel->edit('tbl_admin', $data_update, array('id' => $id));
	}

	public function delete()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$this->UserModel->del('tbl_admin',array('id' => $id));

	}
}
