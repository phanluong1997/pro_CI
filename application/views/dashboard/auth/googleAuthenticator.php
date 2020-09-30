<div class="profileBox clearfix">
	<!-- Info Submit -->
	<div class="contents">
		<div class="title"><?php echo $title;?></div>
		<div class="col-md-12 box__notify__2fa">
			<?php if($this->session->flashdata('warning_already') != ''){ ?>
	            <div class="text-danger"><i class="fas fa-times"></i> <?php echo $this->session->flashdata('warning_already');?></div>
	        <?php } ?>
	        <?php if($this->session->flashdata('success_already')){ ?>
	            <div class="text-success"><i class="fas fa-check"></i> <?php echo $this->session->flashdata('success_already');?></div>
	        <?php } ?>
	    </div>
		<form action="<?php echo $user['is_enabled_2fa'] == 0?'':'dashboard/disabled-google-2fa.html'; ?>" method="POST" class="login__form">
			<?php if($user['is_enabled_2fa'] == 1){ ?>
			<div class="form-item">
				<div class="box__qrcode">
					<img src="<?php echo $user['2fa']['qrCodeUrl'];?>" border=0>
					<p><?php echo $user['2fa']['secret'];?></p>
				</div>
	        	<label>Google Authenticator Code <span class="box__require">(*)</span></label>
	          	<input type="text" required name="google_auth_code" autocomplete="off">
	        </div>
	        <?php } ?>
	        <div class="form-item btn-box">
	        	<input type="hidden" name="name" autocomplete="off">
              	<button type="submit"><?php echo $user['is_enabled_2fa'] == 0?'Enabled':'Disabled';?></button>
              	<a class="link__style" href="dashboard" >Back to Dashboard <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
	    </form>
	</div>
</div>