<?php

class User extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	//add account admin
	function addAdmin($table = '', $data = NULL){
		$this->db->insert($table, $data);
		$flag = $this->db->affected_rows();
		$insert_id = $this->db->insert_id();
		
	}

	//checkValidateEmail
	function check_exists($where = array()){
		$this->db->where($where);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//get list admin
	// function getAdmin($table = '', $data = NULL, $where = NULL, $order = 'id desc'){
	// 	$result = $this->db->select($data)->from($table);
	// 	if($where != NULL){
	// 		$result = $this->db->where($where);
	// 	}
	// 	if($order != ''){
	// 		$result = $this->db->order_by($order);
	// 	}
	// 	$result = $this->db->get()->result_array();
	// 	return $result;
	// }
}
