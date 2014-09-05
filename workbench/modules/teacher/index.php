<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';	

	$banner = false;
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]--><!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">

<![endif]--><!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">

<![endif]--><!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">

<!--<![endif]-->

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $_SESSION['userLogin'] ?> - Home</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />

<?php require '../../include/header/foundation.php'; ?>

</head>

<body>
<?php require '../../include/header/headerT.php'; ?>
<div class="content-teacher">
	<div class="row">
		<div class="eight columns">
		</div>
		<div class="four columns">
			<div class="panel">
				<h5>Courses</h5>
				<ul class="disc">
					<?php
						for($i=0;$i<sizeof($sub);$i++)
						{
					?>
						<li><a href="course.php?subjectID=<?php echo $sub[$i]['subjectID']; ?>""><?php echo $sub[$i]['subjectName']; ?></a></li>
					<?php
						}
					?>
				</ul>

			</div>
		</div>
	</div>
</div>
<?php require '../../include/footer/footerT.php'; ?>
</body>

</html>
