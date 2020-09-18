<?php 
class WalletModel extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	//add model - Luong
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
	//edit model-luong
	function edit($table = '', $data = NULL, $where = NULL){
		$this->db->where($where)->update($table, $data);
		$flag = $this->db->affected_rows();
		if($flag > 0){
			return array(
				'type'		=> 'successful',
				'message'	=> 'Update data success!',
			);
		}
		else
		{
			return array(
				'type'		=> 'error',
				'message'	=> 'Update data unsuccess!',
			);
		}
	}
	//delete model-luong
	function del($table = '', $where = NULL){
		$this->db->delete($table, $where);
	}
	
	//select arr - in Table wallet.-luong
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
	//select row -> get value.
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

	//check validate field wallet - Luong
	function check_exists($where = array())
	{
		$this->db->where($where);
		$query = $this->db->get('tbl_wallet');
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
}

?>
