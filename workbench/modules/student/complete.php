<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinS.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/student/student.inc.php';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	

	$banner = true;
	if(isset($_GET['subjectID']) && !empty($_GET['subjectID']))
	{
		$courseID = $_GET['subjectID'];
	}
	else
	{
		header('location:index.php');
	}
	$course = array();
	$result = $db->ud_getQuery('SELECT * FROM `ud_subject` s JOIN `ud_users_subjects` u ON s.subjectID = u.subjectID JOIN (select userID,userName from `ud_users`) x ON x.userID = u.userTID WHERE u.subjectID = '.$courseID.' AND u.userSID = '.$_SESSION['userID']);
	if( $db->ud_getRowCountResult($result)==0)
	{
		header('location:index.php');	
	}
	else
	{
		$course = $db->ud_mysql_fetch_assoc($result);
		updateAcc($course['subjectID']);
	}		
			
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
<?php require '../../include/header/headerS.php'; ?>
<div class="row content">
	<div class="twelve columns">
		<h5>Thanks For Giving the Quiz.Your Answers will be Graded Shortly</h5>
	</div>
</div>
<?php require '../../include/footer/footerS.php'; ?>
</body>

</html>
