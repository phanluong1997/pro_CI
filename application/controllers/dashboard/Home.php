<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('transfermodel');
		$this->load->model('WithdrawModel');
		$this->load->model('CoinModel');
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
		//START - OT1
		$data['history'] = $this->get_historyWithdraw();
		$data['wallet'] = $this->get_AmountMin();
		$data['ETH'] = $this->get_ETH();
		$data['referentID'] = $this->get_referentID();
		$userID = $this->session->userdata('userID');
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $userID));
		//END START - OT1 

		//START -OT2
		$data['historyTransfer']=$this->history();
		//END - OT2
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	// get data table tbl_transfer--OT2
	public function history(){
		// get data
		$userID = $this->session->userdata('userID');
		// $data= $this->transfermodel->getAll('tbl_transfer','*',array('userID_sender'=>$userID,'userID_received'=>$userID),'id desc ');
		$data = $this->db->select('*')->from('tbl_transfer')->where(array('userID_sender' => $userID))->or_where(array('userID_received'=>$userID))->get()->result_array();
		// var_dump($data);
		$userID = $this->session->userdata('userID');
		// if($data['datas'] != NULL){
			foreach ($data as $key => $val) {
				$user_nameSender = '';
				$user_nameReceived='';
				$resultSender = $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_sender']));
				$resultReceived =  $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_received']));
				if($val['userID_sender'] == $resultSender['id']  ){
					$data[$key]['user_nameSender'] = $resultSender['fullname'];
					if($val['userID_received']== $resultReceived['id']){
						$data[$key]['user_nameReceived'] = $resultReceived['fullname'];
					}
				}				
			}
		// }
		// var_dump($data); die;
		return $data['datas'] = $data ;
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
	//get Amount Min (Withdraw) and Cost Withdraw (%) in config - OT1
	public function get_AmountMin()
	{
		$result = $this->WithdrawModel->select_row('tbl_config', 'content', array('key' => 'wallet'));
		$wallet = json_decode($result['content'], true);
		return $wallet;
	}
	//get_cost ETH - OT1
	public function get_ETH()
	{
		$ETH = $this->CoinModel->getPriceUsd(eth);
		return $ETH;

	}
	//get_referentID - OT1
	public function get_referentID()
	{
		$userID = $this->session->userdata('userID');
		$referentID = $this->WithdrawModel->select_row('tbl_user','id,referentID',array('id' =>$userID));
		$get_User = $this->WithdrawModel->select_row('tbl_user','*',array('id' =>$referentID['referentID']));
		$referentID['fullname'] = $get_User['fullname'];
		return $referentID;
	}  

}


