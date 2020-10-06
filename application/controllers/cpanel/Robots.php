<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robots extends Admin_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->model('RobotsModel');
	}

	public function index(){

		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}

		$datas = $this->RobotsModel->select_array('tbl_robots','*',NULL,'id desc');
		
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Robots Manager',
			'datas'		=>  $datas
		);
		
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
?>
