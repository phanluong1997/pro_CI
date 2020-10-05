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
					<table id="myDataTable" class="table custom-table">
						<thead>
							<tr>
								<th>User</th>
								<th>Amount</th>
								<th>Wallet</th>
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
											<p>ETH: <?php echo $val['amount_eth']; ?></p>
										</td>
										<td><?php echo $val['wallet']; ?></td>
										<td><?php echo $val['date']; ?></td>
										<td class="text-center">
											<?php if($val['status'] == 1){ ?>
												<span class="text-success">Success</span>
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
