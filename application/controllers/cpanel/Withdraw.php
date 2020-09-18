<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Admin_Controller {
	public $template = 'cpanel/withdraw/';
	public function __construct(){
		parent::__construct();
	}
	//List action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Withdraw Manager',
			'template' 	=> 	$this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
