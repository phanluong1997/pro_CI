<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/robots/index">
				<i class="icon-arrow_back"></i> Back
			</a>
		</li>
	</ul>
</div>
<div class="col-12">
	<div class="row gutters justify-content-center">
		<div class="col-4">
			<div class="card">
				<form action="" data-toggle="validator" novalidate="true" method="POST" enctype="multipart/form-data" >
					<div class="card-body">
						<div class="form-group">
							<label for="inputName">FullName</label>
							<input type="text" required=""  name="fullname" class="form-control" id="inputName" value="<?php echo set_value('fullname'); echo $datas['fullname'];?>">
							<div class="has-error"><?php echo form_error('fullname') ?></div>
						</div>
						<div class="form-group">
							<label for="input-file-now">Avatar (width: 400 x height: 240)</label>
							<input type="file" required="" requiredmsg="Please select image" name="avatar" id="avatar" />
						</div>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="publish" class="custom-control-input" checked id="customSwitch3">
							<label class="custom-control-label" for="customSwitch3">Publish</label>
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
