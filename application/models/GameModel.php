<?php 
class GameModel extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	//add game -OT2
	public function add($table='',$data = NULL){
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
				'message'	=> 'Add data unsuccess!',
			);
		}
	}
	//edit game --OT2
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
	//delete -ot2
	function del($table = '', $where = NULL){
		$this->db->delete($table, $where);
	}
	//select arr - in Table tbl_game.-OT2
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


}
?>	
