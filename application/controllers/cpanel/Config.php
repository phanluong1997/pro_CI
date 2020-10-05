<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin_Controller {
	//Config Module
	public $table = 'tbl_config';
	public function __construct(){
		parent::__construct();
		$this->load->model('settingmodel');
	}
	public function __destruct(){
	}
	public function index()
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		//get row data config system
		$system = $this->settingmodel->select_row($this->table, 'content', array('key' => 'system'));
		$system = json_decode($system['content'],true);
		//get row data config deposite
		$deposite = $this->settingmodel->select_row($this->table, 'content', array('key' => 'deposite'));
		$deposite = json_decode($deposite['content'],true);
		//get row data config wallet
		$wallet = $this->settingmodel->select_row($this->table, 'content', array('key' => 'wallet'));
		$wallet = json_decode($wallet['content'],true);
		//push data to view
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'			=>	'Setting',
			'system'		=>	$system,
			'wallet'		=>	$wallet,
			'deposite'		=>	$deposite,
			'template' 		=> 	'cpanel/config/index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	public function system()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){

			//convert data array to json
			$array_content = array(
				'title'	=>	$this->input->post('title'),
			);
			$json_content = json_encode($array_content);

			//data update
			$data_update = array(
				'content'	=>	$json_content,
			);
			$result = $this->settingmodel->edit($this->table, $data_update,array('key' =>'system'));
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Update data success!!',
				));
				redirect('cpanel/config/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Updata data unsuccess!!',
				));
				redirect('cpanel/config/index',$data);
			}
		}
	}
	public function deposite()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){

			//convert data array to json
			$array_content = array(
				'address_eth'	=>	$this->input->post('address_eth'),
				'address_usdt'	=>	$this->input->post('address_usdt'),
			);
			$json_content = json_encode($array_content);

			//data update
			$data_update = array(
				'content'	=>	$json_content,
			);
			$result = $this->settingmodel->edit($this->table, $data_update,array('key' =>'deposite'));
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Update data success!!',
				));
				redirect('cpanel/config/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Updata data unsuccess!!',
				));
				redirect('cpanel/config/index',$data);
			}
		}
	}
	public function wallet()
	{
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		if($this->input->post()){

			//convert data array to json
			$array_content = array(
				'amount_min_withdraw'	=>	$this->input->post('amount_min_withdraw'),
				'cost_withdraw'	=>	$this->input->post('cost_withdraw'),
			);
			$json_content = json_encode($array_content);

			//data update
			$data_update = array(
				'content'	=>	$json_content,
			);
			$result = $this->settingmodel->edit($this->table, $data_update,array('key' =>'wallet'));
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Update data success!!',
				));
				redirect('cpanel/config/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Updata data unsuccess!!',
				));
				redirect('cpanel/config/index',$data);
			}
		}
	}
}
