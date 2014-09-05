<?php

?>
<div class="header">
	<div class="row">
		<div class="twelve columns">
			<nav class="top-bar">
				<ul>
					<li class="name">
					<h1><a href="home">
					<img src="../../resources/images/utopia.png"></a></h1>
					</li>
					<li class="toggle-topbar"><a href="#"></a></li>
				</ul>
				<section>
					<ul class="left">
					</ul>
				</section>
				<ul class="right">
					<li class="divider" style="margin-right: 5px;"></li>
					<li><input id="searchBar" type="text" /></li>
					<li class="divider" style="margin-left: 5px;"></li>
					<li class="has-dropdown"><a href="#"><img src="../../resources/images/common/user_blue.png" alt="user" class="user-image"/></a>
						<ul class="dropdown">
							<li><a href="#">View Profile</a></li>
							<li><a href="#">Manage Account</a></li>
							<li><a href="#">Inbox (2)</a></li>
							<li class="divider"></li>
							<li><a href="../../logout.php">Logout</a></li>						
						</ul>
				</ul>
			</nav>
		</div>
	</div>
</div>
<div class="banner" style="margin-bottom:40px;">
	<div class="row">
		<div class="three columns">
			<img src="../../uploads/director/vit.png" width="100%">
		</div>
	</div>
	<div class="banner-navigation-wrapper">
		<div class="row">
			<div class="twelve columns mobile-four">
				<ul class="nav-bar">
					<li><a href="index.php">Overview</a></li>
					<li class="has-flyout"><a href="#">Courses</a>
					<a class="flyout-toggle" href="#"><span></span></a>
					<ul class="flyout">
						<li><a href="addCourse.php">Add Course</a></li>
						<li><a href="viewCourse.php">View Course</a></li>
					</ul>
					</li>
					<li class="has-flyout"><a href="#">Teachers</a>
					<a class="flyout-toggle" href="#"><span></span></a>
					<ul class="flyout">
						<li><a href="addTeacher.php">Add Teacher</a></li>
						<li><a href="viewTeacher.php">View Teacher</a></li>
					</ul>
					</li>
					<li class="hide-for-small" style="float: right;">
						<a href="#">Settings</a>
					</li>
				</ul>
				<div class="clear">
				</div>
			</div>
		</div>
	</div>
</div>
<?php ?>