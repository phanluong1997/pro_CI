<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Admin_Controller {

	//Login action
	public function login()
	{

		$data = array(
			'title'		=>	'Login System'
		);
		if($this->Auth->check_logged() === true){
			redirect(base_url().'cpanel/admin');
		}else{
			$data['title'] = 'Đăng nhập';
			if($this->input->post()){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$type = 'admin';
				$login_array = array($email, $password, $type);
				if($this->Auth->process_login($login_array))
				{
					//Check active
					$user = $this->Auth->logged_info();
					redirect(base_url().'cpanel/admin');
				}
			}
			$this->load->view('cpanel/auth/login', isset($data)?$data:NULL);
		}

	}
	function logout(){
		$this->session->unset_userdata('logged_user');
		redirect(base_url().'cpanel/login.html');
	}
}
