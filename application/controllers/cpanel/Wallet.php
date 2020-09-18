<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends Admin_Controller {
	public $template = 'cpanel/wallet/';
	public function __construct(){
		parent::__construct();
	}
	//List action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Wallet Manager',
			'template' 	=> 	$this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//Add action
	public function add()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add New',
			'template' 	=> 	$this->template.'form'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
