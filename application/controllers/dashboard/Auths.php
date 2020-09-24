<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Dashboard_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	//check email, password before login - OT1
	public function checklogin()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$type = 'user';
		$login_array = array($email, $password, $type);
		if($this->Auth->checkInfoUser($login_array) === false)
		{
			echo json_encode(array('message' => 'Email or password incorrect!'));
		}
	}

	//login user - OT1
	public function login()
	{
		if($this->Auth->checkSignin() === true){
			redirect(base_url().'dashboard/home');
		}else{
			if($this->input->post()){
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$type = 'user';
				$login_array = array($email, $password, $type);
				if($this->Auth->signUser($login_array) === true)
				{
					redirect(base_url().'dashboard');
				}
				else
				{
					$result = $this->UserModel->select_row('tbl_user', '*', array('email' => $email));
					$id = $result['id'];
					if($result['active'] == 0){
						echo "email not activated"; die;
					}
					else if($result['fullname'] ==  NULL OR $result['phone'] == NULL)
					{
						$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
						$token = base64_encode($token);
						redirect(base_url().'dashboard/profile.html/'.$token);
					}
					redirect(base_url().'dashboard'); //TEST email or password incorrect -OT1;
				}
			}
		}
	}

	//login with google - OT1

	public function loginGoogle()
	{
		
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
			//return message error
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
					//send mail (to active account) -OT1
					$this->load->library('email');

					$subject = 'Mail active account';
					$message = 'Test message';

					$id =$result['id_insert'];
					$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
					$token = base64_encode($token);
					
					// Get full html:
					$body = "Vui lòng click vào <a href='".base_url()."dashboard/active-account-notify.html/".$token."'>link này</a> để kích hoạt tài khoản";
					$result = $this->email
					    ->from('sentemail.optech@gmail.com')
					    ->reply_to('sentemail.optech@gmail.com')    
					    ->to('phucthao205@gmail.com') //to(trim($this->input->post('email')))
					    ->subject($subject)
					    ->message($body)
					    ->send();


					//message sucess
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'SignUp successful!!',
					));
					redirect('dashboard/notify.html',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'SignUp error!!',
					));
					redirect('dashboard/notify.html',$data);
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


	//Forger Password action
	public function forgerPass()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Forger Password',
			'template' 		=> 	'dashboard/home/forgerPass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Change Password action
	public function changePass()
	{
		//echo $data_index['info_user']['fullname']; die;
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Change Password',
			'template' 		=> 	'dashboard/auth/changePass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Profile action -OT1
	public function profile(){
		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		echo $id = $string[7];
		//edit data
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
				$result = $this->UserModel->edit('tbl_user', $data_update, array('id' => $id));
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update admin successful!!',
					));
					redirect(base_url().'dashboard');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update admin error!!',
					));
					redirect(base_url().'dashboard');
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Profile',
			'template' 		=> 	'dashboard/auth/profile'
		);
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $id)); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Notify action
	public function notify(){
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/auth/notify'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//Notify active account action - OT1
	public function activeNotify(){
		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		$id = $string[7];
		$result = $this->UserModel->edit('tbl_user', array('active' => 1), array('id' => $id));
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/auth/activeNotify'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//logout user - OT1
	function logout(){
		$this->session->unset_userdata('userID');
		redirect(base_url().'dashboard');
	}
}
