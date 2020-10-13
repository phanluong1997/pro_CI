<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends Admin_Controller {
	public $template = 'cpanel/wallet/';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('walletmodels');
		$this->load->model('UserModels');
	}
	//List action - OT2
	public function index()
	{
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		
		//get fullname - OT1
		$getWallet = $this->walletmodels->getAll();
		foreach ($getWallet as $key => $value) {
			$getUser = $this->walletmodels->select_row('tbl_user','id,fullname',array('id' =>$value['userID']));
			if($value['userID'] == $getUser['id']){
				$getWallet[$key]['fullname']=$getUser['fullname'];
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Wallet Manager',
			'template' 	=> 	$this->template.'index',
			'control'	=>  'wallet',
			'datas'		=>  $getWallet
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//function check duplicate wallet ! - OT2
	public function check_wallet(){
		$wallet = $this->input->post('wallet');
		$where = array('wallet' => $wallet);
		//check exists
		if($this->walletmodels->check_exists($where))
		{
			//infor bug
			$this->form_validation->set_message(__FUNCTION__,' Wallet is Exist ');
			return false;
		}
		return true;
	} 
	//Add action -OT2
	public function add()
	{
		//Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//check validate wallet
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			$this->form_validation->set_rules('wallet','Wallet','required|min_length[2]|callback_check_wallet');

			if($this->form_validation->run()){
				$data_insert = array(
					'wallet' => trim($this->input->post('wallet')),
					'date'	=> 	gmdate('Y-m-d H:i:s', time()+7*3600),
					'status' => 	1,
					'create_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'update_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);

				$result = $this->walletmodels->add($data_insert);
			
					if($result>0){
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'sucess',
							'message'	=> 'Add data success!!',
						));
						redirect('cpanel/wallet/index',$data);
					}else{
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'error',
							'message'	=> 'Add data unsuccess!!',
						));
						redirect('cpanel/wallet/index',$data);
					}
			}	
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add New',
			'template' 	=> 	$this->template.'add'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//check_EmailWallet - OT1
	public function check_EmailWallet()
	{
		$email = trim($this->input->post('email'));
		$getUser = $this->UserModel->select_row('tbl_user', 'id', array('email' => $email));
		$getWallet = $this->UserModel->select_row('tbl_wallet', 'userID', array('userID' => $getUser['id']));
		if($getWallet == NULL){
			return true;
		}else{
			if($getUser['id'] == $getWallet['userID'])
			{
				$this->form_validation->set_message(__FUNCTION__,'This account already has a wallet address');
				return false;
			}
		}
	}
	//addUserInWallet - OT1
	public function addUserInWallet($id = 0)
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//Check validate wallet
		if($this->input->post()){
			$this->form_validation->set_rules('email','Email','required|valid_email|min_length[2]|callback_check_EmailWallet');
			if($this->form_validation->run()){
				$email = trim($this->input->post('email'));
				$getUser = $this->UserModel->select_row('tbl_user', 'id', array('email' => $email));
				$getWallet = $this->UserModel->select_row('tbl_wallet', 'userID', array('id' => $id));
				if($getWallet['userID'] == 0){
					$data_update = array(
					'userID' 	=> 		$getUser['id']
					);
					$result = $this->walletmodels->edit('tbl_wallet', $data_update,array('id' =>$id));
					if($result>0){
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'sucess',
							'message'	=> 'Update wallet success!!',
						));
						redirect('cpanel/wallet/index',$data);
					}else{
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'error',
							'message'	=> 'Updata wallet unsuccess!!',
						));
						redirect('cpanel/wallet/index',$data);
					}
				}
				else
				{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'This account already has a wallet address',
					));
					redirect('cpanel/wallet/addUserInWallet/'.$id);
				}
				
			}	
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add User In Wallet',
			'template' 	=> 	$this->template.'addUserInWallet'
		);

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

	//Edit actions -OT2
	public function edit($id)
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//Check validate wallet
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			$this->form_validation->set_rules('wallet','Wallet','required|min_length[2]|callback_check_wallet');

			if($this->form_validation->run()){
				$data_update = array(
					'wallet' => trim($this->input->post('wallet')),
					'date'	=> 	gmdate('Y-m-d H:i:s', time()+7*3600),
					'status' => 	1,
					'create_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'update_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->walletmodels->edit($data_update,$id);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update data success!!',
					));
					redirect('cpanel/wallet/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Updata data unsuccess!!',
					));
					redirect('cpanel/wallet/index',$data);
				}
			}	
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Edit Wallet',
			'template' 	=> 	$this->template.'edit'
		);
		$data['datas'] = $this->walletmodels->find($id);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//delete OT2
	public function delete()
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		// processed delete.
		$id = $_POST['id'];
		$this->walletmodels->delete( $id);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

}
