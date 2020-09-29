<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Dashboard_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('WithdrawModel');
	}

	public function checkAmount()
	{
		$amount = $_POST['amount'];
		$userID = $this->session->userdata('userID');
		$result = $this->WithdrawModel->select_row('tbl_user', 'walletUSD', array('id' => $userID));
		// echo json_encode(array('message' =>$amount.'---'.$result['walletUSD']));
		if($amount < 100 )
		{
			echo json_encode(array('message' => 'The amount must be greater than or equal to 100'));
		}else{
			if($amount > $result['walletUSD']){
				echo json_encode(array('message' => 'The balance in the wallet is not enough'));
			}
		}
	}

	//Withdraw - OT1
	public function Withdraw()
	{
		//checkSignin and checkStatus account -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard/home');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		if($this->input->post()){
			//Random password
			$userID = $this->session->userdata('userID');
			$data_insert = array(
				'userID' 				=> 	$userID,
				'amount' 				=> 	trim($this->input->post('Amount')),
				'amount_receive' 		=>  trim($this->input->post('Amount'))*0.9,
				'amount_eth'			=>	(trim($this->input->post('Amount'))*0.9)*10,
				'wallet' 				=> 	trim($this->input->post('ETHWallet')),
				'status' 				=>  0,
				'date'					=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->WithdrawModel->add('tbl_withdraw', $data_insert);
			if($result>0){
				$Query_Wallet = $this->WithdrawModel->select_row('tbl_user', 'walletUSD', array('id' => $userID));
				$New_Wallet = $Query_Wallet['walletUSD']-trim($this->input->post('Amount'));
				$data_update = array(
					'walletUSD' 		=> $New_Wallet
				);
				$editWallet = $this->WithdrawModel->edit('tbl_user', $data_update, array('id' => $userID));
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Withdraw successful!!',
				));
				redirect('dashboard/home/index');
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Withdraw error!!',
				));
				redirect('dashboard/home/index');
			}
		}
	}

	//historyWithdraw - OT1
	public function historyWithdraw()
	{
		$data = array(
			'data_index'	=>  $this->get_index(),
			'template' 		=> 	'dashboard/withdraw/history'
		);
		$Withdraw = $this->WithdrawModel->getAll('tbl_withdraw','*','','id desc');
		$userID = $this->session->userdata('userID');
		foreach ($Withdraw as $key => $value) {
			$result = $this->WithdrawModel->select_row('tbl_user', 'id,fullname', array('id' => $userID));
			if($value['userID'] == $result['id']){
				$Withdraw[$key]['fullname'] = $result['fullname'];
			}
		}
		$data['history'] = $Withdraw;
		var_dump($Withdraw); die;
		$this->load->view('dashboard/home/index', isset($data)?$data:NULL);
	}
}
