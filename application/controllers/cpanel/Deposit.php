<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends Admin_Controller {
	public $template = 'cpanel/deposit/';
	public function __construct(){
		parent::__construct();
		$this->load->model('DepositModels');
		$this->load->model('UserModels');
	}
	//List action -OT2 
	public function index()
	{	
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//get data
		$datas= $this->DepositModels->getAll();
		//get fullname in table tbl_user -OT2
		if($datas != NULL){
			foreach ($datas as $key => $val) {
				$user_name = '';
				$infouser = $this->UserModels->find($val['userID'],'fullname');
				if($infouser != NULL){
					$user_name = $infouser['fullname'];
					}
				$datas[$key]['user_name'] = $user_name;
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Deposit Manager',
			'datas'		=> $datas,
			'template' 	=> 	$this->template.'index'
			
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
