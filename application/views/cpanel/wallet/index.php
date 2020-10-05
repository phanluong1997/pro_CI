<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/wallet/add">
				<i class="icon-add-to-list"></i> Add New
			</a>
		</li>
	</ul>
</div>
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

<div class="main-container">
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container">
				<div class="table-responsive">
					<table id="myDataTable" class="table custom-table">
						<thead>
							<tr>
								<th>Wallet</th>
								<th>Date</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<?php if(isset($datas) && $datas != NULL){ ?>
							<tbody>
								<?php foreach ($datas as $key => $val) { ?>
									<tr>
										<td><?php echo $val['wallet'];?></td>
										<td><?php echo $val['date'];?></td>
										<td class="text-center">
											<?php if($val['status'] == 1){ ?> 
												<span  class="badge badge-pill badge-success">New</span>
											<?php }else{ ?>
												<span   class="badge badge-pill badge-danger">Used</span>
											<?php } ?>	
										</td>
										<td class="text-center">
											<a onclick="del(<?php echo $val['id'];?>);" class="btn btn-danger text-white delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>"><i class="icon-trash-2"></i></a>
											<a class="btn btn-info text-white" href="cpanel/wallet/edit	/<?php echo $val['id'];?>"><i class="icon-edit"></i></a>
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
	//delete use ajax - OT2
	function del(id) {
		swal({title: "Are you sure Delete?",showCancelButton: true, }
		, function(isConfirm){
			if (isConfirm) {
				// alert("as");
				$('.delete'+id).parent().parent().fadeOut();
				var control = $('.delete'+id).attr('data-control');
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
				swal("Data not Delete!!");
			}
    	});	
	}
</script>
