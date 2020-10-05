<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Transfer extends Dashboard_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('transfermodel');
			$this->load->model('TelegramModels');
		}	
		//index data --OT2
		public function index(){
			
			$data = array(
				'data_index'	=> $this->get_index(),
				 'template' 	=> 	'dashboard/transfer/history'
			);
			$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
		}
		//OT2
		public function Transfer(){
			if($this->input->post()){
				
				//get id user sender and user received.
				$userID_sender = $this->session->userdata('userID');
				$transfer = $_POST['transfer'];
				$emailTransfer = $this->transfermodel->select_row('tbl_user', 'id,fullname,email,type', array('email'=>$transfer));
				$userID_received = $emailTransfer['id'];
			 	// echo $userID_sender."-----------".$userID_received; die;
				
				$data_insert = array(
					'userID_sender' => 	 $userID_sender,
					'userID_received'=>  $userID_received,
					'amount'		=> 	 trim($this->input->post('amount')),
					'date'			=> 	 gmdate('Y-m-d H:i:s', time()+7*3600),
					'status' 		=> 	 1
				);

				$result = $this->transfermodel->add('tbl_transfer', $data_insert);
				if($result>0){
					//minus userSender
					$Query_WalletS = $this->transfermodel->select_row('tbl_user', 'fullname,walletUSD', array('id' => $userID_sender));
					$New_WalletUserSender = $Query_WalletS['walletUSD'] - trim($this->input->post('amount'));
					$data_update = array(
						'walletUSD' 		=> $New_WalletUserSender
					);
					$editWallet = $this->transfermodel->edit('tbl_user', $data_update, array('id' => $userID_sender));
					// //Plus userReceived
					$Query_WalletR = $this->transfermodel->select_row('tbl_user', 'walletUSD', array('id' => $userID_received));
					$New_WalletUserReceived = $Query_WalletR['walletUSD'] + trim($this->input->post('amount'));
					$data_update = array(
						'walletUSD' 		=> $New_WalletUserReceived
					);
					$editWallet = $this->transfermodel->edit('tbl_user', $data_update, array('id' => $userID_received));
					//Sent message into tele -OT1
				    $apiToken = "1271846341:AAEfv5L20KkwfmHjzDDprNWAVqm0qvmTQ_Q";
				    $data = [
				        'chat_id' => '@mt7accountnew',

				        'text' => 'User <b>'.$Query_WalletS['fullname'].'</b> transfers  $<b>'.number_format(trim($this->input->post('amount')),2).'</b> '.'to user <b>'.$emailTransfer['fullname'].'</b> at <b>'.gmdate('Y-m-d H:i:s', time()+7*3600).'</b>' 
				    ];
				    $response = $this->TelegramModels->sendMessageChannel($apiToken, $data);
				    if($response['ok'] == true){
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'sucess',
							'message'	=> 'Transfer to success!!',
						));
						redirect('dashboard/transfer/notifyTransfer');
					}
					else{
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'error',
							'message'	=> 'Transfer to unsuccess!!',
						));
						redirect('dashboard');
					}
				}	
			}
			$data = array(
				'data_index'	=> $this->get_index(),
			);
			$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
		}
		//show Infor --OT2
		public function notifyTransfer(){
			$data = array(
				'data_index'	=> $this->get_index(),
				'title'			=>	'Notify',
				'template' 		=>  'dashboard/modals/notifyTransfer'
			);

			$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
			

		}
		//check Amount --OT2
		public function checkAmountTransfer()
		{	
			//get $amount
			$amount = $_POST['amount'];
			$transfer = $_POST['transfer'];
			$type = 'user';
			$userID = $this->session->userdata('userID');
			$result = $this->transfermodel->select_row('tbl_user', 'email,walletUSD', array('id' => $userID));
			$emailTransfer = $this->transfermodel->select_row('tbl_user', 'email,type,status,active', array('email'=>$transfer));
			// //process 
			if(($amount < 50)||($amount > $result['walletUSD']))
			{
				echo json_encode(array('message' => 'The amount entered must be greater than 50 or The balance in the wallet is not enough '));
			}
			else
			{
				if($emailTransfer == NULL){
					echo json_encode(array('message' => "Email don't Exists"));
				}
				else if($emailTransfer['type'] == 'admin'){
					echo json_encode(array('message' => "Email don't Exists"));
				}
				else if($emailTransfer['email'] == $result['email']){
					echo json_encode(array('message' => 'Cannot transfer money to yourself'));
				}
				else if($emailTransfer['active'] == 0){
					echo json_encode(array('message' => "The recipient's account is not activated"));
				}
				else if($emailTransfer['status'] == 0){
					echo json_encode(array('message' => 'Account information not updated'));
				}
					
			}
			

		}

	}
?>
