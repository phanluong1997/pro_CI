<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robots extends Admin_Controller {
	public $control = 'robots';
	public $template = 'cpanel/robots/';
	public $path_dir = 'upload/robots/';
	public	$path_dir_thumb = 'upload/robots/thumb/'; 

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
			'path_url'	=> $this->path_url,
			'path_dir_thumb'=>$this->path_dir_thumb,
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
				if($_FILES["avatar"]["name"]){
					if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
					if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}
	
					$config['upload_path']	= $this->path_dir;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = 5120;
					$this->load->library('upload', $config);
	
					$this->upload->initialize($config);
					$name_image = $this->upload->do_upload("avatar");
					$image_data = $this->upload->data();
					$name_image = $image_data['file_name'];
					//Create thumb in Ci
					$this->load->library('image_lib');
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $this->path_dir.$image_data['file_name'];
					$config['new_image'] 		= $this->path_dir_thumb.$image_data['file_name'];
					$config['create_thumb'] 	= TRUE;
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] = 400;
	
					$ar_name_image = explode('.',$image_data['file_name']);
					$name_thumb = $ar_name_image[0].'_thumb.'.$ar_name_image[1];
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}else{
					$name_image = '';
					$name_thumb = '';
				}
				if($this->input->post('publish') != NULL){
					$publish = 1;
				}else{
					$publish = 0;
				}
				$data_insert = array(
					'fullname' => trim($this->input->post('fullname')),
					'avatar' 			=>  $name_image,
					'thumb' 			=>  $name_thumb,
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
			'path_dir'			=> $this->path_dir,
			'path_dir_thumb'	=>	$this->path_dir_thumb,
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
	
		if($this->input->post()){
			if($_FILES["avatar"]["name"]){
				$file_image = $this->path_dir.$datas['avatar'];
				$file_image_thumb = $this->path_dir_thumb.$datas['thumb'];
				if($datas['avatar'] != ''){ unlink($file_image); }
				if($datas['thumb'] != ''){ unlink($file_image_thumb); }
				$config['upload_path']	= $this->path_dir;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 5120;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$name_image = $this->upload->do_upload("avatar");
				$image_data = $this->upload->data();
				$name_image = $image_data['file_name'];
				//Create thumb in Ci
				$this->load->library('image_lib');
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $this->path_dir.$image_data['file_name'];
				$config['new_image'] 		= $this->path_dir_thumb.$image_data['file_name'];
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] = 400;

				$ar_name_image = explode('.',$image_data['file_name']);
				$name_thumb = $ar_name_image[0].'_thumb.'.$ar_name_image[1];
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}else{
				$name_image = $datas['avatar'];
				$name_thumb = $datas['thumb'];
			}
			if($this->input->post('publish') != NULL){
				$publish = 1;
			}else{
				$publish = 0;
			}
			$data_update = array(
				'fullname'  => trim($this->input->post('fullname')),
				'avatar' 	=>  $name_image,
				'thumb' 	=>  $name_thumb,
				'publish'	=> 	$publish,
				'created_at'=>	gmdate('Y-m-d H:i:s', time()+7*3600),
				'updated_at'=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->RobotsModel->edit('tbl_robots', $data_update,array('id' =>$id));
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'success',
					'message'	=> 'Update data success!!',
				));
				redirect('cpanel/robots/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Update data unsuccess!!',
				));
				redirect('cpanel/robots/index',$data);
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Edit Robots',
			'template' 	=> 	$this->template.'edit',
			'path_dir'			=> $this->path_dir,
			'path_dir_thumb'	=>	$this->path_dir_thumb,
			'datas'		=> $datas
		);
		
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//delete game -OT2
	public function delete()
	{
		$id = $_POST['id'];
		$datas = $this->RobotsModel->select_row('tbl_robots', '*', array('id' => $id));
		$file_image = $this->path_dir.$datas['avatar'];
		$file_thumb = $this->path_dir_thumb.$datas['thumb'];
		if($datas['avatar'] != ''){ unlink($file_image); }
		if($datas['thumb'] != ''){ unlink($file_thumb); }

		$this->RobotsModel->del('tbl_robots',array('id' => $id));	 
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
