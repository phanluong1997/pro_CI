<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//My_Controller for module frontend
class MY_Controller extends CI_Controller {
	public function __construct(){
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		parent::__construct();
	}
	//Main Function
	protected function get_index(){
		// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
	 //        $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	 //        redirect($url);
	 //        exit;
	 //    }
		$data['logo'] = $this->get_logo();
		return $data;
	}
	//example function
	protected function get_logo(){
		$data = '';
		return $data;
	}
}


//My_Controller for module admin
class Admin_Controller extends CI_Controller {
	public function __construct(){
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		parent::__construct();

	}
	//Main Function
	protected function get_index(){
		$data['info_admin'] = $this->get_admin();
		return $data;
	}

	protected function get_admin(){
		if($this->Auth->check_logged()){
			$id_user = $this->Auth->logged_id();
			$data = $this->db->select('*')->from('tbl_user')->where('id', $id_user)->get()->row_array();
			return $data;
		}
	}
}

//My_Controller for module dashboard
class Dashboard_Controller extends CI_Controller {
	public function __construct(){
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		parent::__construct();

	}
	//Main Function
	protected function get_index(){
		$data['info_user'] = $this->get_user();
		return $data;
	}

	//get_user - OT1	
	// protected function check_StatusUser(){
	// 	$id_user = $this->Auth->userID();
	// 	$data = $this->db->select('*')->from('tbl_user')->where(array('id' => $id_user))->get()->row_array();
	// 	if($data['status'] == 0)
	// 	{
	// 		$this->session->unset_userdata('userID');
	// 	}
	// }

	//get_user - OT1	
	protected function get_user(){
		$id_user = $this->Auth->userID();
		$data = $this->db->select('*')->from('tbl_user')->where(array('id' => $id_user))->get()->row_array();
		return $data;
	}
}
