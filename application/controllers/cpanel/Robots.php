<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robots extends Admin_Controller {
	public $control = 'robots';
	public $template = 'cpanel/robots/';

	public function __construct(){
		parent::__construct();
		$this->load->model('RobotsModel');
	}

	public function index(){

		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}

		$datas = $this->RobotsModel->select_array('tbl_robots','*',NULL,'id desc');
		
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Robots Manager',
			'datas'		=>  $datas,
			'control'	=>  $this->control,
			'template'	=> $this->template.'index'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//function check duplicate robots ! - OT2
	public function check_fullname(){
		$fullname = $this->input->post('fullname');
		$where = array('fullname' => $fullname);
		//check exists
		if($this->RobotsModel->check_exists($where))
		{
			//infor bug
			$this->form_validation->set_message(__FUNCTION__,' Fullname is Exist ');
			return false;
		}
		return true;
	} 
	//add OT2
	public function add()
	{
		//Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		//check validate robots
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			$this->form_validation->set_rules('fullname','Fullname','required|min_length[2]|callback_check_fullname');

			if($this->form_validation->run()){
				if($this->input->post('publish') != NULL){
					$publish = 1;
				}else{
					$publish = 0;
				}
				$data_insert = array(
					'fullname' => trim($this->input->post('fullname')),
					'publish' => 	$publish,
					'created_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);

				$result = $this->RobotsModel->add('tbl_robots', $data_insert);
			
					if($result>0){
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'sucess',
							'message'	=> 'Add data success!!',
						));
						redirect('cpanel/robots/index',$data);
					}else{
						$this->session->set_flashdata('message_flashdata', array(
							'type'		=> 'error',
							'message'	=> 'Add data unsuccess!!',
						));
						redirect('cpanel/robots/index',$data);
					}
			}	
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Add New',
			'template' 	=> 	$this->template.'add'
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//Edit actions -OT2
	public function edit($id = 0)
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$datas = $this->RobotsModel->select_row('tbl_robots','*',array('id' =>$id));
		//Check validate robots
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post()){
			$this->form_validation->set_rules('fullname','Fullname','required|min_length[2]|callback_check_fullname');

			if($this->form_validation->run()){
				if($this->input->post('publish') != NULL){
					$publish = 1;
				}else{
					$publish = 0;
				}
				$data_update = array(
					'fullname' => trim($this->input->post('fullname')),
					'publish' => 	$publish,
					'created_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600)
				);
				$result = $this->RobotsModel->edit('tbl_robots', $data_update,array('id' =>$id));
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update data success!!',
					));
					redirect('cpanel/robots/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Updata data unsuccess!!',
					));
					redirect('cpanel/robots/index',$data);
				}
			}	
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Edit Robots',
			'template' 	=> 	$this->template.'edit',
			'datas'		=> $datas
		);
		
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//delete OT2
	public function delete()
	{
		//Check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		// processed delete.
		$id = $_POST['id'];
		$this->RobotsModel->del('tbl_robots',array('id' => $id));
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}


	//Change publish OT2
	public function publish()
	{
		$id = $_POST['id'];
		$publish = $_POST['publish'];
		$data_update['publish'] = $publish;
		$this->RobotsModel->edit('tbl_robots', $data_update, array('id' => $id));
	}

}
?>
