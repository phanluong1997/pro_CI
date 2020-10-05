<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends Admin_Controller {
	public $template = 'cpanel/wallet/';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('walletmodel');
	}
	//List action - OT2
	public function index()
	{
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Wallet Manager',
			'template' 	=> 	$this->template.'index',
			'control'	=>  'wallet'
		);
		$data['datas'] = $this->walletmodel->select_array('tbl_wallet','*',NULL,'id desc');

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//function check duplicate wallet ! - OT2
	public function check_wallet(){
		$wallet = $this->input->post('wallet');
		$where = array('wallet' => $wallet);
		//check exists
		if($this->walletmodel->check_exists($where))
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

				$result = $this->walletmodel->add('tbl_wallet', $data_insert);
			
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
	//Edit actions -OT2
	public function edit($id = 0)
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
				$result = $this->walletmodel->edit('tbl_wallet', $data_update,array('id' =>$id));
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
		$data['datas'] = $this->walletmodel->select_row('tbl_wallet','*',array('id' =>$id));
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//delete OT2
	public function delete()
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		// processed delete.
		$id = $_POST['id'];
		$this->walletmodel->del('tbl_wallet',array('id' => $id));
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}

}
