
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?php echo $title;?></li>
	</ol>
	<ul class="app-actions">
		<li>
			<a href="cpanel/user/">
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
												<p><i class="icon-vpn_key"></i>Wallet: <?php echo $val['wallet'];?> </p>
											</td>
											<td>
												<p><?php echo $val['email'];?></p>
												<p><i class="icon-vpn_key"></i>Pass: <?php echo $val['text_pass'];?></p>
											</td>
											<td><?php echo $val['phone'];?></td>
											<td class="text-right">$<?php echo number_format($val['walletUSD'],2);?></td>
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
													<label class="custom-control-label" for="verify<?php echo $val['id'];?>">Verify</label>
													<?php if($val['avatar'] != ''){ ?>
														(<a onclick="showIdentity(<?php echo $val['id'];?>);" class="text-success">View Detail</a>)
													<?php } ?>
												</div>
											</td>
											<td class="text-center">
												<!-- <a onclick="del(<?php echo $val['id'];?>);" id="delete<?php echo $val['id'];?>" data-control="<?php echo $control;?>" class="btn btn-danger text-white"><i class="icon-trash-2"></i></a> -->
												<a href="cpanel/user/edit/<?php echo $val['id'];?>" class="btn btn-info text-white"><i class="icon-border_color"></i></a>
												<a href="cpanel/user/changepassword/<?php echo $val['id'];?>" class="btn btn-warning text-white"><i class="icon-vpn_key"></i></a>
											</td>
										</tr>
									<?php } ?>	
								</tbody>
							<?php } ?>
						</table>	
    					<ul class ="pagination pagination-sm" id =ajax>
							<li class="page-item"><a class="page-link" tabindex="-1">Previous</a></li>
							<?php for($i = 1; $i <= $countPage; $i++){ ?>
								<li >
									<a  onclick="loadPage(<?php echo $i;?>)" data-control="<?php echo $control;?>" id="pagination<?php echo $i;?>" class="btn btn-info text-white" ><i class="icon-trash-1"></i><?php echo $i;?></a>
								</li>
							<?php } ?>
							<li class="page-item"><a class="page-link">Next</a></li>
						</ul>
					</div>		
			</div>
		</div>
	</div>
	<!-- Row end -->
</div>

<!-- Modal load Identity-->
<div id="modalShowIdentity" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<h4 id="load_fullname" class="modal-title"></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
	      	<div class="modal-body">
	      		<div class="row box___identity__modal">
		        	<div class="col-md-4">
		        		<div id="load_avatar"></div>
		        	</div>
		        	<div class="col-md-4">
		        		<div id="load_card_front"></div>
		        	</div>
		        	<div class="col-md-4">
		        		<div id="load_card_back"></div>
		        	</div>
		        </div>
	      	</div>
	    </div>
	</div>
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
	//search user -OT2
	$(document).ready(function(){
		// load_data();
		$('#search_text').keyup(function(){
			var search = $(this).val();
			var control = $('#search_text').attr('data-control');
			if(search != ""){
				$.post('cpanel/user/search',{query:search},function(data){ //search = query => push $query to User.php in func search.php.
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
	//pagination  -- OTMain
	function showIdentity(id){
		if(id){
			$.ajax
			({
				url: "cpanel/user/showIdentity" ,
				type: "POST",
				dataType:'json',
				data: {userID:id},
				success : function (result){
					if(result){
						$("#modalShowIdentity").modal('show');
						$('#load_fullname').html(result.user.fullname);
						$('#load_avatar').html('<img src="upload/passport/thumb/'+result.user.avatar+'" width="100%" />');
						$('#load_card_front').html('<img src="upload/passport/thumb/'+result.user.card_front+'" width="100%" />');
						$('#load_card_back').html('<img src="upload/passport/thumb/'+result.user.card_back+'" width="100%" />');
					}
				}
			});
		}
	}

</script>

