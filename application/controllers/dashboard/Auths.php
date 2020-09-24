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
		else
		{
			$result = $this->UserModel->select_row('tbl_user', '*', array('email' => $email));
			if($result['active'] == 0)
			{
				echo json_encode(array('message' => 'Account not activated, please check your email!'));
			}
		}
	}

	//login user - OT1
	public function login()
	{
		if($this->input->post()){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$type = 'user';
			$login_array = array($email, $password, $type);
			if($this->Auth->signUser($login_array) === true)
			{ 
				$id = $this->session->userdata('userID');
				$result = $this->UserModel->select_row('tbl_user', 'status', array('id' => $id));
				if($result['status'] == 0)
				{
					redirect(base_url().'dashboard/update-profile.html/');
				}
				redirect(base_url().'dashboard');
			}
		}
		redirect(base_url().'dashboard');
		
	}

	//login with google - OT1
	public function loginGoogle()
	{
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$check = $this->UserModel->select_row('tbl_user', 'id', array('email' => $email));
		if($check == NULL)
		{
			$data_insert = array(
				'email' 			=> 	$email,
				'fullname'			=>	$fullname,
				'type'				=>	'user',
				'type_account'		=>	1,
				'status'			=>	0,
				'active'			=>	1,
				'created_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600),
				'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->UserModel->add('tbl_user', $data_insert);
			$this->session->set_userdata('userID', $result['id_insert']);
		}
		else
		{
			$this->session->set_userdata('userID', $check['id']);
		}
		echo json_encode(array('result' =>1));
	}

	//checkemail(ajax) - SignUp - Ot1
	public function checkEmail(){
		$email = $_POST['email'];
		$result = $this->UserModel->total('tbl_user', array('email' =>$email));
		if($result >=1){
			echo "Email already exists !";
		}
		
	}

	//checkvalidate_Email - SignUp - Ot1
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
					'type_account'		=>	0,
					'type'				=>	'user',
					'salt' 				=>  $rand_salt,
					'status'			=>	0,
					'active'			=>	0,
					'created_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModel->add('tbl_user', $data_insert);

				if($result>0){
					//send mail (to active account) -OT1
					$this->load->library('email');

					$subject = 'mt7.com';
					$message = 'Message';

					$id =$result['id_insert'];
					$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
					$token = base64_encode($token);
					
					// Get full html:
					$body = "<p>Hello!<br/>
							You have just registered successfully at MT7. Please click on the link below to activate your account.<br />
							Password:".trim($this->input->post('password'))."<br/>
							Activate link:<a href='".base_url()."dashboard/active-account.html/".$token."'>
							http://mt7.com?active=0KthjnNavRKKoMkG2oTpDIZpVTuCIZW7</a><br/>
							&nbsp;</p>
					";
					$result = $this->email
					    ->from('sentemail.optech@gmail.com')
					    ->reply_to('')    
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
					redirect('dashboard/home',$data);
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

	//Notify action
	public function notify(){
		//check signUser account -OT1
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/auth/notify'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Notify active account action - OT1
	public function activeAccount(){
		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		$id = $string[7];
		$result = $this->UserModel->edit('tbl_user', array('active' => 1), array('id' => $id));
		redirect(base_url().'dashboard/active-notify.html');
	}

	//Notify active account action - OT1
	public function activeNotify(){
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/auth/activeNotify'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//testSession  (Dont' delete) - OT1
	public function testSession()
	{
		echo '<pre>'; print_r($this->session->all_userdata());
		echo "</br>";
		echo "This is session userID: ".$this->session->userdata('userID');die;
	}

	//Update Profile action -OT1
	public function updateProfile(){
		$id = $this->session->userdata('userID');
		//edit data
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('fullname','Fullname', 'required|min_length[2]');
			$this->form_validation->set_rules('phone','Phone', 'required|numeric|min_length[9]');
			if($this->form_validation->run()){
				$data_update = array(
					'fullname' 			=> 	trim($this->input->post('fullname')),
					'phone' 			=> 	trim($this->input->post('phone')),
					'status'			=>  1,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModel->edit('tbl_user', $data_update, array('id' => $id));
				if($result>0){
					//$id = $result['id_insert'];
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

	//Forger Password action
	public function forgerPass()
	{
		//check signUser account AND check status -OT1
		if($this->Auth->signUser() === true){redirect(base_url().'dashboard/home');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Forger Password',
			'template' 		=> 	'dashboard/home/forgerPass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//check_Email - Ot1
	public function check_OldPassword(){
		$id = $this->session->userdata('userID');
		$where = array('email' => $Email);
		$result = $this->UserModel->select_row('tbl_user', '*', array('id' => $id));
		$rand_salt_old = $result['salt'];
		$oldpassword   = $result['password']."<br/>";
		$oldpassword_post = $this->Encrypts->encryptUserPwd( $this->input->post('oldpassword'),$rand_salt_old);
		if($oldpassword == $oldpassword_post)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message(__FUNCTION__,'Old Password incorrect!');
			return false;
		}

	}

	//Change Password -OT1
	public function changePass()
	{
		//check signUser account AND check status -OT1
		if($this->Auth->signUser() === true){redirect(base_url().'dashboard/home');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		if($this->input->post()){
			$this->form_validation->set_rules('oldpassword','Old Password','required|min_length[8]');
			//validate run
			if($this->form_validation->run()){
				$id = $this->session->userdata('userID');
				$where = array('email' => $Email);
				$result = $this->UserModel->select_row('tbl_user', '*', array('id' => $id));
				$rand_salt_old = $result['salt'];
				$oldpassword   = $result['password'];
				$oldpassword_post = $this->Encrypts->encryptUserPwd( $this->input->post('oldpassword'),$rand_salt_old);
				
				// echo $oldpassword.$oldpassword_post."<br/>";

			
				$ok1=(string)$oldpassword;
				$ok2=(string)$oldpassword_post;
				echo $ok1.'---'.$ok2; die;

				if($ok1 == $ok2)
				{
					echo "mật khẩu giống nhau<br/>";
					echo "Mật khẩu cũ trong database: ".$oldpassword."<br/>";
					echo "Mật khẩu cũ nhập trong form: ".$oldpassword_post."<br/>";
				}
				else
				{
					echo "không giống nhau<br/>";
					echo "Mật khẩu cũ trong database: ".$oldpassword."<br/>";
					echo "Mật khẩu cũ nhập từ form: ".$oldpassword_post."<br/>";
				}die;
						
			}
								
		}

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Change Password',
			'template' 		=> 	'dashboard/auth/changePass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Profile - OT1
	public function profile(){
		//check signUser account AND check status -OT1
		if($this->Auth->signUser() === true){redirect(base_url().'dashboard/home');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$id = $this->session->userdata('userID');
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
					//$id = $result['id_insert'];
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update user successful!!',
					));
					redirect(base_url().'dashboard');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update user error!!',
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
	
	//logout user - OT1
	function logout(){
		$this->session->unset_userdata('userID');
		redirect(base_url().'dashboard');
	}
}
