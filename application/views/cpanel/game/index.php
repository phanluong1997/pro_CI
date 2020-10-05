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
	    <div id="alerttopfix" class="myadmin-alert alert-success myadmin-alert-top-right" style="display: block;">
	        <?php if($message_flashdata['type'] == 'sucess'){?> 
	          	<i class="icon-check"></i> <?php echo $message_flashdata['message']; ?>
	        <?php }else if($message_flashdata['type'] == 'error'){?>
	          	<i class="icon-close"></i> <?php echo $message_flashdata['message']; ?>
	        <?php } ?>
	  	</div>
	<?php } ?> 
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container">
				<div class="table-responsive">
					<table id="myDataTable" class="table custom-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Image</th>
								<th>Link</th>
								<th>Date</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<?php if(isset($datas) && $datas != NULL){ ?>
							<tbody>
								<?php foreach ($datas as $key => $val) { ?>
									<tr>
										<td><?php echo $val['name'];?></td>
										<td><?php echo $val['des'];?></td>
										<td class="text-center"><img src="<?php echo $path_dir_thumb;?><?php echo $val['thumb'];?>" alt="" width="60"></td>
										<td><?php echo $val['link'];?></td>
										<td><?php echo date('d/m/Y',strtotime($val['created_at']));?></td>
										<td>
											<div class="custom-control custom-switch">
												<input onclick="checkPublish(<?php echo $val['id'];?>)"
												<?php if($val['publish'] == 1){ ?> checked <?php } ?>
												type="checkbox" class="custom-control-input" id="publish<?php echo $val['id'];?>" data-control="<?php echo $control;?>">
												<label class="custom-control-label" for="publish<?php echo $val['id'];?>">Publish</label>
											</div>
										</td>
										<td class="text-center">
											<a onclick="del(<?php echo $val['id'];?>);" id="delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>" class="btn btn-danger text-white"><i class="icon-trash-2"></i></a>
											<a href="cpanel/game/edit/<?php echo $val['id'];?>" class="btn btn-info text-white"><i class="icon-edit"></i></a>
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
	//check OT2
	function checkPublish(id){
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

	//del - OT2
	function del(id) {
		swal({title: "Are you sure?",showCancelButton: true, }
	    , function(isConfirm){
	        if (isConfirm) {
	        	$('#delete'+id).parent().parent().fadeOut();
	            var control = $('#delete'+id).attr('data-control');
			    if(id != '')  
			    { 
			        $.ajax
			        ({
			            method: "POST",
			            url: "cpanel/"+control+"/delete",
			            data: { id:id},
			            success : function (result){
			                $('#test').html(result);
			            }
			        });
			    }
	        }
	        else{
	            swal("Delete data unsuccess!");
	        }
	    });
	}

</script>
