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
				<form action="" class= "form" data-toggle="validator" novalidate="true" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="inputName">Fullname</label>
							<input type="text" name="fullname" class="form-control" id="inputName" value="<?php echo $datas['fullname'];?>">
							<div class="has-error"><?php echo form_error('fullname') ?></div>
						</div>
						<div class="form-group">
							<label for="inputName">Phone</label>
							<input type="text" name="phone" class="form-control" id="inputName" value="<?php echo $datas['phone'];?>" >
							<div class="has-error"><?php echo form_error('phone') ?></div>
						</div>
						<div class="form-group">
							<label for="inputName">walletUSD</label>
							<input type="text" name="walletUSD" class="form-control" id="inputName" value="<?php echo number_format($datas['walletUSD'],2);?>" >
							<div class="has-error"><?php echo form_error('walletUSD') ?></div>
						</div>
						<div class="row gutters justify-content-center">
							<button type="submit" class="btn btn-success btn-rounded">Save</button>
							<button type="reset" class="btn btn-primary btn-rounded">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
