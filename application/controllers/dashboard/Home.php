<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	//Main action
	public function index()
	{
		//check signUser account -OT1
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$id = $this->session->userdata('userID');
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $id)); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

}
