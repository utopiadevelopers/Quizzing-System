<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinP.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';

	
	$db = new dbHelper;
	$db->ud_connectToDB();	

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
<!-- Course CSS -->
<link rel="stylesheet" href="../../resources/css/modules/parent/dashboard.css"/>

</head>

<body>
<?php require '../../include/header/headerP.php'; ?>

<?php 
	$parentID =$_SESSION['parentID'];
	$result = $db->ud_getQuery("SELECT * FROM ud_users a Join ud_parent_son b on b.sonID = a.userID");
	$child = $db->ud_mysql_fetch_assoc_all($result);
	$childName = $child[0]['userName'];
	$_SESSION['sonID']=$child[0]['userID'];
	$result = $db->ud_getQuery("SELECT * FROM `ud_subject` s JOIN ud_subjects_users r ON r.subjectID = s.subjectID JOIN `ud_users_subjects` u ON s.subjectID = u.subjectID JOIN ud_users t ON u.userTID = t.userID JOIN ud_parent_son p ON p.sonID = u.userSID WHERE r.userID = u.userTID AND p.parentID = $parentID");
	$sub = $db->ud_mysql_fetch_assoc_all($result);
?>
<div class="content-teacher" style="min-height:500px;">
<div class="row">
	<div class="twelve columns">
		<h3>Parent of <?php echo "$childName";?></h3>
		<?php 
		if(sizeof($sub)>0)
		{
		?>
			<h3>Wards Courses</h3>
			<?php
			
			for($i=0;$i<sizeof($sub);$i++)
			{
				$per = abs(time() - strtotime($sub[$i]['subjectStart'])) / (strtotime($sub[$i]['subjectEnd']) - strtotime($sub[$i]['subjectStart']));
				$per = floor($per * 100);
				if($per>100)
				{
						$per = 100;
				}
			?>
			<div class="row course"> 
				<div class="three column course-logo-div hide-for-small">
					<img src="../../uploads/subject/<?php echo $sub[$i]['subjectLogo']; ?>" alt="Course Logo"/>				
				</div>
				<div class="six column course-name-div">	
					<a href="courseinfo.php?subjectID=<?php echo $sub[$i]['subjectID']; ?>" class="course-name"><?php echo $sub[$i]['subjectName'];?></a><br/>
					<label class="course-instructor">Prof <?php echo $sub[$i]['userName']; ?></label><br/>
					<label class="course-right-label" style="float:left;"><?php echo date('M jS', strtotime($sub[$i]['subjectStart'])); ?></label>
					<label class="course-right-label" style="float:right;"><?php echo date('M jS', strtotime($sub[$i]['subjectEnd'])); ?></label>
					<div class="clear"></div>
					<div class="nice round progress alert course-progress"><span class="meter" style="width:<?php echo $per; ?>%"></span></div>		
				</div>
				<div class="three column course-right-div">			
					<label class="course-right-label"><?php echo date('M jS Y', strtotime($sub[$i]['subjectStart'])); ?></label>	
					<label class="course-right-label"><?php echo  floor((strtotime($sub[$i]['subjectEnd']) - strtotime($sub[$i]['subjectStart']))/604800); ?> Weeks long</label>	
					<a class="button radius course-right-button" href="course.php?subjectID=<?php echo $sub[$i]['subjectID']; ?>">View Performance</a><br/>
					
				</div>
			</div>				
			<?php
			}
			?>
		<?php
		}
		?>
		
	</div>
</div>
</div>
<?php require '../../include/footer/footerP.php'; ?>
</body>

</html>
