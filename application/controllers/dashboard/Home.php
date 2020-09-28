<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('WithdrawModel');
	}

	//Main action
	public function index()
	{	
		//check signUser account -OT1
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		//get_history Withdraw
		$userID = $this->session->userdata('userID');
		$Withdraw = $this->WithdrawModel->getAll('tbl_withdraw','*',array('userID' =>$userID),'id desc');
		$userID = $this->session->userdata('userID');
		foreach ($Withdraw as $key => $value) {
			$result = $this->WithdrawModel->select_row('tbl_user', 'id,fullname', array('id' => $userID));
			if($value['userID'] == $result['id']){
				$Withdraw[$key]['fullname'] = $result['fullname'];
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$data['history'] = $Withdraw;
		$userID = $this->session->userdata('userID');
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $userID)); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

}
