<?php

class UserModel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	//checklogin(Auth.php) -Thao
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

	//add - Thao
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

	//checkValidate_Email - Thao
	function check_exists($where = array()){
		$this->db->where($where);
		$query = $this->db->get('tbl_user');
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//getAll- Thao
	function getAll($table = '', $data = NULL, $where = NULL, $order = 'id desc'){
		$result = $this->db->select($data)->from($table);
		if($where != NULL){
			$result = $this->db->where($where);
		}
		if($order != ''){
			$result = $this->db->order_by($order);
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

	function edit($table = '', $data = NULL, $where = NULL){
		$this->db->where($where)->update($table, $data);
		$flag = $this->db->affected_rows();
		if($flag > 0){
			return array(
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
	function del($table = '', $where = NULL){
		$this->db->delete($table, $where);
	}
}
