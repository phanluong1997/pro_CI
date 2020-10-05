<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends Admin_Controller {
	public $template = 'cpanel/transfer/';
	public function __construct(){
		parent::__construct();
		$this->load->model('transfermodel');
	}
	//List action -OT2
	public function index()
	{
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//get data
		$datas= $this->transfermodel->select_array('tbl_transfer','*',NULL,'id desc');
		//get fullname in table tbl_user
		if($datas != NULL){
			foreach ($datas as $key => $val) {
				$user_nameSender = '';
				$infouserSender = $this->transfermodel->select_row('tbl_user', 'fullname', array('id' => $val['userID_sender']));

				$user_nameReceived = '';
				$infouserReceived = $this->transfermodel->select_row('tbl_user', 'fullname', array('id' => $val['userID_received']));

				if($infouserSender && $infouserReceived != NULL){
					$user_nameSender = $infouserSender['fullname'];
					$user_nameReceived = $infouserReceived['fullname'];
				}
				$datas[$key]['user_nameSender'] = $user_nameSender;
				$datas[$key]['user_nameReceived'] = $user_nameReceived;
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Transfer Manager',
			'template' 	=> 	$this->template.'index',
			'datas'		=> $datas
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
}
