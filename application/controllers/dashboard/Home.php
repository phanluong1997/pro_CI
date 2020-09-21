<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	//Main action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//checkemail(ajax) - Ot1
	public function checkEmail(){
		$email = $_POST['email'];
		$result = $this->UserModel->total('tbl_user', array('email' =>$email));
		if($result >=1){
			echo "Email already exists !";
		}
		
	}

	//checkvalidate_Email - Ot1
	public function check_Email(){
		$Email = $this->input->post('email');
		$where = array('email' => $Email);
		if($this->UserModel->check_exists($where)){
			//trả về thông báo lỗi
			$this->form_validation->set_message(__FUNCTION__,'Email already exists !');
			return false;
		}
		return true;
	}

	//SignUp - Ot1
	public function SignUp()
	{
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('email','Email', 'required|valid_email|min_length[3]|callback_check_Email');
			if($this->form_validation->run()){
				//Random password
				$rand_salt = $this->Encrypts->genRndSalt();
				$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
				$data_insert = array(
					'email' 			=> 	trim($this->input->post('email')),
					'password' 			=> 	$encrypt_pass,
					'type'				=>	'user',
					'salt' 				=>  $rand_salt,
					'active'			=>	0,
					'created_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModel->add('tbl_user', $data_insert);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Add user successful!!',
					));
					redirect('cpanel/admin/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Add user error!!',
					));
					redirect('cpanel/admin/index',$data);
				}
			}
		}

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Test sendEmail (incomplete) - OT1
	public function send()
	{
		$this->load->library('email');

		$subject = 'This is a test';
		$message = 'Test message';

		// Get full html:
		$body = 'Bằng một cách thần kỳ nào đó thì em đã gửi được cái mail rồi a ợ :v';
		
		// End attaching the logo.

		$result = $this->email
		    ->from('sentemail.optech@gmail.com')
		    ->reply_to('sentemail.optech@gmail.com')    // Optional, an account where a human being reads.
		    ->to('phucthao205@gmail.com')
		    ->subject($subject)
		    ->message($body)
		    ->send();

		var_dump($result);
		echo '<br />';
		echo $this->email->print_debugger();

		exit;
				

				// 
	}
	
}
