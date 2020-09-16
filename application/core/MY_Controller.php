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


//My_Controller for module backend
class Admin_Controller extends CI_Controller {
	public function __construct(){
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		parent::__construct();

	}
	//Main Function
	protected function get_index(){
		return $data;
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
		return $data;
	}
}
