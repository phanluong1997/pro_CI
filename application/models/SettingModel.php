<?php
class SettingModel extends CI_Model {
	
	
	function __construct()
	{
		parent::__construct();
	}
	//select row -> get value. - OTMain
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
	//update date -OTMain
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
}
?>
