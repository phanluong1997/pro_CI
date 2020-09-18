<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/wallet/add">
				<i class="icon-export"></i> Export
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
								<th>Fullname</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Wallet USD</th>
								<th>Date</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<p>Trần Văn A</p>
								</td>
								<td>
									<p>tranvana@gmail.com</p>
									<p><i class="icon-vpn_key"></i>Pass: 123123</p>
								</td>
								<td>09243 24202424</td>
								<td class="text-right">$200</td>
								<td class="text-center">23/09/2020</td>
								<td>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" checked id="active">
										<label class="custom-control-label" for="active">Active</label>
									</div>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" checked id="verify">
										<label class="custom-control-label" for="verify">
											Verify (<a href="" class="text-success">View Detail</a>)
										</label>
									</div>
								</td>
								<td class="text-center">
									<a class="btn btn-danger text-white"><i class="icon-trash-2"></i></a>
									<a class="btn btn-info text-white"><i class="icon-border_color"></i></a>
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