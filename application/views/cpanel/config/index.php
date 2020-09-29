<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/user/index">
				<i class="icon-arrow_back"></i> Back
			</a>
		</li>
	</ul>
</div>
<div class="col-12">
	<div class="row gutters justify-content-center">
		<div class="col-4">
			<div class="card">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#general">General</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#wallet">Wallet</a>
				  </li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active container" id="general">
					  	<form action="cpanel/config/system" method="POST">
						  	<div class="form-group">
								<label for="inputName">Title</label>
								<input type="text" name="title" class="form-control" id="inputName" value="<?php echo $system['title'];?>">
							</div>
							<div class="row gutters justify-content-center">
								<button type="submit" class="btn btn-success btn-rounded">Save</button>
								<button type="reset" class="btn btn-primary btn-rounded">Reset</button>
							</div>
						</form>
					</div>
					<div class="tab-pane container" id="wallet">
					  	<form action="cpanel/config/wallet" method="POST">
						  	<div class="form-group">
								<label for="inputName">Amount Min (Withdraw)</label>
								<input type="number" min="0" name="amount_min_withdraw" class="form-control" value="<?php echo $wallet['amount_min_withdraw'];?>">
							</div>
							<div class="form-group">
								<label for="inputName">Cost Withdraw (%)</label>
								<input type="number" min="0" name="cost_withdraw" class="form-control" value="<?php echo $wallet['cost_withdraw'];?>">
							</div>
							<div class="row gutters justify-content-center">
								<button type="submit" class="btn btn-success btn-rounded">Save</button>
								<button type="reset" class="btn btn-primary btn-rounded">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
