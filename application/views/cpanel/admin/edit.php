<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/admin/index">
				<i class="icon-arrow_back"></i> Back
			</a>
		</li>
	</ul>
</div>
<div class="col-12">
	<div class="row gutters justify-content-center">
		<div class="col-4">
			<div class="card">
				<form action="" data-toggle="validator" novalidate="true" method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="inputName">Fullname</label>
							<input type="text" name="fullname" class="form-control" id="inputName" value="<?php echo $datas['fullname'];?>">
							<div class="has-error"><?php echo form_error('fullname') ?></div>
						</div>
						<div class="form-group">
							<label for="inputName">Phone</label>
							<input type="text" name="phone" class="form-control" id="inputName" value="<?php echo $datas['phone']; ?>" >
							<div class="has-error"><?php echo form_error('phone') ?></div>
						</div>
						<div class="custom-control custom-switch">
							<input 
							<?php if($datas['active'] == 1){ ?> checked <?php } ?> name="active"
							type="checkbox" class="custom-control-input" id="active<?php echo $datas['id'];?>">
							<label class="custom-control-label" for="active<?php echo $datas['id'];?>">Active</label>
						</div>
						<!-- <div class="custom-control custom-switch">
							<input type="checkbox" name="active" class="custom-control-input" checked id="customSwitch3">
							<label class="custom-control-label" for="customSwitch3">Active</label>
						</div> -->
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