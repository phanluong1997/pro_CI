<div class="profileBox clearfix">
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
	<div class="contents">
		<div class="title">Add Password</div>
		<form action="" class="login__form" action="" method="POST">
	        <div class="form-item">
	        	<label>New Password</label>
	          	<input type="password" required name="password" id="password" >
	          	<div class="has-error text-warning"><?php echo form_error('password') ?></div>
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Save</button>
            </div>
	    </form>
	</div>
</div>