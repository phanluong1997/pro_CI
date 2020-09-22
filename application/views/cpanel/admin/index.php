<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/admin/add">
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
					<table id="basicExample" class="table custom-table">
						<thead>
							<tr>
								<th>Fullname</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Date</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<?php if(isset($datas) && $datas != NULL){ ?>
							<tbody>
								<?php foreach ($datas as $key => $val) { ?>
									<tr>
										<td><?php echo $val['fullname'];?></td>
										<td><?php echo $val['email'];?></td>
										<td><?php echo $val['phone'];?></td>
										<td><?php echo date('d/m/Y',strtotime($val['created_at']));?></td>
										<td>
											<div class="custom-control custom-switch">
												<input onclick="checkActive(<?php echo $val['id'];?>)"
												<?php if($val['active'] == 1){ ?> checked <?php } ?>
												type="checkbox" class="custom-control-input" id="active<?php echo $val['id'];?>" data-control="<?php echo $control;?>">
												<label class="custom-control-label" for="active<?php echo $val['id'];?>">Active</label>
											</div>
										</td>
										<td class="text-center">
											<a onclick="del(<?php echo $val['id'];?>);" id="delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>" class="btn btn-danger text-white"><i class="icon-trash-2"></i></a>
											<a href="<?php echo $path_url;?>edit/<?php echo $val['id'];?>" class="btn btn-info text-white"><i class="icon-edit"></i></a>
											<a href="<?php echo $path_url;?>changepass/<?php echo $val['id'];?>" class="btn btn-warning text-white"><i class="icon-vpn_key"></i></a>
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
	//check Active - Thao
	function checkActive(id){
	    var control = $('#active'+id).attr('data-control');
	    var active = 0;
	    if($('#active' + id).is(':checked')){ active = 1; }
	    if(id != '')  
	    { 
	        $.ajax
	        ({
	            method: "POST",
	            url: "cpanel/"+control+"/active",
	            data: { id:id,active:active},
	            success : function (result){
	                $('#boxNotify').show().html('<i class="icon-check"></i> Change status success.');
	                setTimeout(function(){ $('#boxNotify').hide(); }, 1000);
	            }
	        });
	    }
	}

	//del - THAO
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
	            swal("Dữ liệu của bạn đã không bị xóa!");
	        }
	    });
	}

</script>
