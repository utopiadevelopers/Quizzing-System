<?php ?>
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
						<li class="divider"></li>
						<li><a href="#">Dashboard</a></li>
						<li class="divider"></li>
						<li class="has-dropdown"><a href="#">Courses</a>
						<ul class="dropdown">
							<li><label>Reciently Viewed</label></li>
							<li><a href="#">Internet and Web Programming</a></li>
							<li><a href="#">Course 2</a></li>
							<li><a href="#">Course 3</a></li>
							<li><label>Reciently Updated</label></li>
							<li><a href="#">Course 1</a></li>
							<li><a href="#">Course 2</a></li>
							<li><a href="#">Course 3</a></li>
							<li class="divider"></li>
							<li><a href="#">Add Course</a></li>
						</ul>
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
	<?php
	if($banner == true)
{
?>
<div class="banner" style="margin-bottom:40px;">
	<div class="row">
		<div class="two columns hide-for-small">
			<img src="../../uploads/subject/<?php echo $course['subjectLogo']; ?>" width="80%"> </div>
		<div class="six columns mobile-four">
			<h3 style="text-align: left;"><?php echo $course['subjectName']; ?></h3>
			<div class="row banner-quicklinks">
				<div class="ten columns">
					<a href="profile.php"><?php echo $course['userName']; ?></a> </div>
				<div class="two columns">
					<!-- <a href="#">Follow</a>  --></div>
			</div>
		</div>
		<div class="four columns">
		</div>
	</div>
	<div class="banner-navigation-wrapper">
		<div class="row">
			<div class="twelve columns mobile-four">
				<ul class="nav-bar">
					<li><a href="overview.php?subjectID=<?php echo $course['subjectID']; ?>">Overview</a></li>
					<li class="has-flyout"><a href="#">Reports</a>
					<a class="flyout-toggle" href="#"><span></span></a>
					<ul class="flyout">
						<li><a href="reportsGrade.php?subjectID=<?php echo $course['subjectID']; ?>">Grades</a></li>
						<li><a href="#">Logs</a></li>
					</ul>
					</li>					
				</ul>
				<div class="clear">
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}
else
{
echo '<div class="empty-banner"></div>';
}
?>
</div>
<?php ?>