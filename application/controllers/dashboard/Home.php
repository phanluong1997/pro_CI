<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('transfermodel');
		$this->load->model('WithdrawModel');
		$this->load->model('GameModel');
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
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $userID));
		//END START - OT1 
		//START - OT2
		$data['getGame'] = $this->GameModel->select_array('tbl_game','*',array('publish'=>1),'id desc');
		//END START -OT2
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	//get_referentID - OT1
	public function get_referentID()
	{
		$userID = $this->session->userdata('userID');
		$referentID = $this->WithdrawModel->select_row('tbl_user','id,referentID',array('id' =>$userID));
		$get_User = $this->WithdrawModel->select_row('tbl_user','*',array('id' =>$referentID['referentID']));
		$referentID['fullname'] = $get_User['fullname'];
		return $referentID;
	}  
	
}


