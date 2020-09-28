<div id="myTransfer" class="main-transfer modal fade" role="dialog">
  <div class="top-deposite">
    <div class="wallet">
      <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
	<!-- Info Submit -->
<?php $message_flashdata = $this->session->flashdata('message_flashdata');
if(isset($message_flashdata) && count($message_flashdata)){ ?>
    <div id="alerttopfix" class="myadmin-alert <?php if($message_flashdata['type'] == 'sucess'){ ?> alert-success <?php }else{ ?> alert-danger <?php } ?>">
        <?php if($message_flashdata['type'] == 'sucess'){ ?> 
          	<i class="icon-check"></i> <?php echo $message_flashdata['message']; ?>
          <?php }else if($message_flashdata['type'] == 'error'){ ?>
          	<i class="icon-close"></i> <?php echo $message_flashdata['message']; ?>
        <?php } ?>
  	</div>
<?php } ?>
  <div class="container-fluid">
    <ul class="row nav nav-pills link-tab-bill">
      <li class="active col-md-offset-4 col-md-2 col-sm-offset-4 col-xs-3 col-lg-offset-4 col-lg-2 col-xs-offset-2 ">
        <a data-toggle="tab" href="#tabTransfer">Transfer</a>
      </li>
      <li class="col-lg-5 col-xs-4 "><a data-toggle="tab" href="#tabTransferHistory">History</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="tabTransfer" class="tab-pane fade in active">
      <div class="content-transfer">
        <form onsubmit="return checkAmount()" action="dashboard/transfer.html" method="POST">
					<label>Amount</label><br />
          <input  id="txtAmountTransfer"  value="" type="number" min="0" name="amount" /><br />
					<div id="messageAmount" class="text-danger"></div>
          <label>Transfer to</label><br />
          <input id="txtTransferTo" type="text" name="" /><br />
					<div id="messageTransferto" class="text-danger"></div>
          <label>2FA code</label><br />
          <input id="FACodeTransfer" type="text" name="" /><br />
          <label class="lable-btn"><button id="btn-confirm" type="submit">Confirm</button></label>
        </form>
      </div>
    </div>
    <div id="tabTransferHistory" class="tab-pane fade">
      <div class="content-transferHistory">
        <!-- table -->
        <table style="overflow-x:auto" class=" table-deposite table table-hover">
          <thead>
            <tr>
              <th>Sender </th>
              <th>Receiver</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
					<?php if(isset($datas) && $datas != NULL){ ?>
          <tbody>
							<?php foreach($datas as $key => $val) {?>
								<tr>
									<td><?php echo $val['user_nameSender']; ?></td>
									<td>mesi</td>
									<td class="currency">$<?php echo $val['amount']; ?></td>
									<td><?php echo $val['date']; ?></td>
									<td class="text-center">
											<?php if($val['status'] == 1){ ?>
												<span class="text-success">Success</span>
											<?php } ?> </td>
								</tr>
								<!-- <tr>
									<td>chuongle</td>
									<td>jenny</td>
									<td class="currency">$100</td>
									<td>9-23-2020</td>
									<td><span class="status">success</span> </td>
								</tr> -->
								<?php } ?>	
							</tbody>
					<?php } ?>	
        </table>
        <!-- END table -->
      </div>
    </div>
  </div>
</div>
<script>
	//check Amount >50 --OT2
		function checkAmount(){
			//Get value to input
			var amount = $('#txtAmountTransfer').val();
			// var transfer = $('#txtTransferTo').val();
			//Check require
			if(amount == "" && transfer == ""){
				$('#messageAmount').html('Amount is empty');
				// $('#messageTransferto').html('Transfer to is empty');
				return false;
			}else{
				let result = 1;
				$.ajax({
					async: false,
					url: 'dashboard/checkamount.html',
					type: 'POST',
					dataType: 'json',
					data: {amount:amount},//,transfer:transfer
					success: function(data) {
						if(data){
							$('#messageAmount').html(data.message);
							// $('#messageTransferto').html(data.message);
							result = 0;
						}
					}
				});
				if(result == 0){ return false; }else{ return true; }
			}
	// check transfer to --OT2
			// var transfer = $('#txtTransferTo').val();
			// //check required
			// if(transfer == ""){
			// 	$('#messageTransferto').html('Transfer to is empty');
			// 	return false;
			// }else{
			// 	let result = 1;
			// 	$.ajax({
			// 		async: false,
			// 		url: 'dashboard/checktransferto.html',
			// 		type: 'POST',
			// 		dataType: 'json',
			// 		data: {transfer:transfer},
			// 		success: function(data) {
			// 			if(data){
			// 				$('#messageTransferto').html(data.message);
			// 				result = 0;
			// 			}
			// 		}
			// 	});
			// 	if(result == 0){ return false; }else{ return true; }
			// }


	}

</script>
