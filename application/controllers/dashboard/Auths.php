<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Dashboard_Controller {

	public $path_dir = 'upload/passport/';
	public $path_dir_thumb = 'upload/passport/thumb/';

	public function __construct(){
		parent::__construct();
		$this->load->model('TelegramModels');
		$this->load->model('UserModels');
		$this->load->model('WalletModels');
	}

	//check email, password before login - OT1
	public function checklogin()
	{
		$email = trim($_POST['email']);
		$password = $_POST['password'];
		$type = 'user';
		$login_array = array($email, $password, $type);
		if($this->Auth->checkInfoUser($login_array) === false)
		{
			echo json_encode(array('message' => 'Email or password incorrect!'));
		}
		else
		{
			$result = $this->UserModels->find($email, 'active', 'email');
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
			$email = trim($this->input->post('email'));
			$password = $this->input->post('password');
			$type = 'user';
			$login_array = array($email, $password, $type);
			if($this->Auth->signUser($login_array) === true)
			{ 
				$id = $this->session->userdata('userID');
				$result = $this->UserModels->find($id, 'status');
				if($result['status'] == 0)
				{
					redirect(base_url().'dashboard/update-profile.html/');
				}
				redirect(base_url().'dashboard');
			}
		}
		redirect(base_url().'dashboard');
		
	}

	//add password - OT1
	public function addPass()
	{
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('password','Password', 'required|min_length[8]');
			if($this->form_validation->run()){
				//Random password
				$rand_salt = $this->Encrypts->genRndSalt();
				$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
				$data_update = array(
					'password' 			=> 	$encrypt_pass,
					'text_pass' 		=>  trim($this->input->post('password')),
					'salt' 				=>  $rand_salt,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$id = $this->session->userdata('userID');
				$result = $this->UserModels->edit($data_update,$id);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Add password successful!!',
					));
					redirect(base_url().'dashboard/home/index');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Add password error!!',
					));
					redirect(base_url().'dashboard/home/index');
				}
			}
		}

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Add Password',
			'template' 		=> 	'dashboard/auth/addPass',
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//login with google - OT1
	public function loginGoogle()
	{
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$check = $this->UserModels->find($email, 'id', 'email');
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
			$result = $this->UserModels->add($data_insert);
			$this->random_code($result['id_insert']);
			if($result>0)
			{
				$this->session->set_userdata('userID', $result['id_insert']);
			}
		}
		else
		{
			$this->session->set_userdata('userID', $check['id']);
		}
		echo json_encode(array('result' =>0));
		
	}

	//checkemail(ajax) - SignUp - Ot1
	public function checkEmail(){
		$email = $_POST['email'];
		$result = $this->UserModels->total('tbl_user', array('email' =>$email));
		if($result >=1){
			echo "Email already exists !";
		}
		
	}

	//checkvalidate_Email - SignUp - Ot1
	public function check_Email(){
		$Email = $this->input->post('email');
		$where = array('email' => $Email);
		if($this->UserModels->check_exists($where)){
			//return message error
			$this->form_validation->set_message(__FUNCTION__,'Email already exists !');
			return false;
		}
		return true;
	}

	public function random_code($id)
	{
		$min = 10000000;
		$max = 99999999;
		$rand_code = mt_rand($min,$max);
		$result = $this->UserModels->find($rand_code, 'code', 'code');
		if($result == NULL)
		{
			$data_update = array(
				'code' 		=> 	$rand_code
			);
			$result = $this->UserModels->edit($data_update, $id);
		}
		else
		{
			do{
				$new_rand_code = mt_rand($min,$max);
				$result = $this->UserModels->find($new_rand_code, 'code', 'code');
				$max = $max + 1;
			}
			while($result['code'] == $new_rand_code);
			$data_update = array(
				'code' 		=> 	$new_rand_code
			);
			$result = $this->UserModels->edit($data_update, $id);
		}
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
				$encrypt_pass = $this->Encrypts->encryptUserPwd($this->input->post('password'),$rand_salt);
				$data_insert = array(
					'email' 			=> 	trim($this->input->post('email')),
					'password' 			=> 	$encrypt_pass,
					'text_pass' 		=> 	$this->input->post('password'),
					'type_account'		=>	0,
					'type'				=>	'user',
					'salt' 				=>  $rand_salt,
					'status'			=>	0,
					'active'			=>	0,
					'created_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModels->add($data_insert);
				$this->random_code($result['id_insert']);
				if($result>0){
					//send mail (to active account) -OT1
					$this->load->library('email');

					$subject = 'mt7.com';
					$message = 'Message';

					$id =$result['id_insert'];
					$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
					$token = rtrim( strtr( base64_encode( $token ), '+/', '-_'), '=');
					
					// Get full html:
					$body = "<p>Hello!<br/>
							You have just registered successfully at MT7. Please click on the link below to activate your account.<br />
							Password:".trim($this->input->post('password'))."<br/>
							Activate link:<a href='".base_url()."dashboard/active-account.html/".$token."'>
							http://mt7.com?active=0KthjnNavRKKoMkG2oTpDIZpVTuCIZW7</a><br/>
							&nbsp;</p>";
					$result = $this->email
					    ->from('sentemail.optech@gmail.com')
					    ->reply_to('')    
					    ->to(trim($this->input->post('email'))) //
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
	
	//Upload Identity Card - OT1
	public function uploadIdentityCard(){
		//check checkSignin account AND checkStatus  -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$userID = $this->session->userdata('userID');
		$getInfo = $this->UserModels->find($userID,'fullname,verify,avatar,card_front,card_back');
		if($getInfo['verify']==1){redirect(base_url().'dashboard');}
		if($this->input->post()){
			//avatar
			if($_FILES["avatar"]["name"]){
				if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
				if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}
				$config['upload_path']	= $this->path_dir;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 5120;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$image_avatar = $this->upload->do_upload("avatar");
				$image_data = $this->upload->data();
				$name_avatar = $image_data['file_name'];

				//Create thumb
				$this->load->library('image_lib');
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $this->path_dir.$image_data['file_name'];
				$config['new_image'] 		= $this->path_dir_thumb.$image_data['file_name'];
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] = 400;

				$ar_name_image = explode('.',$image_data['file_name']);
				$name_avatar_thumb = $ar_name_image[0].'_thumb.'.$ar_name_image[1];
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}else{
				$name_avatar = '';
				$name_avatar_thumb = $getInfo['avatar'];
			}
			//card_front
			if($_FILES["card_front"]["name"]){
				if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
				if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}
				$config['upload_path']	= $this->path_dir;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 5120;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$image_card_front = $this->upload->do_upload("card_front");
				$image_data = $this->upload->data();
				$name_card_front = $image_data['file_name'];

				//Create thumb
				$this->load->library('image_lib');
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $this->path_dir.$image_data['file_name'];
				$config['new_image'] 		= $this->path_dir_thumb.$image_data['file_name'];
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] = 400;

				$ar_name_image = explode('.',$image_data['file_name']);
				$name_card_front_thumb = $ar_name_image[0].'_thumb.'.$ar_name_image[1];
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}else{
				$name_card_front = '';
				$name_card_front_thumb = $getInfo['card_front'];
			}
			//card_back
			if($_FILES["card_back"]["name"]){
				if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
				if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}
				$config['upload_path']	= $this->path_dir;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 5120;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$image_card_back = $this->upload->do_upload("card_back");
				$image_data = $this->upload->data();
				$name_card_back = $image_data['file_name'];

				//Create thumb
				$this->load->library('image_lib');
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $this->path_dir.$image_data['file_name'];
				$config['new_image'] 		= $this->path_dir_thumb.$image_data['file_name'];
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] = 400;

				$ar_name_image = explode('.',$image_data['file_name']);
				$name_card_back_thumb = $ar_name_image[0].'_thumb.'.$ar_name_image[1];
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}else{
				$name_card_back = '';
				$name_card_back_thumb = $getInfo['card_back'];
			}
			$userID = $this->session->userdata('userID');
			$data_update = array(
				'avatar' 				=> 	$name_avatar_thumb,
				'card_front' 			=> 	$name_card_front_thumb,
				'card_back' 			=> 	$name_card_back_thumb,
				'updated_at'			=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->UserModels->edit($data_update, $userID);
			if($result>0){
				//Sent message into tele
			    $apiToken = "1271846341:AAEfv5L20KkwfmHjzDDprNWAVqm0qvmTQ_Q";
			    $data = [
			         'chat_id' => '@mt7accountnew',
			         'text' => 'Verify request for user '.$getInfo['fullname']
			    ];
			    $response = $this->TelegramModels->sendMessageChannel($apiToken, $data);
			    if($response['ok'] == true){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Upload iddentity card successful!!',
					));
					redirect(base_url().'dashboard/upload-identity-card.html');
				}
				else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Upload iddentity card error!!',
					));
					redirect(base_url().'dashboard/upload-identity-card.html');
				}
			}
		}
		
		$data = array(
			'data_index'		=>  $this->get_index(),
			'title'				=>	'Upload Identity Card',
			'path_dir_thumb'	=>	$this->path_dir_thumb,
			'template' 			=> 	'dashboard/auth/uploadIdentityCard'
		);
		$data['datas'] = $getInfo;
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//check ReferentCode - OT1 
	public function check_ReferentCode()
	{
		$code = trim($this->input->post('code'));
		$result = $this->UserModels->find($code, 'code', 'code');
		$userID = $this->session->userdata('userID');
		$myCode = $this->UserModels->find($userID, 'code');
		if($result == NULL)
		{
			$this->form_validation->set_message(__FUNCTION__,'This code does not exist');
			return false;
		}else{
			if($code == $myCode['code'] ){
				$this->form_validation->set_message(__FUNCTION__,'Cannot enter yourself code');
				return false;
			}
			else
			{
				return true;
			}
		}
	}

	//Google Authenticator - OTMain
	public function googleAuthenticator(){
		//check checkSignin account AND checkStatus  -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}

		//load library Google 2FA
		$this->load->library('GoogleAuthenticator');
		//get info current user
		$user = $this->Auth->getInfoUser();
		//get info 2fa 
		if($user['is_enabled_2fa'] == 1){
			$user['2fa'] = json_decode($user['google_auth_code'],true);
		}

		//submit form
		if ($this->input->post()) {
			$jsonData2FA = $user['google_auth_code'];
			if($user['google_auth_code'] == ''){
				$secret = $this->googleauthenticator->createSecret();
				$qrCodeUrl = $this->googleauthenticator->getQRCodeGoogleUrl(APP_NAME, $user['email'], $secret);
				//push data into array
				$arrayData2FA = array(
					'secret' 	=> 	$secret,
					'qrCodeUrl'	=>	$qrCodeUrl
				);
				//convert data to json
				$jsonData2FA = json_encode($arrayData2FA);
			}

			//data update
			$data_update = array(
				'google_auth_code' 		=> 	$jsonData2FA,
				'is_enabled_2fa' 		=> 	1,
			);
			$rsResult = $this->UserModels->edit($data_update, $user['id']);
			if ($rsResult > 0) {
				$this->session->set_flashdata('security_success', 'Enabled Google Authenticator Successful!');
				redirect('dashboard/google-authenticator.html');
			} else {
				$this->session->set_flashdata('warning_already_security', 'Enabled Google Authenticator error!');
				redirect('dashboard/google-authenticator.html', $data);
			}
			
		} 
		//data push into view
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Google Authenticator',
			'user'			=>	$user,
			'template' 		=> 	'dashboard/auth/googleAuthenticator'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Enabled Google 2FA
	public function disabledGoogle2FA()
	{
		//check checkSignin account AND checkStatus  -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}

		//load library Google 2FA
		$this->load->library('GoogleAuthenticator');
		//get info current user
		$user = $this->Auth->getInfoUser();

		//submit form
		if ($this->input->post()) {
			//check Google 2FA
			$google_auth_code = $this->input->post('google_auth_code');
			//get info 2fa 
			$googleauthcodeArray = json_decode($user['google_auth_code'],true);
			$isValid = $this->googleauthenticator->verifyCode($googleauthcodeArray['secret'], $google_auth_code, 2);
			if (!$isValid) {
				$this->session->set_flashdata('warning_already', 'Invalid authenticator code');
				redirect(base_url().'dashboard/google-authenticator.html');
			}

			//data update
			$data_update = array(
				'is_enabled_2fa' 		=> 	0,
			);
			$rsResult = $this->UserModels->edit($data_update, $user['id']);
			if ($rsResult > 0) {
				$this->session->set_flashdata('security_success', 'Disabled Google Authenticator Successful!');
				redirect('dashboard/google-authenticator.html');
			} else {
				$this->session->set_flashdata('warning_already_security', 'Disabled Google Authenticator error!');
				redirect('dashboard/google-authenticator.html', $data);
			}
		}
	}

	//Update referent - OT1
	public function updateReferent(){
		//check checkSignin account AND checkStatus  -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		//check 
		$userID = $this->session->userdata('userID');
		$check_referentID = $this->UserModels->find($userID,'fullname,referentID','id');
		if($check_referentID['referentID']!=0){redirect(base_url().'dashboard');}
		if($this->input->post()){
			//validation
			$this->form_validation->set_rules('code','Referent Code','required|min_length[8]|callback_check_ReferentCode');
			if($this->form_validation->run()){
				$code = $this->input->post('code');
				if($code != '')
				{
					$get_User = $this->UserModels->find($code, 'id,code', 'code');
				}
				$data_updates = array(
					'referentID'		=>	$get_User['id'],
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModels->edit($data_updates, $userID, 'id');
				
				if($result['type'] == 'successful'){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update referent successful!!',
					));
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update referent error!!',
					));
					redirect('dashboard');
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Update referent',
			'template' 		=> 	'dashboard/auth/updateReferent'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Notify active account action - OT1
	public function activeAccount(){
		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		$id = $string[7];
		$result = $this->UserModels->edit(array('active' => 1), $id);
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
		$userID = $this->session->userdata('userID');
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
				$result = $this->UserModels->edit($data_update, $userID);
				if($result['type'] == 'successful'){
					$minID = $this->UserModels->select_row_min('tbl_wallet', 'id', array('userID' => 0));
					$data_update = array(
						'userID' 			=> 	$userID,
					);
					$getUserIDWallet = $this->WalletModels->find($userID, 'userID', 'userID');
					if($getUserIDWallet['userID'] != $userID){
						$updateWallet = $this->WalletModels->edit($data_update, $minID['id']);
					}
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update profile successful!!',
					));
					redirect(base_url().'dashboard/update-referent.html');
				}
				else
				{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update profile error!!',
					));
					redirect(base_url().'dashboard/update-referent.html');
				}
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Profile',
			'template' 		=> 	'dashboard/auth/profile'
		);
		$data['datas'] = $this->UserModels->find($userID); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//check Email Forget - OT1 
	public function check_EmailForget()
	{
		$email = $this->input->post('email');
		$result = $this->UserModels->find($email, 'email,type', 'email');
		if($result == NULL)
		{
			$this->form_validation->set_message(__FUNCTION__,'This email is not in the system!');
			return false;
		}
		else
		{
			if($result['type'] == 'user')
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message(__FUNCTION__,'This email is not in the system!');
				return false;
			}
		}
	}

	//Forger Password action
	public function forgetPass()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('email','Email','required|valid_email|min_length[8]|callback_check_EmailForget');
			//validate run
			if($this->form_validation->run()){
				//send mail (to active account) -OT1
				$this->load->library('email');

				$subject = 'mt7.com';
				$message = 'Message';
				$email = $this->input->post('email');
				$result = $this->UserModels->find($email, 'id', 'email');
				$id =$result['id'];
				$token = "pdq*42*grer*45*dfih*fhs*oa1*".$id."*sdf*481*156*hsd*f";
				$token = rtrim( strtr( base64_encode( $token ), '+/', '-_'), '=');
				
				// Get full html:
				$body = "<p>Hello!<br/>
						Please click on the link below to update your password.<br />
						Link:<a href='".base_url()."dashboard/update-password.html/".$token."'>
						http://mt7.com?update-forget-password.html=0KthjnNavRKKoMkG2oTpDIZpVTuCIZW7</a><br/>
						&nbsp;</p>
				";
				$result = $this->email
				    ->from('sentemail.optech@gmail.com')
				    ->reply_to('')    
				    ->to(trim($this->input->post('email'))) //
				    ->subject($subject)
				    ->message($body)
				    ->send();	
				if($result)
				{
					redirect('dashboard/notify-forget-password.html');
				}
			}
								
		}

		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Forget Password',
			'template' 		=> 	'dashboard/auth/forgetPass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	public function notifyForgetPass()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Notify',
			'template' 		=> 	'dashboard/auth/notifyForgetPass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	public function updatePass()
	{

		$token = $this->uri->segment(3);
		$encode = base64_decode($token);
		$string = explode("*", $encode);
		$id = $string[7];
		if($this->input->post()){
			$this->form_validation->set_rules('password','Password','required|min_length[8]');
			$this->form_validation->set_rules('re_password','Re-Password','required|min_length[8]|matches[password]');
			//validate run
			if($this->form_validation->run()){
				$rand_salt = $this->Encrypts->genRndSalt();
				$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
				$data_update = array(
					'password' 			=> 	$encrypt_pass,
					'salt' 				=>  $rand_salt,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->UserModels->edit($data_update, $id);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update password successful!!',
					));
					redirect('dashboard/home');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update password error!!',
					));
					redirect('dashboard/home');
				}
			}
								
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Update Password',
			'template' 		=> 	'dashboard/auth/updatePass'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}


	//check_Email - Ot1
	public function check_OldPassword(){
		$id = $this->session->userdata('userID');
		$where = array('email' => $Email);
		$result = $this->UserModels->find($id, 'salt,password');
		$rand_salt_old = $result['salt'];
		$oldpassword   = $result['password'];
		$oldpassword_post = $this->Encrypts->encryptUserPwd( $this->input->post('oldpassword'),$rand_salt_old);
		if($oldpassword == $oldpassword_post)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message(__FUNCTION__,'The old password incorrect!');
			return false;
		}

	}

	//Change Password -OT1
	public function changePass()
	{
		//check signUser account AND check status -OT1
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		if($this->input->post()){
			$this->form_validation->set_rules('oldpassword','Old Password','required|min_length[8]|callback_check_OldPassword');
			$this->form_validation->set_rules('password','New Password','required|min_length[8]');
			$this->form_validation->set_rules('re_password','Re-Password','required|min_length[8]|matches[password]');
			//validate run
			if($this->form_validation->run()){
				$rand_salt = $this->Encrypts->genRndSalt();
				$encrypt_pass = $this->Encrypts->encryptUserPwd( $this->input->post('password'),$rand_salt);
				$data_update = array(
					'password' 			=> 	$encrypt_pass,
					'text_pass' 		=>  $this->input->post('password'),
					'salt' 				=>  $rand_salt,
					'updated_at'		=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$id = $this->session->userdata('userID');
				$result = $this->UserModels->edit($data_update, $id);
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Change password successful!!',
					));
					redirect('dashboard/change-password.html');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Change password error!!',
					));
					redirect('dashboard/change-password.html');
				}
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
		if($this->Auth->checkSignin() === false){redirect(base_url().'dashboard');}
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
				$result = $this->UserModels->edit($data_update, $id);
				if($result>0){
					//$id = $result['id_insert'];
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update profile successful!!',
					));
					redirect(base_url().'dashboard');
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update profile error!!',
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
		$data['datas'] = $this->UserModels->find($id); 
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	
	//logout user - OT1
	function logout(){
		$this->session->unset_userdata('userID');
		redirect(base_url().'dashboard');
	}
}