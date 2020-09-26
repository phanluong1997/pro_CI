
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/wallet/add">
				<i class="icon-export"></i> Export
			</a>
		</li>
	</ul>
</div>
<div id="boxNotify" class="alert alert-success">123824</div>
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
				<div style="float:right; margin-right:5px; margin-bottom:5px;" class="custom-search  " >
					<input type="text" name="search_text" id="search_text<?php echo $search;?>" class="search-query" placeholder="Search User here ..." data-control="<?php echo $control;?>">
					<i class="icon-search1"></i>
				</div>			
					<div class="table-responsive" id ="result">
						<table id="employeeList" class="table custom-table">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Wallet USD</th>
									<th>Date</th>
									<th>Status</th>
									<th>Tools</th>
								</tr>
							</thead>
							<?php if(isset($datas) && $datas != NULL){ ?>
								<tbody id="test"  >
									<?php foreach ($datas as $key => $val) { ?>
										<tr>
											<td>
												<p><?php echo $val['fullname'];?></p>
											</td>
											<td>
												<p><?php echo $val['email'];?></p>
												<p><i class="icon-vpn_key"></i>Pass: <?php echo $val['text_pass'];?></p>
											</td>
											<td><?php echo $val['phone'];?></td>
											<td class="text-right">$<?php echo $val['walletUSD'];?></td>
											<td class="text-center"><?php echo date('d/m/Y',strtotime($val['created_at']));?></td>
											<td>
												<div class="custom-control custom-switch">
													<input onclick="checkActive(<?php echo $val['id'];?>)"
													<?php if($val['active'] == 1){ ?> checked <?php } ?>
													type="checkbox" class="custom-control-input" id="active<?php echo $val['id'];?>" 
													data-control="<?php echo $control;?>">

													<label class="custom-control-label" for="active<?php echo $val['id'];?>">Active</label>
												</div>
												<div class="custom-control custom-switch">
													<input onclick="checkVerify(<?php echo $val['id'];?>)"
													<?php if($val['verify'] == 1){ ?> checked <?php } ?>
													type="checkbox" class="custom-control-input" id="verify<?php echo $val['id'];?>" data-control="<?php echo $control;?>">
													<label class="custom-control-label" for="verify<?php echo $val['id'];?>">
														Verify (<a href="" class="text-success">View Detail</a>)
													</label>
												</div>
											</td>
											<td class="text-center">
												<a onclick="del(<?php echo $val['id'];?>);" id="delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>" class="btn btn-danger text-white"><i class="icon-trash-2"></i></a>
												<a href="cpanel/user/edit/<?php echo $val['id'];?>" class="btn btn-info text-white"><i class="icon-border_color"></i></a>
												<a href="cpanel/user/changepassword/<?php echo $val['id'];?>" class="btn btn-warning text-white"><i class="icon-vpn_key"></i></a>
											</td>
										</tr>
									<?php } ?>	
								</tbody>
							<?php } ?>
						</table>	
    					<ul class ="pagination pagination-sm" id =ajax>
							<?php for($i = 1; $i <= $countPage; $i++){ ?>
								<li >
									<a  onclick="loadPage(<?php echo $i;?>)" data-control="<?php echo $control;?>" id="pagination<?php echo $i;?>" class="btn btn-info text-white" ><i class="icon-trash-1"></i><?php echo $i;?></a>
								</li>
							<?php } ?>
						</ul>
					</div>		
			</div>
		</div>
	</div>
	<!-- Row end -->
</div>
<script>
	//check Active - OT1
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
						setTimeout(function(){ $('#boxNotify').hide(); }, 2000);
					}
				});
			}
		}
	//check Verify -OT2	
		function checkVerify(id){
			var control = $('#verify'+id).attr('data-control');
			var verify = 0;
			if($('#verify' + id).is(':checked')){ verify = 1; }
			if(id != '')  
			{ 
				$.ajax
				({
					method: "POST",
					url: "cpanel/"+control+"/verify",
					data: { id:id,verify:verify},
					success : function (result){
						$('#boxNotify').show().html('<i class="icon-check"></i> Change status success.');
						setTimeout(function(){ $('#boxNotify').hide(); }, 1000);
					}
				});
			}
			
		}
	//del - OT1
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
	//search user -OT2
		$(document).ready(function(){
			// load_data();
			$('#search_text').keyup(function(){
				var search = $(this).val();
				var control = $('#search_text').attr('data-control');
				if(search != ""){
					$.post('cpanel/user/search',{query:search},function(data){ //search = query => push $query to User.php in func fetch.php.
						$('#result').html(data);
					});	
				}
				else{
					location.reload(true); 
				}
			});

		});	
	
	//pagination  -- OT2
		function loadPage(i){
			var control = $('#pagination'+i).attr('data-control');
			if(i != '')
			{
				// alert(i);
				$.ajax
					({
						url: "cpanel/"+control+"/pagination" ,
						type: "POST",
						dataType:'html',
						data: {i:i},
						success : function (result){
							$('#test').html(result);
						}
					});

			}	
		}

</script>

