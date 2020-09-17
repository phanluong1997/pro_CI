<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	//Main action
	public function index()
	{

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'User Manager',
			'template' 	=> 	'cpanel/user/index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
