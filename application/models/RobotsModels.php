<?php 
class RobotsModels extends MY_Model {
	public $table = 'tbl_robots';
	function __construct()
	{
		parent::__construct();
	}
	//check fullname OT1
	function check_exists($where = array())
	{
		$this->db->where($where);
		$query = $this->db->get('tbl_robots');
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
