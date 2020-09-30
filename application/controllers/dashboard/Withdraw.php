<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Dashboard_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('WithdrawModel');
		$this->load->model('TelegramModels');
	}
	//checkAmount<100 - OT1
	public function checkAmount()
	{
		//checkSignin and checkStatus account -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$amount = $_POST['amount'];
		$amount_min = $_POST['amount_min'];
		$userID = $this->session->userdata('userID');
		$result = $this->WithdrawModel->select_row('tbl_user', 'walletUSD', array('id' => $userID));
		if($amount < $amount_min )
		{
			echo json_encode(array('message' => 'The amount must be greater than or equal to '.$amount_min));
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
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		if($this->input->post()){
			$userID = $this->session->userdata('userID');
			$data_insert = array(
				'userID' 				=> 	$userID,
				'amount' 				=> 	trim($this->input->post('Amount')),
				'amount_receive' 		=>  trim($this->input->post('AmountReceive')),
				'amount_eth'			=>	trim($this->input->post('ETH')),
				'wallet' 				=> 	trim($this->input->post('ETHWallet')),
				'status' 				=>  0,
				'date'					=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->WithdrawModel->add('tbl_withdraw', $data_insert);
			if($result>0){
				$Query_Wallet = $this->WithdrawModel->select_row('tbl_user', 'fullname,email,walletUSD', array('id' => $userID));
				$New_Wallet = $Query_Wallet['walletUSD']-trim($this->input->post('Amount'));
				$data_update = array(
					'walletUSD' 		=> $New_Wallet
				);
				$editWallet = $this->WithdrawModel->edit('tbl_user', $data_update, array('id' => $userID));
				//send email
				$this->load->library('email');

				$subject = 'mt7.com';
				$message = 'Message';

				$id =$result['id_insert'];
				$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
				$token = rtrim( strtr( base64_encode( $token ), '+/', '-_'), '=');
				
				// Get full html:
				$body = "<p>Hello!<br/>
						You have just executed a withdrawal order. Please click on the link below to confirm.<br />
						link:<a href='".base_url()."dashboard/trans-to-pending.html/".$token."'>
						http://mt7.com?trans-to-pending=0KthjnNavRKKoMkG2oTpDIZpVTuCIZW7</a><br/>
						&nbsp;</p>
				";
				$result = $this->email
				    ->from('sentemail.optech@gmail.com')
				    ->reply_to('')    
				    ->to($Query_Wallet['email']) 
				    ->subject($subject)
				    ->message($body)
				    ->send();

				if($result){
					$apiToken = "1271846341:AAEfv5L20KkwfmHjzDDprNWAVqm0qvmTQ_Q";
					$data = [
						'chat_id' => '@mt7accountnew',
						'text' => 'User <b>'.$Query_Wallet['fullname'].'</b> requests to withdraw $<b>'.number_format(trim($this->input->post('Amount')),2).'</b>'
					];
					$response = $this->TelegramModels->sendMessageChannel($apiToken, $data);
					if($response['ok'] == true){
						redirect('dashboard/notify-withdraw.html');
					}
				}
			}
		}
	}

	public function notifyWithDraw(){
		//checkSignin and checkStatus account -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/withdraw/notifyWithDraw'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	public function transToPending(){
		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		$id = $string[7];
		$result = $this->WithdrawModel->edit('tbl_withdraw', array('status' => 1), array('id' => $id));
		redirect(base_url().'dashboard/trans-to-pending-success.html');
	}

	public function notifyPendingSuccess(){
		//checkSignin and checkStatus account -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/withdraw/notifyPendingSuccess'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

}
