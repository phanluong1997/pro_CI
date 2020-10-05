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
				<form action="" data-toggle="validator" novalidate="true" method="POST" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group">
							<label for="inputName">Name</label>
							<input type="text" required  name="name" class="form-control" id="inputName" value="<?php if(isset($datas['name']) && $datas['name']!=''){ echo $datas['name']; }?>">
						</div>
						<div class="form-group">
							<label for="inputName">Description</label>
							<input type="text" name="des" class="form-control" id="inputName" value="<?php if(isset($datas['des']) && $datas['des']!=''){ echo $datas['des']; }?>" >
						</div>
						<div class="form-group">
							<label for="inputName">Link</label>
							<input type="text" name="link" class="form-control" id="inputName" value="<?php if(isset($datas['link']) && $datas['link']!=''){ echo $datas['link']; }?>">
						</div>
						<div class="form-group">
							<label for="input-file-now">Image (width: 400 x height: 240)</label>
							<input type="file"  data-default-file="<?php echo $path_dir_thumb;?><?php echo $datas['thumb'];?>" name="image" id="image" class="dropify"/>
						</div>
						<div class="custom-control custom-switch">
							<input 
								<?php if($datas['publish'] == 1){ ?> checked <?php } ?> name="publish"
								type="checkbox" class="custom-control-input" id="publish<?php echo $datas['id'];?>">
							<label class="custom-control-label" for="publish<?php echo $datas['id'];?>">Publish</label>
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
