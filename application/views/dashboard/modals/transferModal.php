<div id="myTransfer" class="main-transfer modal fade" role="dialog">
  <div class="top-deposite">
    <div class="wallet">
      <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
	<!-- Info Submit -->
<!-- <?php $message_flashdata = $this->session->flashdata('message_flashdata');
if(isset($message_flashdata) && count($message_flashdata)){ ?>
    <div id="alerttopfix" class="myadmin-alert <?php if($message_flashdata['type'] == 'sucess'){ ?> alert-success <?php }else{ ?> alert-danger <?php } ?>">
        <?php if($message_flashdata['type'] == 'sucess'){ ?> 
          	<i class="icon-check"></i> <?php echo $message_flashdata['message']; ?>
          <?php }else if($message_flashdata['type'] == 'error'){ ?>
          	<i class="icon-close"></i> <?php echo $message_flashdata['message']; ?>
        <?php } ?>
  	</div>
<?php } ?> -->
  <div class="container-fluid">
    <ul class="row nav nav-pills link-tab-bill">
      <li class="active col-md-offset-4 col-md-2 col-sm-offset-4 col-xs-3 col-lg-offset-4 col-lg-2 col-xs-offset-2 ">
        <a data-toggle="tab" href="#tabTransfer">Transfer</a>
      </li>
      <li class="col-lg-5 col-xs-4 "><a data-toggle="tab" id="TransferHistory" href="#tabTransferHistory">History</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="tabTransfer" class="tab-pane fade in active">
      <div class="content-transfer">
		<form onsubmit="return checkAmountTransfer()" action="dashboard/transfer.html" method="POST">
			<div id="messageAmount" class="text-danger"></div> 
          <label>Amount <span class="box__require">(*)</span></label><br />
          		<input  id="txtAmountTransfer" required value="" type="number" min="0" name="amount" /><br />
			     
          <label>Transfer to <span class="box__require">(*)</span></label><br />
          		<input id="txtTransferTo" required type="text" name="transfer" /><br />
				
         <label>2FA code <span class="box__require">(*)</span></label><br />
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
					<th>Sender</th>
					<th>Received</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody id = "historyTransfer">
			</tbody>
        </table>
        <!-- END table -->
      </div>
    </div>
  </div>
</div>
<script>
	//check Amount >50 --OT2
	function checkAmountTransfer(){
		//Get value to input
		var amount = $('#txtAmountTransfer').val();
		var transfer = $('#txtTransferTo').val();
		//Check require
		if(amount == "" )
		{
			$('#messageAmount').html('Amount is empty');
			$('#messageTransferto').html('Transfer to is empty');
			return false;
		}
		else
		{
			let result = 1;
			$.ajax({
				
				async: false,
				url: 'dashboard/checkamountTransfer.html',
				type: 'POST',
				dataType: 'json',
				data: {amount:amount,transfer:transfer},
				success: function(data) {
					if(data){
						$('#messageAmount').html(data.message);
						result = 0;
					}
				}
			});
			if(result == 0){ return false; }else{ return true; }
		}
	}
	$("#TransferHistory").click(function(){
		$.ajax({url: "dashboard/ajax/historyTransfer",
			 success: function(result){
			$("#historyTransfer").html(result);
		}});
	});

</script>
