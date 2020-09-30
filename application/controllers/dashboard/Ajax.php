<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('WithdrawModel');
		$this->load->model('CoinModel');
	}
	//get_history Withdraw - OT1
	public function get_historyWithdraw()
	{
		//get_history Withdraw
		$userID = $this->session->userdata('userID');
		$Withdraw = $this->WithdrawModel->getAll('tbl_withdraw','*',array('userID' =>$userID),'id desc');
		$userID = $this->session->userdata('userID');
		foreach ($Withdraw as $key => $value) {
			$result = $this->WithdrawModel->select_row('tbl_user', 'id,fullname', array('id' => $userID));
			if($value['userID'] == $result['id']){
				$Withdraw[$key]['fullname'] = $result['fullname'];
			}
			
		}
		foreach ($Withdraw as $key => $val) {
			echo "
				<tr>
			        <td>".$val['fullname']."</td>
			        <td class='currency'>".$val['amount']."</td>
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
	//get amount_min_withdraw AND cost_withdraw AND Cost_ETH - OT1
	public function getValueToWithdraw()
	{
		//get Amount Min (Withdraw) and Cost Withdraw (%) in config - OT1
		$result = $this->WithdrawModel->select_row('tbl_config', 'content', array('key' => 'wallet'));
		$wallet = json_decode($result['content'], true);
		echo '<input id="amount_min_withdraw" readonly hidden type="text" value="'.$wallet['amount_min_withdraw'].'"  />';
		echo '<input id="cost_withdraw" readonly hidden type="text" value="'.$wallet['cost_withdraw'].'"  />';

		//get_cost ETH - OT1
		$ETH = $this->CoinModel->getPriceUsd(eth);
		echo '<input id="cost_ETH" readonly hidden type="text" value="'.$ETH.'"  />';
	}
}


