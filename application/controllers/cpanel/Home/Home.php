<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {

	/**
	Controller main giao diện người dùng
	 */
	//Main action
	public function index()
	{

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'cpanel/home/index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
