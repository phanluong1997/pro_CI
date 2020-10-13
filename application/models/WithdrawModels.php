<?php
class WithdrawModels extends MY_Model {
	public $table = 'tbl_withdraw';
	function __construct()
	{
		parent::__construct();
		$this->load->model('settingmodel');
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
	//get data to setting - OTMain
	public function getSetting()
	{
		$data = $this->settingmodel->select_row('tbl_config', 'content', array('key' => 'wallet'));
		return json_decode($data['content'],true);
	}
}
?>
