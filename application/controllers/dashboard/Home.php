<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModels');
		$this->load->model('GameModels');
	}
	//Main action
	public function index()
	{	
		//check signUser account -OT1
		if($this->Auth->checkStatus() === true){redirect(base_url().'dashboard/update-profile.html');}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		//START - OT1
		$data['referentID'] = $this->get_referentID();
		$userID = $this->session->userdata('userID');
		if($userID != ''){
			$data['datas'] = $this->UserModels->find($userID);
		}
		//END START - OT1 
		//START - OT2
		$data['getGame'] = $this->GameModels->findWhere(array('publish'=>1));
		//END START -OT2
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//get_referentID - OT1
	public function get_referentID()
	{
		$userID = $this->session->userdata('userID');
		if($userID != ''){
			$referentID = $this->UserModels->find($userID,'id,referentID');
			$get_User = $this->UserModels->find($referentID['referentID']);
			$referentID['fullname'] = $get_User['fullname'];
		}
		return $referentID;
	}  
	
}


