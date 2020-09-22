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
		$query = $this->db->query("SELECT * FROM tbl_user WHERE email= '".$email."' AND  type= '".$type."'  AND active = 1 LIMIT 1");
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
		return $this->UserModel->getAdmin('tbl_user', '*', array('id' => $this->session->userdata('logged_user')));
	}


	//checkEmail+Password User - OT1
	function checkInfoUser($login_array_input = NULL){
		if(!isset($login_array_input) OR count($login_array_input) != 3)
			return false;
			$email = $login_array_input[0];
			$password = $login_array_input[1];
			$type 	  = $login_array_input[2];
			$query = $this->db->query("SELECT * FROM tbl_user WHERE email= '".$email."' AND  type= '".$type."' LIMIT 1");
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				$user_id = $row->id;
				$user_pass = $row->password;
				$user_salt = $row->salt;
				if($this->Encrypts->encryptUserPwd($password,$user_salt) === $user_pass){
					return true;
				}
				return false;
			}
		return false;
	}

	//Login user
	function signUser($login_array_input = NULL){
		if(!isset($login_array_input) OR count($login_array_input) != 3)
			return false;
			$email = $login_array_input[0];
			$password = $login_array_input[1];
			$type 	  = $login_array_input[2];
			$query = $this->db->query("SELECT * FROM tbl_user WHERE email= '".$email."' AND  type= '".$type."'  AND active = 1 LIMIT 1");
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				$user_id = $row->id;
				$user_pass = $row->password;
				$user_salt = $row->salt;
				if($this->Encrypts->encryptUserPwd($password,$user_salt) === $user_pass){
					//check null fullname and phone - OT1
					if($row->fullname == NULL OR $row->phone == NULL OR $row->active == 0)
					{
						return false;
					}
					else
					{
						$this->session->set_userdata('userID', $user_id);
						return true;
					}
					
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
		return $this->UserModel->getUser('tbl_user', '*', array('id' => $this->session->userdata('userID')));
	}
}
