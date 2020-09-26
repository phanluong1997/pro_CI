<?php
class WithdrawModel extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	//select row -> get value. - OT2
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
	//select arr - in Table withdraw.-OT2
	function select_array($table = '', $data = NULL, $where = NULL, $order = 'id desc', $start = '', $limit = ''){
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
	//update status withdraw -OT2
	function edit($table = '', $data = NULL, $where = NULL){
		$this->db->where($where)->update($table, $data);	
		$flag = $this->db->affected_rows();
		if($flag > 0){
			return array(
				'type'		=> 'successful',
				'message'	=> 'Update Success!',
			);
		}
		else
		{
			return array(
				'type'		=> 'error',
				'message'	=> 'Update unsuccess!',
			);
		}
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
	//getAll- Ot1
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
}
?>
