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
		
		$result = $db->ud_getQuery('SELECT * FROM (SELECT * FROM ud_users_attempt where attemptNo in (select max(attemptNo) from ud_users_attempt  group by quizID) ) x RIGHT JOIN ud_quiz q ON x.quizID = q.quizID WHERE q.quizPublished = 1 AND q.quizID = '.$_GET['quizID'].' AND q.subjectID = '.$_GET['subjectID']);
		
		$flag = true;
		$time = true;
		$attempt = true;
		
		if( $db->ud_getRowCountResult($result)==0)
		{
			$flag = false;
		}
		else
		{
			$quiz = $db->ud_mysql_fetch_assoc($result);
			if(strtotime($quiz['quiztimestampF'])<time())
			{
				$time = false;
			}
			if($quiz['attemptComplete'] != NULL)
			{
				if($quiz['attemptComplete'] == 0)
				{	
					$link = 'quizAttempt.php?subjectID='.$_GET['subjectID'].'&quizID='.$_GET['quizID'];
					header('location:'.$link);
				}
			}
			if(!empty($quiz['attemptNo']))
			{
				if($quiz['attemptNo'] >= $quiz['quizAttempts'])
				{
					$attempt = false;
				}
			}
		}
		
		if($flag == false)
		{
			header('location:index.php');	
		}
	}		
	
	function duration($time)
	{
		if($time == -1)
		{
			return '&#8734;';
		}	
		else
		{
			$a = array( 12 * 30 * 24 * 60 * 60  =>  'Year',30 * 24 * 60 * 60 =>'Month',24 * 60 * 60 =>  'Day',60 * 60 =>  'Hour',60 =>  'Minute',1 =>  'Second');
			$message ='';
			foreach ($a as $secs => $str) 
			{
				$d = $time / $secs;
				$time = $time % $secs;
				if ($d >= 1) 
				{
					$r = round($d);
					$message .= $r . ' ' . $str . ($r > 1 ? 's ' : ' ') ;
				}
			}
			return $message;
		}	
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
<!-- CSS -->
<link rel="stylesheet" href="../../resources/css/modules/student/quizStart.css"/>

</head>

<body>
<?php require '../../include/header/headerS.php'; ?>
<div class="row content">
	<form method="post" action="quizAttempt.php?subjectID=<?php echo $course['subjectID']; ?>&quizID=<?php echo $quiz['quizID']; ?>">	
		<input type="hidden" name="startAttempt" value="1"/>
		<div class="twelve columns">
			<h3><?php echo $quiz['quizName']; ?></h3>		
			<table class="quiz-table twelve columns">
				<tbody>
					<tr>
						<th>Duration</th>
						<td>
							<p><?php echo duration($quiz['quizDuration']); ?></p>
						</td>
					</tr>
					<tr>
						<th>Attemps Made</th>
						<td>
							<p><?php if(empty($quiz['attemptNo'])){ echo '0';}else{ echo $quiz['attemptNo'] ;} echo '/'.$quiz['quizAttempts']; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<center><input type="submit" class="button radius green two" value="Start Quiz now" /></center>
		</div>
	</form>
</div>
<?php require '../../include/footer/footerS.php'; ?>
</body>

</html>
