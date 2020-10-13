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
		
}
