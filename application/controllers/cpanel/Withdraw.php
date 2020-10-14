<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Admin_Controller {
	public $template = 'cpanel/withdraw/';

	public function __construct(){
		parent::__construct();
		$this->load->model('WithdrawModels');
		$this->load->model('UserModels');
	}
	//List action - OT2
	public function index()
	{
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//get data 
		$datas= $this->WithdrawModels->getAll();
		//get fullname in table tbl_user
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
			'title'		=>	'Withdraw Manager',
			'template' 	=> 	$this->template.'index',
			'control'	=> 'withdraw',
			'datas'			=> $datas
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//change status -- OT2
	public function changeStatus(){

		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//get data modal in file index.php
		$id = $_POST['id'];
		
		$status = $_POST['status'];
		$note = $_POST['note'];	
		$amount = $_POST['amount'];
		//get data
		$data['datas']=$this->WithdrawModels->find($id);
		
		if($this->input->post()){
			$data_update = array(
				'id' 		=> 	$id,
				'status'	=>	$status,
				'note'		=>	$note
			);
			$result = $this->WithdrawModels->edit($data_update,$id);
			if($result>0){
				//return amount to wallet if destroyed -OT2
				if($status == 3)
				{
					$userID = $this->session->userdata('userID');
					$getUser = $this->UserModels->find($userID);
					$AmountUSD = $getUser['walletUSD'] + $amount;
					$returnWallet = $this->UserModels->edit(array('walletUSD' => $AmountUSD),$userID);
				}
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Update Success!!',
				));
				redirect('cpanel/withdraw/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Update unsuccess!',
				));
				redirect('cpanel/withdraw/index',$data);
			}
		
		}
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}	
}
