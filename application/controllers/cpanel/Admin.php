<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

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
	//Add action
	public function add()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add New',
			'template' 	=> 	'cpanel/admin/form'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
