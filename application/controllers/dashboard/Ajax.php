<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Dashboard_Controller {
	public function __construct(){
		parent::__construct();
		//get
		$this->load->model('TransferModels');
		$this->load->model('UserModels');
		$this->load->model('WithdrawModels');
		$this->load->model('SettingModels');
	}
	//get data table tbl_transfer--OT2
	public function historyTransfer(){
		// get data
		$userID = $this->session->userdata('userID');
		$dataTransfer = $this->db->select('*')->from('tbl_transfer')->where(array('userID_sender' => $userID))->or_where(array('userID_received'=>$userID))->order_by('id desc')->get()->result_array();
		$userID = $this->session->userdata('userID');
		foreach ($dataTransfer as $key => $val) {
			$user_nameSender = '';
			$user_nameReceived='';
			$resultSender = $this->UserModels->find($val['userID_sender'],'id,fullname');
			$resultReceived =  $this->UserModels->find($val['userID_received'],'id,fullname');
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
			$output .= 
			'<tr>
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
			$result = $this->UserModels->find($val['userID'],'id,fullname');
			if($val['userID'] == $result['id']  ){
				$dataDeposite[$key]['user_nameDeposite'] = $result['fullname'];
			}
		}
		$output='';
		foreach($dataDeposite as $key => $row){
			$status ='';
			if($row['status'] == 1){ $status = 'Success'; }
			$output .= 
			'<tr>
				<td>'.$row['user_nameDeposite'].'</td>
				<td class="currency"><span class="text-success">+ $ '.$row['amount'].'</span></td>
				<td class="text-"left>'.$row['date'].'</td>
				<td><span class="text-success">'.$status.'</span></td>
			</tr>';
		}	
		echo $output;
	}
	//get_history Withdraw - OT1
	public function get_historyWithdraw()
	{
		//get_history Withdraw
		$userID = $this->session->userdata('userID');
		$Withdraw = $this->WithdrawModels->findWhere(array('userID' =>$userID));
		foreach ($Withdraw as $key => $value) {
			$result = $this->UserModels->find($userID, 'id,fullname');
			if($value['userID'] == $result['id']){
				$Withdraw[$key]['fullname'] = $result['fullname'];
			}
			
		}
		foreach ($Withdraw as $key => $val) {
			if($val['status'] == 3){
				$amount = "<td class='currency text-success'>"."+ $".$val['amount']."</td>";
			}elseif($val['status'] == 2){
				$amount = "<td class='currency text-danger'>"."- $".$val['amount']."</td>";
			}
			else{
				$amount = "<td class='currency'>"."$".$val['amount']."</td>";
			}
			echo "
				<tr>
			        <td>".$val['fullname']."</td>
			        ".$amount."
			        <td>".$val['date']."</td>";
					$status = $val['status'];
					switch ($status)
					{
					case 0 :
					  echo '<td><span class="waiting">waiting</span></td>';
					  break;
					case 1:
					  echo '<td><span class="pending">pending</span></td>';
					  break;
					case 2:
					  echo '<td><span class="status">success</span></td>';
					  break;
					case 3:
					   echo '<td><span class="destroy">destroy</span></td>';
					  break;
					default:
					  echo 'not found';
					break;
					}
			echo"</tr>";    
		}		
	}
	//get amount_min_withdraw AND cost_withdraw - OT1
	public function get_AmountMin_CostWithdraw()
	{
		//get Amount Min (Withdraw) and Cost Withdraw (%) in config - OT1
		$result = $this->SettingModels->find('wallet', 'content', 'key');
		$wallet = json_decode($result['content'], true);
		echo '<input id="amount_min_withdraw" readonly hidden type="text" value="'.$wallet['amount_min_withdraw'].'"  />';
		echo '<input id="cost_withdraw" readonly hidden type="text" value="'.$wallet['cost_withdraw'].'"  />';
	}
}


