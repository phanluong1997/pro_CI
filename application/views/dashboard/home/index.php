<div class="mainDash">
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
	<div class="row">
		<div class="col-md-4">
			<div class="item__account clearfix">
				<div class="col-md-3">
					<img src="public/dashboard/images/icUser.png" class="avatar" alt="Avatar">
				</div>
				<div class="col-md-9">
					<div class="row">
						<ul class="info">
							<li class="fullname"><?php echo $datas['fullname']; ?></li>
							<li class="code"><b>Code:</b> <?php echo $datas['code']; ?> <a class="btn__copy"><i class="far fa-clone"></i></a></li>
							<div class="box__status">
								<?php if($datas['verify'] == 1){ ?>
									<div class="text__success is__verify">Verify</div>
								<?php } else { ?>
									<div class="">Verify = 0</div>
								<?php } ?>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<div class="item__account__btn clearfix">
				<?php if($datas['password'] == NULL){ ?>
					<a class="key" href="dashboard/add-password.html">Add password</a>
				<?php } else { ?>
					<a class="key" href="dashboard/change-password.html">Change password</a>
				<?php } ?>
			</div>
			<div class="item__account__btn clearfix">
				<a class="_2fa" href="">Google Authenticator Setting</a>
			</div>
		</div>
		<div class="col-md-2">
			<div class="item__amout__wallet">
				<div class="title">Balances</div>
				<div class="amount">$
					<?php 
						if($datas['walletUSD']==0)
						{
							echo 0;
						}else{
							echo $datas['walletUSD'];
						}

					 ?>
				</div>
			</div>
			<div class="box__tools__wallet">
				<a href="" class="deposite">Deposite</a>
				<a href="" class="withdraw">Withdraw</a>
			</div>
		</div>
	</div>
	<div class="game__list">
		<div class="title">My Game</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/1.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/2.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/1.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/2.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/1.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/2.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/1.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="item">
					<div class="box__img">
						<img src="public/images/2.png">
					</div>
					<div class="item__info">
						<h3>Crash</h3>
						<div class="des">Watch the multiplier go to the infinit. </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>