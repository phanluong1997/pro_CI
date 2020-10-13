<?php
class TransferModels extends MY_Model {
	public $table ='tbl_transfer';
	function __construct()
	{
		parent::__construct();
	}
	//add transfer --OT2
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
	//update  data -OT2
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
