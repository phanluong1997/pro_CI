<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Admin_Controller {

	//Login action
	public function login()
	{
		if($this->Auth->check_logged() === true){
			redirect(base_url().'cpanel/admin');
		}else{
			$data['title'] = 'Login';
			if($this->input->post()){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$type = 'admin';
				$login_array = array($email, $password, $type);
				if($this->Auth->process_login($login_array))
				{
					//get data info user
					$user = $this->Auth->logged_info();
					
					redirect(base_url().'cpanel');
				}
			}
			$data = array(
				'title'			=>	'Login System',
			);
			$this->load->view('cpanel/auth/login', isset($data)?$data:NULL);
		}

	}
	//Logout action
	function logout(){
		$this->session->unset_userdata('logged_user');
		redirect(base_url().'cpanel/login.html');
	}
}
