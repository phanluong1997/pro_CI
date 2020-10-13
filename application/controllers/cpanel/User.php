<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {
	public $template = 'cpanel/user/';
	public $control = 'user';
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModels');
		$this->load->model('WalletModels');
	}
	//List action - OT2
	public function index()
	{	
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		// $this->load->library('pagination');
		//get all
		$totalRow = $config['total_rows'] = $this->UserModels->getAll();
		//get limit
		$datas = $this->UserModels->findWhere(array('type'=>'user'),'','id desc', 0, 5);
		//getWallet  - OT1
		foreach ($datas as $key => $value) {
			$getWallet = $this->WalletModels->find($value['id'], 'userID,wallet', 'userID');
			if($getWallet != NULL){
				if($getWallet['userID'] == $value['id']){
					$datas[$key]['wallet'] = $getWallet['wallet'];
				}
			}
			else
			{
				$datas[$key]['wallet'] = '';
			}
		}
		//get total page
		$countPage = ceil(count($totalRow) / 5);
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'User Manager',
			'control'		=>	'user',
			'datas'		=>	$datas,
			'countPage'		=>	$countPage,
			'template' 	=> 	$this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//Edit action -OT2
	public function edit($id){
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//edit data
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('fullname','Fullname', 'required|min_length[2]');
			$this->form_validation->set_rules('phone','Phone', 'required|numeric|min_length[9]');
			if($this->form_validation->run()){
				$data_update = array(
					'fullname' 			=> 	trim($this->input->post('fullname')),
					'phone' 			=> 	trim($this->input->post('phone')),
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModels->edit($data_update,$id);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update user successful!!',
					));
					redirect('cpanel/user/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update user error!!',
					));
					redirect('cpanel/user/index',$data);
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Edit User',
			'template' 	=> 	'cpanel/user/edit',
			'path_url'  =>  'cpanel/user'
		);
		$data['datas'] = $this->UserModels->find($id);

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);	
	}
	//Change Active - OT2
	public function active()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$active = $_POST['active'];
		$data_update['active'] = $active;
		$this->UserModels->edit($data_update,$id);
	}
	//Change Verify -OT2
	public function verify()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$verify = $_POST['verify'];
		$data_update['verify'] = $verify;
		$this->UserModels->edit($data_update,$id);
	}
	//ChangePassword - OT2
	public function changepassword($id)
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){
			//Random password
			$rand_salt = $this->Encrypts->genRndSalt();
			$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
			$data_update = array(
				'password' 			=> 	$encrypt_pass,
				'text_pass' 		=>  trim($this->input->post('password')),
				'salt' 				=>  $rand_salt,
				'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->UserModels->edit($data_update,$id);
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Update user password successful!!',
				));
				redirect('cpanel/user/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Update user password error!!',
				));
				redirect('cpanel/user/index',$data);
			}
		}

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Change User Password ',
			'template' 		=> 	'cpanel/user/changepassword',
			'path_url'  	=>  'cpanel/user'
		);
		$data['datas'] = $this->UserModels->find($id);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	// ajax search search data -OT2
	public function search()
	{	
		$output = '';
		$query = '';
		//object transmission search.
		if($this->input->post('query')){
			$query = $this->input->post('query');
		}
		//get data as an Array in UserModels - function getSearch().
		if($query != ''){
			$datas = $this->UserModels->getSearch($query);
		}
		$output ='<table id="employeeList" class="table custom-table">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Wallet USD</th>
							<th>Date</th>
							<th>Status</th>
							<th>Tools</th>
						</tr>';
		if($datas != NULL ){
			foreach($datas as $row){
				$activeChecked = '';
				$verifyChecked = '';
				$control = $this->control;
				if($row['active'] == 1){ $activeChecked = 'checked'; }	
				if($row['verify'] == 1){ $verifyChecked = 'checked'; }	
				$output .= '<tr>
								<td>'.$row['fullname'].'</td>
								<td>
									<p>'.$row['email'].'</p>
									<p><i class="icon-vpn_key"></i>Pass: '.$row['text_pass'].'</p>
								</td>
								<td>'.$row['phone'].'</td>
								<td>'.$row['walletUSD'].'</td>
								<td>'.$row['created_at'].'</td>
								<td>
									<div class="custom-control custom-switch">
										<input onclick="checkActive('.$row['id'].')" '.$activeChecked.'
										type="checkbox" class="custom-control-input" id="active'.$row['id'].'" 
										data-control="'.$control.'">
										<label class="custom-control-label" for="active'.$row['id'].'">Active</label>
									</div>
									<div class="custom-control custom-switch">
										<input onclick="checkVerify('.$row['id'].')" '.$verifyChecked.'
										type="checkbox" class="custom-control-input" id="verify'.$row['id'].'" data-control="'.$control.'">
										<label class="custom-control-label" for="verify'.$row['id'].'">
											Verify (<a href="" class="text-success">View Detail</a>)
										</label>
									</div>
								</td>
								<td>
									<a href="cpanel/user/edit/'.$row['id'].'" class="btn btn-info text-white"><i class="icon-border_color"></i></a>
									<a href="cpanel/user/changepassword/'.$row['id'].'" class="btn btn-warning text-white"><i class="icon-vpn_key"></i></a>
								</td>
							</tr>';
			}	
		}
		echo $output;
	}	
	//Pagination --OT2
	public function pagination(){
		$number = 5;
		$page = $_POST['i'];
		$start = ($page - 1) * $number;
		$limit = $number;
		$datas = $this->UserModels->findWhere(array('type'=>'user'),'*','id desc', $start, $limit);
		$output = '' ;	
			foreach($datas as $row){
				$activeChecked = '';
				$verifyChecked = '';
				$control = $this->control;
				if($row['active'] == 1){ $activeChecked = 'checked'; }	
				if($row['verify'] == 1){ $verifyChecked = 'checked'; }	
				$output .= '<tr>
								<td>'.$row['fullname'].'</td>
								<td>
									<p>'.$row['email'].'</p>
									<p><i class="icon-vpn_key"></i>Pass: '.$row['text_pass'].'</p>
								</td>
								<td>'.$row['phone'].'</td>
								<td>'.$row['walletUSD'].'</td>
								<td>'.$row['created_at'].'</td>
								<td>
									<div class="custom-control custom-switch">
										<input onclick="checkActive('.$row['id'].')" '.$activeChecked.'
										type="checkbox" class="custom-control-input" id="active'.$row['id'].'" 
										data-control="'.$control.'">
										<label class="custom-control-label" for="active'.$row['id'].'">Active</label>
									</div>
									<div class="custom-control custom-switch">
										<input onclick="checkVerify('.$row['id'].')" '.$verifyChecked.'
										type="checkbox" class="custom-control-input" id="verify'.$row['id'].'" data-control="'.$control.'">
										<label class="custom-control-label" for="verify'.$row['id'].'">
											Verify (<a href="" class="text-success">View Detail</a>)
										</label>
									</div>
								</td>
								<td>
									<a href="cpanel/user/edit/'.$row['id'].'" class="btn btn-info text-white"><i class="icon-border_color"></i></a>
									<a href="cpanel/user/changepassword/'.$row['id'].'" class="btn btn-warning text-white"><i class="icon-vpn_key"></i></a>
								</td>
							</tr>';
			}	
		echo $output;
	}
	//Change Verify -OT2
	public function showIdentity()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$userID = $_POST['userID'];
		$user = $this->UserModels->find($userID,'fullname, avatar, card_front, card_back');
		echo json_encode(array('user' => $user));
	}	
}
