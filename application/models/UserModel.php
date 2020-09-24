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
	//fetch data users -OT2
	public function fetch_data($query){
		$type = 'user';
		$this->db->select('*');
		$this->db->from('tbl_user');
		if($query!=''){
			 $this->db->like('email',$query);
			 $this->db->or_like('phone',$query);
		}
		$this->db->where('type',$type);
		$this->db->order_by('id','DES');
		return $this->db->get();
		
	}
}
