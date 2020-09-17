<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Admin_Controller {

	//Login action
	public function login()
	{
		$data = array(
			'title'		=>	'Login System'
		);
		$this->load->view('cpanel/auth/login', isset($data)?$data:NULL);
	}
}
