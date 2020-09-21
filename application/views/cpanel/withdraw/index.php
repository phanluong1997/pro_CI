<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
</div>
<div class="main-container">
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container">
				<div class="table-responsive">
					<table id="basicExample" class="table custom-table">
						<thead>
							<tr>
								<th>User</th>
								<th>Amount</th>
								<th>Wallet</th>
								<th>Note</th>
								<th>Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<?php if(isset($datas) && $datas != NULL){ ?>		
							<tbody>
								<?php foreach ($datas as $key => $val) { ?>
									<tr>
										<td><?php echo $val['user_name']; ?></td>
										<td>
											<p>Amount: $<?php echo $val['amount']; ?></p>
											<p>Amount Receive: $<?php echo $val['amount_receive']; ?></p>
											<p>ETH:<?php echo $val['amount_eth']; ?></p>
										</td>
										<td><?php echo $val['wallet']; ?></td>
										<td><?php echo $val['note']; ?></td>
										<td><?php echo $val['date']; ?></td>
										<td class="text-center">
											<?php if($val['status'] == 0){ ?>
												<a onclick="changeStatus(1,1)" class="btn btn-success btn-rounded text-white">Apprive</a>
												<a onclick="changeStatus(1,2)" class="btn btn-danger btn-rounded text-white">Destroy</a>
												<?php } ?>
												<?php if($val['status'] == 1){ ?>	
													<span class="text-success">Apprive</span>
												<?php } ?>
												<?php if($val['status'] == 2){ ?>	
													<span class="text-danger">Destroy</span>	
											<?php } ?>	
										</td>
									</tr>
								<?php } ?>
							</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>	
	<!-- Row end -->
</div>
<!-- model for change status -->
<div class="modal fade" id="myModalChangeStatus" tabindex="-1" role="dialog" aria-labelledby="footerCenterIconsModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="cpanel/withdraw/changeStatus" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label>Note</label>
						<textarea class="form-control" name="note" id="note" rows="3"></textarea>
						<input type="hidden" id="divID" name="id" value="">
						<input type="hidden" id="divStatus" name="status" value="">
						<!-- <input type="hidden" id="divStatus" name="name" value="ok"> -->
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i></button>
					<button type="submit" class="btn btn-primary"><i class="icon-check2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END model for change status -->

<script type="text/javascript">
	function changeStatus(id, status){
		//open modal
		$("#myModalChangeStatus").modal('show');
		//	
		$('#divID').val(id);
		$('#divStatus').val(status);
	}
</script>
