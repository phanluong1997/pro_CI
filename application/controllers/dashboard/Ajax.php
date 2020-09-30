<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Dashboard_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('transfermodel');
		$this->load->model('depositmodel');
	}
	//get data table tbl_transfer--OT2
	public function historyTransfer(){
			// get data
			$userID = $this->session->userdata('userID');
			$dataTransfer = $this->db->select('*')->from('tbl_transfer')->where(array('userID_sender' => $userID))->or_where(array('userID_received'=>$userID))->get()->result_array();
			$userID = $this->session->userdata('userID');
				foreach ($dataTransfer as $key => $val) {
					$user_nameSender = '';
					$user_nameReceived='';
					$resultSender = $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_sender']));
					$resultReceived =  $this->transfermodel->select_row('tbl_user','id,fullname', array('id' => $val['userID_received']));
					if($val['userID_sender'] == $resultSender['id']  ){
						$dataTransfer[$key]['user_nameSender'] = $resultSender['fullname'];
						if($val['userID_received']== $resultReceived['id']){
							$dataTransfer[$key]['user_nameReceived'] = $resultReceived['fullname'];
						}
					}				
				}
		$output = '';
		foreach($dataTransfer as $row){
			$amount ='';
			$status =''; 
			if($row['userID_received'] == $this->session->userdata('userID')){ $amount = '<span class="text-success">'.'+ $'.$row['amount'].'</span>'   ;}	
			else{ $amount ='<span class="text-danger">'.'- $'.$row['amount'].'</span>' ; }
			if($row['status'] == 1){ $status = 'Success'; }	
			$output .= '<tr>
							<td class="text-left">'.$row['user_nameSender'].'</td>
							<td class="text-"left">'.$row['user_nameReceived'].'</td>
							<td class="text-"left>
								'.$amount.'
							<td class="text-"left>'.$row['date'].'</td>
							<td class="text-center">
							<span class="text-success">'.$status.'</span>
							</td>
						</tr>';
		}	
		echo $output;
	}
	//history Deposte --OT2
	public function historyDeposite(){
		
		$userID = $this->session->userdata('userID');
		$dataDeposite = $this->db->select('*')->from('tbl_deposit')->where(array('userID' => $userID))->get()->result_array();
		
		foreach ($dataDeposite as $key => $val) {
			$user_nameDeposite = '';
			$result = $this->depositmodel->select_row('tbl_user','id,fullname', array('id' => $val['userID']));
			if($val['userID'] == $result['id']  ){
				$dataDeposite[$key]['user_nameDeposite'] = $result['fullname'];
			}
		}
	
		$output='';
			foreach($dataDeposite as $key => $row){
				$status ='';
				if($row['status'] == 1){ $status = 'Success'; }
				$output .= '<tr>
								<td>'.$row['user_nameDeposite'].'</td>
								<td class="currency"><span class="text-success">+ $ '.$row['amount'].'</span></td>
								<td class="text-"left>'.$row['date'].'</td>
								<td><span class="text-success">'.$status.'</span></td>
							</tr>
				';
			}	
		echo $output;
		

	}

}
?>
