<?php
class Auth extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
	}
	//Login admin
	function process_login($login_array_input = NULL){
		if(!isset($login_array_input) OR count($login_array_input) != 3)
			return false;
		$email = $login_array_input[0];
		$password = $login_array_input[1];
		$type = $login_array_input[2];
		$query = $this->db->query("SELECT * FROM tbl_admin WHERE email= '".$email."' AND  type= '".$type."'  AND active = 1 LIMIT 1");
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			$user_id = $row->id;
			$user_pass = $row->password;
			$user_salt = $row->salt;
			if($this->Encrypts->encryptUserPwd($password,$user_salt) === $user_pass){
				$this->session->set_userdata('logged_user', $user_id);
				return true;
			}
			return false;
		}
		return false;
	}
	
	function check_logged(){
		return ($this->session->userdata('logged_user'))?TRUE:FALSE;
	}
	function logged_id(){
		return ($this->check_logged())?$this->session->userdata('logged_user'):'';
	}
	function logged_info(){
		return $this->UserModel->getAdmin('tbl_admin', '*', array('id' => $this->session->userdata('logged_user')));
	}


	//Login user
	function signUser($login_array_input = NULL){
		if(!isset($login_array_input) OR count($login_array_input) != 2)
			return false;
			//Connect db AU
			$autokendb = $this->load->database('autokendb', TRUE);
			$username = $login_array_input[0];
			$password = $login_array_input[1];
			$result = $autokendb->select('id,password,salt')->from('tbl_user')->where(array('username' => $username,'active >' => 0))->get()->row_array();
			if ($result != NULL)
			{
				$user_id = $result['id'];
				$user_pass = $result['password'];
				$user_salt = $result['salt'];
				if($this->CI_encrypts->encryptUserPwd($password,$user_salt) === $user_pass){
					$this->session->set_userdata('userID', $user_id);
					return true;
				}
				return false;
			}
		return false;
	}
	function checkSignin(){
		return ($this->session->userdata('userID'))?TRUE:FALSE;
	}
	function userID(){
		return ($this->checkSignin())?$this->session->userdata('userID'):'';
	}
	function getInfoUser(){
		$autokendb = $this->load->database('autokendb', TRUE);
		return $autokendb->select('*')->from('tbl_user')->where(array('id' => $this->session->userdata('userID')))->get()->row_array();
	}
}
