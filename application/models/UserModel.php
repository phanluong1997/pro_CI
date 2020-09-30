<?php

class UserModel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	//checklogin(Auth.php) -Ot1
	function getAdmin($table = '', $data = NULL, $where = NULL, $order = ''){
		$result = $this->db->select($data)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		if($order!=''){
			$result = $this->db->order_by($order);
		}
		$result = $this->db->get()->row_array();
		return $result;
	}

	//checklogin(Auth.php) -Ot1
	function getUser($table = '', $data = NULL, $where = NULL, $order = ''){
		$result = $this->db->select($data)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		if($order!=''){
			$result = $this->db->order_by($order);
		}
		$result = $this->db->get()->row_array();
		return $result;
	}

	//add - Ot1
	function add($table = '', $data = NULL){
		$this->db->insert($table, $data);
		$flag = $this->db->affected_rows();
		$insert_id = $this->db->insert_id();
		if($flag > 0){
			return array(
				'id_insert'	=> $insert_id,
				'type'		=> 'successful',
				'message'	=> 'Add data success!',
			);
		}
		else
		{
			return array(
				'type'		=> 'error',
				'message'	=> 'Add data error!',
			);
		}
		
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
	//getAll- Ot1 -- //OT2 add value $start , $limit.
	function getAll($table = '', $data = NULL, $where = NULL, $order = 'id desc', $start = '', $limit = ''){ 
		$result = $this->db->select($data)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		if($order != ''){
			$result = $this->db->order_by($order);
		}
		if($limit != ''){
			$result = $this->db->limit($limit, $start);
		}
		$result = $this->db->get()->result_array();
		return $result;
	}

	function select_row($table = '', $data = NULL, $where = NULL, $order = ''){
		$result = $this->db->select($data)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		if($order!=''){
			$result = $this->db->order_by($order);
		}
		$result = $this->db->get()->row_array();
		return $result;
	}
	//edit user
	function edit($table = '', $data = NULL, $where = NULL){
		$this->db->where($where)->update($table, $data);
		$flag = $this->db->affected_rows();
		if($flag > 0){
			return array(
				'id_insert'	=> $insert_id,
				'type'		=> 'successful',
				'message'	=> 'Update success!',
			);
		}
		else
		{
			return array(
				'type'		=> 'error',
				'message'	=> 'Update error!',
			);
		}
	}
	//delete user
	function del($table = '', $where = NULL){
		$this->db->delete($table, $where);
	}

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
