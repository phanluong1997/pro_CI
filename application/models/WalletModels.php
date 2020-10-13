<?php 
class WalletModels extends MY_Model {
	public $table = 'tbl_wallet';
	function __construct()
	{
		parent::__construct();
	}
	
	//select row -> get value. - OT2
	// function select_row($table = '', $data = NULL, $where = NULL, $order = ''){
	// 	$result = $this->db->select($data)->from($table);
	// 	if($where != NULL){
	// 		$result = $this->db->where($where);
	// 	}
	// 	if($order!=''){
	// 		$result = $this->db->order_by($order);
	// 	}
	// 	$result = $this->db->get()->row_array();
	// 	return $result;
	// }
	//check validate field wallet - OT2
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

	// function edit($table = '', $data = NULL, $where = NULL){
	// 	$this->db->where($where)->update($table, $data);
	// 	$flag = $this->db->affected_rows();
	// 	if($flag > 0){
	// 		return array(
	// 			'id_insert'	=> $insert_id,
	// 			'type'		=> 'successful',
	// 			'message'	=> 'Update success!',
	// 		);
	// 	}
	// 	else
	// 	{
	// 		return array(
	// 			'type'		=> 'error',
	// 			'message'	=> 'Update error!',
	// 		);
	// 	}
	// }

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
