<div class="profileBox clearfix">
	<div class="contents">
		<div class="title">Profile Update</div>
		<form action="" method="POST" class="login__form">
			<div class="form-item">
	        	<label>Email</label>
	          	<input type="text" readonly="readonly" value="<?php echo $datas['email']; ?>">
	        </div>
	        <div class="form-item">
	        	<label>Fullname</label>
	          	<input type="text" required="" name="fullname" placeholder="Fullname" id="fullname" value="">
	        </div>
	        <div class="form-item">
	        	<label>Phone</label>
	          	<input type="text" required="" name="phone" placeholder="Phone" id="phone" value="">
	        </div>
	        <div class="form-item btn-box">
              	<button type="submit">Save</button>
            </div>
	    </form>
	</div>
</div>