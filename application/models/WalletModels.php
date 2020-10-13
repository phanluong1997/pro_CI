<?php 
class WalletModels extends MY_Model {
	public $table = 'tbl_wallet';
	function __construct()
	{
		parent::__construct();
	}
	
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
	
}

?>
