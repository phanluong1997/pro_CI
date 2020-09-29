<div class="profileBox clearfix">
	<div class="contents">
		<div class="title"><?php echo $title;?></div>
		<form action="" method="POST" class="login__form">
			<div class="form-item">
	        	<label>Email <span class="box__require">(*)</span></label>
	          	<input type="text" readonly="readonly" value="<?php echo $datas['email']; ?>">
	        </div>
	        <div class="form-item">
	        	<label>Fullname <span class="box__require">(*)</span></label>
	          	<input type="text" required="" name="fullname" placeholder="Fullname" id="fullname" value="<?php echo $datas['fullname']; ?>">
	          	<div class="has-error text-warning"><?php echo form_error('fullname') ?></div>
	        </div>
	        <div class="form-item">
	        	<label>Phone <span class="box__require">(*)</span></label>
	          	<input type="text" required="" name="phone" placeholder="Phone" id="phone" value="<?php echo $datas['phone']; ?>">
	          	<div class="has-error text-warning"><?php echo form_error('phone') ?></div>
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Save</button>
              	<a class="link__style" href="dashboard" >Back to Dashboard <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
	    </form>
	</div>
</div>