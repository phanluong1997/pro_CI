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
		$userID = $this->session->userdata('userID');
		$data['datas'] = $this->UserModel->select_row('tbl_user', '*', array('id' => $userID));
		//call data of history(); --OT2 
		//START -OT2
		$data['historyTransfer']=$this->history();
		//END - OT2
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}
	// get data table tbl_transfer--OT2
	public function history(){
		// get data
		$userID = $this->session->userdata('userID');
		// $data= $this->transfermodel->getAll('tbl_transfer','*',array('userID_sender'=>$userID,'userID_received'=>$userID),'id desc ');
		$data = $this->db->select('*')->from('tbl_transfer')->where(array('userID_sender' => $userID))->or_where(array('userID_received'=>$userID))->get()->result_array();
		// var_dump($data);
		$userID = $this->session->userdata('userID');
		// if($data['datas'] != NULL){
			foreach ($data as $key => $val) {
				$user_nameSender = '';
				$user_nameReceived='';
				$resultSender = $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_sender']));

				$resultReceived =  $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_received']));
				if($val['userID_sender'] == $resultSender['id']  ){
					$data[$key]['user_nameSender'] = $resultSender['fullname'];
					if($val['userID_received']== $resultReceived['id']){
						$data[$key]['user_nameReceived'] = $resultReceived['fullname'];
					}
				}				
			}
		// }
		// var_dump($data); die;
		return $data['datas'] = $data ;
	}
}


