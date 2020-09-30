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
		<div class="title"><?php echo $title;?></div>
		<form action="" method="POST" class="login__form">
			<div class="form-item">
	        	<label>My Referent Code <span class="box__require">(*)</span></label>
	          	<input type="text" required name="code">
	          	<div class="has-error text-warning"><?php echo form_error('code') ?></div>
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Update</button>
              	<a class="btn__orange" href="dashboard">Skip</a>
            </div>
	    </form>
	</div>
</div>