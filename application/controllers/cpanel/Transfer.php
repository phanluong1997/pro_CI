<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends Admin_Controller {
	public $template = 'cpanel/transfer/';
	public function __construct(){
		parent::__construct();
	}
	//List action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Transfer Manager',
			'template' 	=> 	$this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
