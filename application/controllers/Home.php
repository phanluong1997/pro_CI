<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	Controller main giao diện người dùng
	 */
	public function index()
	{
		//redirect to dashboard for user
		redirect('dashboard');
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Home Page',
			'template' 	=> 	'frontend/home/index'
		);
		$this->load->view('frontend/default/index', isset($data)?$data:NULL);
	}
	public function page404()
	{
		$data = array(
			'title'		=>	'404 Page',
		);
		$this->load->view('frontend/default/page404', isset($data)?$data:NULL);
	}
}
