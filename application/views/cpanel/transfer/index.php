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
								<th>Sender</th>
								<th>Received</th>
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
										<td><?php echo $val['user_nameReceived']; ?></td>	
										<td class="text-right">$<?php echo $val['amount']; ?></td>
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
