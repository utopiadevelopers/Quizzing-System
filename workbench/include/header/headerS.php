<?php
	$db = new dbHelper;
	$db->ud_connectToDB();
	
	$result = $db->ud_getQuery('SELECT * FROM `ud_subject` s JOIN ud_subjects_users r ON r.subjectID = s.subjectID JOIN `ud_users_subjects` u ON s.subjectID = u.subjectID JOIN ud_users t ON u.userTID = t.userID WHERE r.userID = u.userTID AND u.userSID = '.$_SESSION['userID']);
	$subA = array();
	$countA = 0;
	/*
	$subM = array();
	$countM = 0;
	*/
	$sub = array();
	$count = 0;
	$nodays = 1;
	$time = time();
	while(($data = $db->ud_mysql_fetch_assoc($result))!= NULL)
	{
		$subAT = abs($time - strtotime($data['subjectAcc']));		
		//$subMT = abs($time - strtotime($data['subjectMod']));
		
		if($subAT < 86400* $nodays)
		{
			$subA[$countA++] = $data;
		}
		/*
		if($subMT < 86400* $nodays)
		{
			$subM[$countM++] = $data;
		}
		*/
		$sub[$count++] = $data;
		
		
	}
?>

<div class="header">
	<div class="row">
		<div class="twelve columns">
			<nav class="top-bar">
				<ul>
					<li class="name">
					<h1><a href="index.php">
					<img src="../../resources/images/utopia.png"></a></h1>
					</li>
					<li class="toggle-topbar"><a href="#"></a></li>
				</ul>
				<section>
					<ul class="left">
						<li class="divider"></li>
						<li><a href="index.php">Dashboard</a></li>
						<li class="divider"></li>
						<li class="has-dropdown"><a href="#">Courses</a>
						<ul class="dropdown">
							<li><label>Recently Viewed</label></li>
							<?php
								
								for($i=0;$i<sizeof($subA);$i++)
								{
							?>
							<li><a href="course.php?subjectID=<?php echo $subA[$i]['subjectID']; ?>"><?php echo $subA[$i]['subjectName']; ?></a></li>
							<?php
								}
								if(sizeof($subA) == 0)
								{
									echo '<li><a href="#">None</a></li>';
								}
							?>

<!-- 							<li><label>Recently Updated</label></li>
							<?php
								for($i=0;$i<sizeof($subM);$i++)
								{
							?>
							<li><a href="course.php?subjectID=<?php echo $subM[$i]['subjectID']; ?>""><?php echo $subM[$i]['subjectName']; ?></a></li>
							<?php
								}
								if(sizeof($subM) == 0)
								{
									echo '<li><a href="#">None</a></li>';
								}

							?>

-->
							<li class="divider"></li>
							<li><a href="#">Add Course</a></li>
						</ul>
						</li>
					</ul>
				</section>
				<ul class="right">
					<li class="divider" style="margin-right: 5px;"></li>
					<li><input id="searchBar" type="text" /></li>
					<li class="divider" style="margin-left: 5px;"></li>
					<li class="has-dropdown"><a href="#">
					<img alt="user" class="user-image" src="../../resources/images/common/user_blue.png" /></a>
					<ul class="dropdown">
						<li><a href="profile.php">View Profile</a></li>
						<li><a href="#">Manage Account</a></li>
						<li><a href="#">Inbox (2)</a></li>
						<li class="divider"></li>
						<li><a href="../../logout.php">Logout</a></li>
					</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<?php 

if($banner == true)
{
?>
<div class="banner" style="margin-bottom:40px;">
	<div class="row">
		<div class="two columns hide-for-small">
			<img src="../../uploads/subject/<?php echo  $course['subjectLogo']; ?>" width="80%"> </div>
		<div class="six columns mobile-four">
			<h3 style="text-align: left;"><?php echo  $course['subjectName']; ?></h3>
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
					<li class="has-flyout"><a href="#">Quiz</a>
					<a class="flyout-toggle" href="#"><span></span></a>
					<ul class="flyout">
						<li><a href="upcoming.php?subjectID=<?php echo $course['subjectID']; ?>">Upcoming Quiz</a></li>
					</ul>
					</li>
					<li class="hide-for-small" style="float: right;"><a href="#">
					<img alt="Settings" class="setting"></a></li>
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

