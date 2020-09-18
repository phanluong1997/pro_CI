<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/wallet/index">
				<i class="icon-arrow_back"></i> Back
			</a>
		</li>
	</ul>
</div>
<div class="col-12">
	<div class="row gutters justify-content-center">
		<div class="col-4">
			<div class="card">
				<form action="" method="POST" class="form" data-toggle="validator" novalidate="true">
					<div class="card-body">
						<div class="form-group" >
							<label for="wallet">Wallet Address</label>
							<input type="text" class="form-control" id="wallet" name="wallet"  type="text" value = "<?php if(isset($datas['wallet']) && $datas['wallet']!=''){ echo $datas['wallet']; }?><?php echo set_value('wallet') ?>" >
							<div class= "clear error text-danger"  name="name_error"><?php echo form_error('wallet') ?></div>
						</div>
						<div class="row gutters justify-content-center">
							<button type="submit" class="btn btn-success btn-rounded">Save</button>
							<button type="reset"  class="btn btn-primary btn-rounded">Reset</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
