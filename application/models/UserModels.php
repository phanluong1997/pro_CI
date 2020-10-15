<?php

class UserModels extends MY_Model {

	public $table = 'tbl_user';

	function __construct()
	{
		parent::__construct();
	}
	//checkValidate_Email - Ot1
	function check_exists($where = array()){
		$this->db->where($where);
		$query = $this->db->get('tbl_user');
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//checkEmail - Login Google - Ot1
	function check_exists_google($where = array()){
		$this->db->where($where);
		$query = $this->db->get('tbl_user');
		if($query->num_rows() > 0){
			return array(
				'type'		=> 'successful',
				'message'	=> 'Add data success!',
			);
		}else{
			return array(
				'type'		=> 'error',
				'message'	=> 'Add data error!',
			);
		}
	}
	//select_row_max -OT1
	function select_row_min($table = '', $field_min = '',$where = NULL ){
		$result = $this->db->select_min($field_min)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		$result = $this->db->get()->row_array();
		return $result;
	}
	//total (Dashboarr/Auths) -OT1
	function total($table,$where = NULL){
		$result = $this->db->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		$result = $this->db->count_all_results();
		return $result;
	}
	// Search data users -OT2
	function getSearch($query){ 
		$sql = $this->db->query("SELECT * FROM `tbl_user` WHERE type = 'user' AND  (email LIKE '%$query%' or phone LIKE '%$query%')");
		$query = $sql->result_array();				
		return $query;
	}
	function total_where_in($table,$where = NULL){
		$result = $this->db->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		$result = $this->db->count_all_results();
		return $result;
	}
	function _pagination()
	{
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		$config['next_tag_open'] = '<li class="paginate_button next">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] = '<li class="paginate_button previous">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="paginate_button active"><a class="number current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['num_links'] = 5;
		$config['uri_segment'] = 4;

		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		return $config;
	}
		
}
