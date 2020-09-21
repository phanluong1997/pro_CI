<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}
	public function __destruct(){
	}

	//List admin -Ot1
	public function index()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$data = array(
			'data_index'	=>  $this->get_index(),
			'title'			=>	'Admin Manager',
			'path_url'		=>	'cpanel/admin/',
			'control'		=>	'admin',
			'template' 		=> 	'cpanel/admin/index'
		);
		$data['datas'] = $this->UserModel->getAll('tbl_user','*',array('type' => 'admin'),'id desc');
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//check_Email - Ot1
	public function check_Email(){
		$Email = $this->input->post('email');
		$where = array('email' => $Email);
		if($this->UserModel->check_exists($where)){
			//trả về thông báo lỗi
			$this->form_validation->set_message(__FUNCTION__,'Email already exists !');
			return false;
		}
		return true;
	}

	//Add admin - Ot1
	public function add()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//add data
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
				$result = $this->UserModel->add('tbl_user', $data_insert);
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
			'template' 		=> 	'cpanel/admin/add',
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
			$this->form_validation->set_rules('fullname','Fullname', 'required|min_length[2]');
			$this->form_validation->set_rules('phone','Phone', 'required|numeric|min_length[9]');
			if($this->form_validation->run()){
				if($this->input->post('active') != NULL){
					$active = 1;
				}else{
					$active = 0;
				}
				$data_update = array(
					'type'				=>	'admin',
					'fullname' 			=> 	trim($this->input->post('fullname')),
					'phone' 			=> 	trim($this->input->post('phone')),
					'active'			=>	$active,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModel->edit('tbl_user', $data_update, array('id' => $id));
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
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $id));
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

	//ChangeActive
	public function active()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$active = $_POST['active'];
		$data_update['active'] = $active;
		$this->UserModel->edit('tbl_user', $data_update, array('id' => $id));
	}

	//delete user admin
	public function delete()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$this->UserModel->del('tbl_user',array('id' => $id));

	}

	//ChangePassword - Ot1
	public function changepass($id=0)
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){
			//Random password
			$rand_salt = $this->Encrypts->genRndSalt();
			$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
			$data_update = array(
				'password' 			=> 	$encrypt_pass,
				'text_pass' 		=>  trim($this->input->post('password')),
				'salt' 				=>  $rand_salt,
				'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->UserModel->edit('tbl_user', $data_update, array('id' => $id));
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

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Change Password',
			'template' 		=> 	'cpanel/admin/changepass',
			'path_url'  	=>  'cpanel/admin'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
