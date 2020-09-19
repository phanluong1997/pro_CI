<header class="header">
	<div class="toggle-btns">
		<a id="toggle-sidebar" href="#">
			<i class="icon-list"></i>
		</a>
		<a id="pin-sidebar" href="#">
			<i class="icon-list"></i>
		</a>
	</div>
	<div class="header-items">
		<!-- Custom search start -->
		<div class="custom-search">
			<input type="text" class="search-query" placeholder="Search here ...">
			<i class="icon-search1"></i>
		</div>
		<!-- Custom search end -->

		<!-- Header actions start -->
		<ul class="header-actions">
			<li class="dropdown">
				<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
					<i class="icon-bell"></i>
					<span class="count-label">8</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
					<div class="dropdown-menu-header">
						Notifications (40)
					</div>
					<ul class="header-notifications">
						<li>
							<a href="#">
								<div class="user-img away">
									<img src="public/cpanel/img/user21.png" alt="User">
								</div>
								<div class="details">
									<div class="user-title">Abbott</div>
									<div class="noti-details">Membership has been ended.</div>
									<div class="noti-date">Oct 20, 07:30 pm</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="user-img busy">
									<img src="public/cpanel/img/user10.png" alt="User">
								</div>
								<div class="details">
									<div class="user-title">Braxten</div>
									<div class="noti-details">Approved new design.</div>
									<div class="noti-date">Oct 10, 12:00 am</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="dropdown">
				<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
					<span class="user-name">Zyan Ferris</span>
					<span class="avatar">
						<img src="public/cpanel/img/user22.png" alt="avatar">
						<span class="status busy"></span>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
					<div class="header-profile-actions">
						<a ><i class="icon-user1"></i> <?php echo $data_index['info_admin']['fullname'];?></a>
						<a href="cpanel/logout.html"><i class="icon-log-out1"></i> Sign Out</a>
					</div>
				</div>
			</li>
		</ul>						
		<!-- Header actions end -->
	</div>
</header>