<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends Admin_Controller {
	public $template = 'cpanel/deposit/';
	public function __construct(){
		parent::__construct();
		$this->load->model('depositmodel');
	}
	//List action -OT2 
	public function index()
	{	
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Deposit Manager',
			'template' 	=> 	$this->template.'index'
		);
		//get data
		$data['datas']= $this->depositmodel->select_array('tbl_deposit','*',NULL,'id desc');
		//get fullname in table tbl_user
		if($data['datas'] != NULL){
			foreach ($data['datas'] as $key => $val) {
				$user_name = '';
				$infouser = $this->depositmodel->select_row('tbl_user', 'fullname', array('id' => $val['userID']));
				if($infouser != NULL){
					$user_name = $infouser['fullname'];
					}
				$data['datas'][$key]['user_name'] = $user_name;
			}
		}

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

}
