<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends Admin_Controller {
	public $table = 'game';
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
		
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Game Manager',
			'template' 	=> 	$this->template.'index',
			'control'	=>  $this->control,
			'path_url'	=> $this->path_url,
			'path_dir_thumb'=>$this->path_dir_thumb
		);
		$data['datas'] = $this->GameModel->select_array('tbl_game','*',NULL,'id desc');

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	public function add(){

		$data = array(
			'title'		=>	'Game ADD'
			
		);
		$data['template'] = 'cpanel/game/add';
		
		if($this->input->post()){
			if($_FILES["image"]["name"]){
				if (!is_dir($this->path_dir)){mkdir($this->path_dir);}
				if (!is_dir($this->path_dir_thumb)){mkdir($this->path_dir_thumb);}
				$config['upload_path']	= $this->path_dir;//đường dẫn chứa file
				$config['allowed_types'] = 'jpg|png|jpeg|gif';//cấu hình định dạng của ảnh.
				$config['max_size'] = 5120;//Dung lượng tối đa
				//load thư viện
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
				$image = $this->upload->do_upload("image");
				//chứa mảng thông tin
				$image_data = $this->upload->data();

				// print_r($image_data);

				$name_image = $image_data['file_name'];
				print_r($name_image);
			//Create thumb trong Ci
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

			$price = str_replace(',', '',$this->input->post('price'));
			$data_insert = array(
				'name' 				=> 	trim($this->input->post('name')),
				'price'				=>	$price,
				'image' 			=>  $name_image,
				'thumb' 			=>  $name_thumb
			
			);
			$result = $this->user_model->add($this->table, $data_insert);
			if($result>0){
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'sucess',
					'message'	=> 'Thêm mới thành công!!',
				));
				redirect(''.$this->path_url.'index',$data);
			}else{
				$this->session->set_flashdata('message_flashdata', array(
					'type'		=> 'error',
					'message'	=> 'Thêm mới lỗi!!',
				));
				redirect(''.$this->path_url.'index',$data);
			}
		}

		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
		
	}
	public function edit(){
		$data = array(
			'title'		=>	'Game Edit'
			
		);
		$data['template'] = 'cpanel/game/edit';
		$this->load->view('cpanel/default/index', isset($data)?$data:NULL);
	}
	//Change publish
	public function publish()
	{
		//check login
		if($this->Auth->check_logged() === false){redirect(base_url().'cpanel/login.html');}
		$id = $_POST['id'];
		$active = $_POST['publish'];
		$data_update['publish'] = $publish;
		$this->GameModel->edit('tbl_gamer', $data_update, array('id' => $id));
	}

}
?>
