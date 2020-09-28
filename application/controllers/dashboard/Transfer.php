<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Transfer extends Dashboard_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('transfermodel');
		}	
		//index data --OT2
		public function index(){
			$data = array(
				'data_index'	=> $this->get_index(),
				// 'template' 	=> 	$this->template.'index'
			);
			//get data
			$data['datas']= $this->transfermodel->select_array('tbl_transfer','*',NULL,'id desc');
			//get fullname in table tbl_user
			// if($data['datas'] != NULL){
			// 	foreach ($data['datas'] as $key => $val) {
			// 		$user_nameSender = '';
			// 		$infouserSender = $this->transfermodel->select_row('tbl_user', 'fullname', array('id' => $val['userID_sender']));
	
			// 		$user_nameReceived = '';
			// 		$infouserReceived = $this->transfermodel->select_row('tbl_user', 'fullname', array('id' => $val['userID_received']));
	
			// 		if($infouserSender && $infouserReceived != NULL){
			// 			$user_nameSender = $infouserSender['fullname'];
			// 			$user_nameReceived = $infouserReceived['fullname'];
			// 		}
			// 		$data['datas'][$key]['user_nameSender'] = $user_nameSender;
			// 		$data['datas'][$key]['user_nameReceived'] = $user_nameReceived;
			// 	}
			// }
			if($data['datas'] != NULL){
				foreach ($data['datas'] as $key => $val) {
					$user_nameSender = '';
					$infouserSender = $this->transfermodel->select_row('tbl_user', 'fullname', array('id' => $val['userID_sender']));
	
					if($infouserSender != NULL){
						$user_nameSender = $infouserSender['fullname'];
					}
					$data['datas'][$key]['user_nameSender'] = $user_nameSender;
				}
			}
			$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
		}
		//OT2
		public function Transfer(){
			if($this->input->post()){
				
				//get id user sender and user received.
				$userID_sender = $this->session->userdata('userID');
			// 	// echo $id; die;

				$data_insert = array(
					'userID_sender' => 	 $userID_sender,
					// 'userID_received'=>  trim($this->input->post('userID_received')),
					'amount'		=> 	 trim($this->input->post('amount')),
					'date'			=> 	 gmdate('Y-m-d H:i:s', time()+7*3600),
					'status' 		=> 	 1
				);

				$result = $this->transfermodel->add('tbl_transfer', $data_insert);
			
					if($result>0){
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'sucess',
							'message'	=> 'Transfer to success!!',
						));
						redirect('dashboard/transfer/index',$data);
					}else{
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'error',
							'message'	=> 'Transfer to unsuccess!!',
						));
						redirect('dashboard/transfer/index',$data);
					}	
			}
			$data = array(
				'data_index'	=> $this->get_index(),
			);
			$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
		}
		//check Amount --OT2
		public function checkAmount()
		{	
			//get $amount
			$amount = $_POST['amount'];
			$id = $this->session->userdata('userID');
			$result = $this->transfermodel->select_row('tbl_user', 'walletUSD', array('id' => $id));
			//get $transfer
			$transfer = $_POST['transfer'];
			echo json_encode($transfer);
			//process amount
			if($amount < 50 )
			{
			echo json_encode(array('message' => 'The amount entered must be greater than 50'));
			}else{
			if($amount >= $result['walletUSD']){
				echo json_encode(array('message' => 'The balance in the wallet is not enough'));
			}
			}

		}
		//check Transfer to --OT2
		// public function checkTransferto()
		// {
		// 	$transfer = $_POST['transfer'];
		// 	$id = $this->session->userdata('userID');
		// 	$result = $this->transfermodel->select_row('tbl_user', 'walletUSD', array('id' => $id));
		// 	// if($amount < 50 )
		// 	// {
		// 	// echo json_encode(array('message' => 'The amount entered must be greater than 50'));
		// 	// }else{
		// 	// if($amount >= $result['walletUSD']){
		// 	// 	echo json_encode(array('message' => 'The balance in the wallet is not enough'));
		// 	// }
		// 	// }
		// }

	}
?>
