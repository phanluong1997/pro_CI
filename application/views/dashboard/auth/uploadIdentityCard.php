<div class="profileBox clearfix upload__identity__card">
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
		<form action="" class="login__form" method="POST" enctype="multipart/form-data">
	        <div class="form-item">
	        	<label>YOUR ID IN FRONT OF YOUR FACE <span class="box__require">(*)</span></label>
	          	<input type="file" class="custom-file-input" <?php if(!$datas['avatar']){?> required <?php }?> name="avatar" />
	          	<input type="text" name="post" hidden />
	          	<?php if($datas['avatar']){?><image src="<?php echo $path_dir_thumb.$datas['avatar'];?>"><?php }?> 
	        </div>
	        <div class="form-item">
	        	<label>ID/Passport front side <span class="box__require">(*)</span></label>
	          	<input type="file" class="custom-file-input" <?php if(!$datas['card_front']){?> required <?php }?> name="card_front" />
	          	<?php if($datas['card_front']){?><image src="<?php echo $path_dir_thumb.$datas['card_front'];?>"><?php } ?>
	        </div>
	        <div class="form-item">
	        	<label>ID/Passport back side <span class="box__require">(*)</span></label>
	          	<input type="file" class="custom-file-input" <?php if(!$datas['card_back']){?> required <?php }?> name="card_back" />
	          	<?php if($datas['card_back']){?><image src="<?php echo $path_dir_thumb.$datas['card_back'];?>"><?php } ?>
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Update</button>
              	<a class="link__style" href="dashboard" >Back to Dashboard <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
	    </form>
	</div>
</div>