<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Transfer extends Dashboard_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('depositmodel');
		}	
		

	}	

?>
