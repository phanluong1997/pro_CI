<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {
	public $template = 'cpanel/user/';
	public function __construct(){
		parent::__construct();
	}
	//List action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'User Manager',
			'template' 	=> 	$this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}