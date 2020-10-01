<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/game/add">
				<i class="icon-add-to-list"></i> Add New
			</a>
		</li>
	</ul>
</div>
<div id="boxNotify" class="alert alert-success"></div>
<div class="main-container">
<!-- Info Submit -->
<?php $message_flashdata = $this->session->flashdata('message_flashdata');
if(isset($message_flashdata) && count($message_flashdata)){ ?>
    <div id="alerttopfix" class="myadmin-alert <?php if($message_flashdata['type'] == 'sucess'){ ?> alert-success <?php }else{ ?> alert-danger <?php } ?>">
        <?php if($message_flashdata['type'] == 'sucess'){ ?> 
          	<i class="icon-check"></i> <?php echo $message_flashdata['message']; ?>
          <?php }else if($message_flashdata['type'] == 'error'){ ?>
          	<i class="icon-close"></i> <?php echo $message_flashdata['message']; ?>
        <?php } ?>
  	</div>
<?php } ?> 
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			
			<div class="table-container">
				<div class="table-responsive">
					<table id="basicExample" class="table custom-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Image</th>
								<th>Link</th>
								<th>Status</th>
								<th>Date</th>
								<th>Tools</th>
							</tr>
						</thead>
						<?php if(isset($datas) && $datas != NULL){ ?>
							<tbody>
								<?php foreach ($datas as $key => $val) { ?>
									<tr>
										<td><?php echo $val['name'];?></td>
										<td><?php echo $val['des'];?></td>
										<td><?php echo $val['image'];?></td>
										<td><?php echo $val['link'];?></td>
										<td>
											<div class="custom-control custom-switch">
												<input onclick="checkPublish(<?php echo $val['id'];?>)"
												<?php if($val['publish'] == 1){ ?> checked <?php } ?>
												type="checkbox" class="custom-control-input" id="publish<?php echo $val['id'];?>" data-control="<?php echo $control;?>">
												<label class="custom-control-label" for="publish<?php echo $val['id'];?>">Publish</label>
											</div>
										</td>
										<td><?php echo $val['created_at'];?></td>
										<td class="text-center">
											<a onclick="del(<?php echo $val['id'];?>);" class="btn btn-danger text-white delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>"><i class="icon-trash-2"></i></a>
											<a class="btn btn-info text-white" href="cpanel/game/edit/<?php echo $val['id'];?>"><i class="icon-edit"></i></a>
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
<script>
	//check Publish - 
	function checkPublish(id){
		// alert('123');

	    var control = $('#publish'+id).attr('data-control');
	    var publish = 0;
	    if($('#publish' + id).is(':checked')){ publish = 1; }
	    if(id != '')  
	    { 
	        $.ajax
	        ({
	            method: "POST",
	            url: "cpanel/"+control+"/publish",
	            data: { id:id,publish:publish},
	            success : function (result){
	                $('#boxNotify').show().html('<i class="icon-check"></i> Change status success.');
	                setTimeout(function(){ $('#boxNotify').hide(); }, 1000);
	            }
	        });
	    }
	}
</script>
