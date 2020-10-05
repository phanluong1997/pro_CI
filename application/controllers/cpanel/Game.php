<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends Admin_Controller {
	var	$table = 'tbl_game';
	public $part_url = 'cpanel/game/';
	public $template = 'cpanel/game/';
	public $path_dir = 'upload/game/';
	public	$path_dir_thumb = 'upload/game/thumb/';
	public $control = 'game';
	public function __construct(){
		parent::__construct();
		$this->load->model('GameModel');
	}
	//List action - OT2
	public function index()
	{
		// Check login
		if($this->Auth->check_logged()===false){redirect(base_url().'cpanel/login.html');}
		$datas = $this->GameModel->select_array('tbl_game','*',NULL,'id desc');
		
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Game Manager',
			'template' 	=> 	$this->template.'index',
			'control'	=>  $this->control,
			'path_url'	=> $this->path_url,
			'path_dir_thumb'=>$this->path_dir_thumb,
			'datas'		=>  $datas
		);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//add game -OT2
	public function add(){
		if($this->input->post()){
			if($_FILES["image"]["name"]){
				if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
				if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}

				$config['upload_path']	= $this->path_dir;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 5120;
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
				$name_image = $this->upload->do_upload("image");
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
				'name' 				=> 	trim($this->input->post('name')),
				'des'				=>trim($this->input->post('des')),
				'image' 			=>  $name_image,
				'thumb' 			=>  $name_thumb,
				'link'				=> trim($this->input->post('link')),
				'publish'			=> $publish,
				'created_at'		=> gmdate('Y-m-d H:i:s', time()+7*3600),
				'updated_at'		=> gmdate('Y-m-d H:i:s', time()+7*3600)

			);
			$result = $this->GameModel->add($this->table, $data_insert);
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Add data successfully!!',
				));
				redirect('cpanel/game/index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Add data unsuccess!!',
				));
				redirect('cpanel/game/index',$data);
			}
		}
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'				=>	'Game Add',
			'path_dir'			=> $this->path_dir,
			'path_dir_thumb'	=>	$this->path_dir_thumb
		);
		$data['template'] = 'cpanel/game/add';
		$this->load->view('cpanel/default/index',isset($data)?$data:NULL);
	}
	//edit game -OT2
	public function edit($id =0){
			$datas = $this->GameModel->select_row($this->table, '*', array('id' => $id));
			if($this->input->post()){
				if($_FILES["image"]["name"]){
					$file_image = $this->path_dir.$datas['image'];
					$file_image_thumb = $this->path_dir_thumb.$datas['thumb'];
					if($datas['image'] != ''){ unlink($file_image); }
					if($datas['thumb'] != ''){ unlink($file_image_thumb); }
					$config['upload_path']	= $this->path_dir;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = 5120;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$name_image = $this->upload->do_upload("image");
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
					$name_image = $datas['image'];
					$name_thumb = $datas['thumb'];
				}
				
				if($this->input->post('publish') != NULL){
					$publish = 1;
				}else{
					$publish = 0;
				}
				$data_update = array(
					'name' 				=> 	trim($this->input->post('name')),
					'des'				=>	trim($this->input->post('des')),
					'image' 			=>  $name_image,
					'thumb' 			=>  $name_thumb,
					'link'				=> trim($this->input->post('link')),
					'publish'			=> $publish,
					'created_at'		=> gmdate('Y-m-d H:i:s', time()+7*3600),
					'updated_at'		=> gmdate('Y-m-d H:i:s', time()+7*3600)

				);
				$result = $this->GameModel->edit($this->table, $data_update, array('id' => $id));
				if($result>0){
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'sucess',
						'message'	=> 'Update data successfully!!',
					));
					redirect('cpanel/game/index',$data);
				}else{
					$this->session->set_flashdata('message_flashdata', array(
						'type'		=> 'error',
						'message'	=> 'Update data unsuccess!!',
					));
					redirect('cpanel/game/index',$data);
				}
			}
			$data = array(
				'data_index'	=> $this->get_index(),
				'title'		=>	'Game Edit',
				'path_dir'			=> $this->path_dir,
				'path_dir_thumb'	=>	$this->path_dir_thumb,
				'datas'				=>	$datas,//note
				'template'			=>$this->template.'edit'
			);
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//delete game -OT2
	public function delete()
	{
		$id = $_POST['id'];
		$datas = $this->GameModel->select_row($this->table, '*', array('id' => $id));
		$file_image = $this->path_dir.$datas['image'];
		$file_thumb = $this->path_dir_thumb.$datas['thumb'];
		if($datas['image'] != ''){ unlink($file_image); }
		if($datas['thumb'] != ''){ unlink($file_thumb); }

		$this->GameModel->del($this->table,array('id' => $id));	 
	}
	//Change publish OT2
	public function publish()
	{
		$id = $_POST['id'];
		$publish = $_POST['publish'];
		$data_update['publish'] = $publish;
		$this->GameModel->edit('tbl_game', $data_update, array('id' => $id));
	}
}
?>
