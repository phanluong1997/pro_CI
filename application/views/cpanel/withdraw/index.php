<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/wallet/add">
				<i class="icon-add-to-list"></i> Add New
			</a>
		</li>
	</ul>
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
						<tbody>
							<tr>
								<td>dangsinh79</td>
								<td>
									<p>Amount: $300</p>
									<p>Amount Receive: $280</p>
									<p>ETH: 2.4</p>
								</td>
								<td>0xAA2E58c22b04452ab07e60020629c282926EA4d3</td>
								<td>Done</td>
								<td>23/09/2020</td>
								<td class="text-center">
									<a onclick="changeStatus(1,1)" class="btn btn-success btn-rounded text-white">Apprive</a>
									<a onclick="changeStatus(1,2)" class="btn btn-danger btn-rounded text-white">Destroy</a>
								</td>
							</tr>
							<tr>
								<td>dangsinh79</td>
								<td>
									<p>Amount: $300</p>
									<p>Amount Receive: $280</p>
									<p>ETH: 2.4</p>
								</td>
								<td>0xAA2E58c22b04452ab07e60020629c282926EA4d3</td>
								<td>Done</td>
								<td>23/09/2020</td>
								<td class="text-center">
									<span class="text-success">Apprive</span>
								</td>
							</tr>
							<tr>
								<td>dangsinh79</td>
								<td>
									<p>Amount: $300</p>
									<p>Amount Receive: $280</p>
									<p>ETH: 2.4</p>
								</td>
								<td>0xAA2E58c22b04452ab07e60020629c282926EA4d3</td>
								<td>Done</td>
								<td>23/09/2020</td>
								<td class="text-center">
									<span class="text-danger">Destroy</span>
								</td>
							</tr>
						</tbody>
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
			<form action="" method="">
				<div class="modal-body">
					<div class="form-group">
						<label>Note</label>
						<textarea class="form-control" id="note" rows="3"></textarea>
						<input type="hidden" id="divID" value="">
						<input type="hidden" id="divStatus" value="">
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
		/*---
		if(type == 1) => approve
		if(type == 2) => destroy
		---*/
		//open modal
		$("#myModalChangeStatus").modal('show');
		//assign value for input hidden (id, status)
		$('#divID').val(id);
		$('#divStatus').val(status);
	}
</script>