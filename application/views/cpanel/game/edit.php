<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/game/index">
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
							<label for="inputName">Name</label>
							<input type="text" name="Name" class="form-control" id="inputName" value="<?php echo set_value('name'); echo $datas['name'];?>">
							<div class="has-error"><?php echo form_error('name') ?></div>
						</div>
						<div class="form-group">
							<label for="input-file-now">Image (width: 400 x height: 240)</label>
							<input type="file" required="" requiredmsg="Please select photo" name="image" id="image" class="dropify" />
						</div>
						<div class="form-group">
							<label for="inputName">Description</label>
							<input type="text" name="des" class="form-control" id="inputName" value="<?php echo set_value('des'); echo $datas['des']; ?>" >
							<div class="has-error"><?php echo form_error('des') ?></div>
						</div>
						<div class="form-group">
							<label for="inputName">Link</label>
							<input type="text" name="link" class="form-control" id="inputName">
							<div class="has-error"><?php echo form_error('link') ?></div>
						</div>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="active" class="custom-control-input" checked id="customSwitch3">
							<label class="custom-control-label" for="customSwitch3">Active</label>
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
