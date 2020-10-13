<?php
class WithdrawModels extends MY_Model {
	public $table = 'tbl_withdraw';
	function __construct()
	{
		parent::__construct();
		$this->load->model('settingmodel');
	}
	
	//get data to setting - OTMain
	public function getSetting()
	{
		$data = $this->settingmodel->select_row('tbl_config', 'content', array('key' => 'wallet'));
		return json_decode($data['content'],true);
	}
}
?>
