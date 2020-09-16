<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Dashboard_Controller {
	//Login action
	public function login()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Dashboard',
			'template' 		=> 	'dashboard/home/login'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Register action
	public function register()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Register',
			'template' 		=> 	'dashboard/home/register'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Forger Password action
	public function forgerPass()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Forger Password',
			'template' 		=> 	'dashboard/home/forgerPass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Change Password action
	public function changePass()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Change Password',
			'template' 		=> 	'dashboard/home/changePass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Profile action
	public function profile{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Profile',
			'template' 		=> 	'dashboard/home/profile'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
}
