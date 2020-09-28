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
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$data['history'] = $this->get_historyWithdraw();
		$data['wallet'] = $this->get_AmountMin();
		$userID = $this->session->userdata('userID');
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $userID)); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//get_history Withdraw - OT1
	public function get_historyWithdraw()
	{
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
		return $Withdraw;
	}
	//get Amount Min (Withdraw) and Cost Withdraw (%) in config
	public function get_AmountMin()
	{
		$result = $this->WithdrawModel->select_row('tbl_config', 'content', array('key' => 'wallet'));
		$wallet = json_decode($result['content'], true);
		return $wallet;
	} 

}
