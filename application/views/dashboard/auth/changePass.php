<div class="profileBox clearfix">
	<div class="contents">
		<div class="title">Change Password</div>
		<form action="" class="login__form" action="" method="POST">
	        <div class="form-item">
	        	<label>Old Password</label>
	          	<input type="password" required name="oldpassword" id="oldpassword" value="">
	          	<div class="has-error text-warning"><?php echo form_error('oldpassword') ?></div>
	        </div>
	        <div class="form-item">
	        	<label>New Password</label>
	          	<input type="password" name="password" id="password" value="">
	        </div>
	        <div class="form-item">
	        	<label>>Re-Password</label>
	          	<input type="password" name="re-password" id="re-password" value="">
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Save</button>
            </div>
	    </form>
	</div>
</div>