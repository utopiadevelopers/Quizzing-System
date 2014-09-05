<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinS.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/student/student.inc.php';
	require 'question-function.php';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	
	
	if(isset($_POST['startAttempt']) &&!empty($_POST['startAttempt']))
	{
		$attempt = 1;
		$startAttempt = htmlentities($_POST['startAttempt']);
		$timestamp = $db->ud_timestamp();
		$db->ud_insertQuery('ud_users_attempt',array('userID'=>$_SESSION['userID'],'quizID'=>$_GET['quizID'],'attemptNo'=>$attempt,'attemptStart'=>$timestamp,'timestamp'=>time()));
		$result = $db->ud_whereQuery('ud_users_attempt',NULL,array('userID'=>$_SESSION['userID'],'quizID'=>$_GET['quizID'],'attemptStart'=>$timestamp));
		$attempt = $db->ud_mysql_fetch_assoc($result);
		$attemptID = $attempt['attemptID'];
	
		$result = $db->ud_whereQuery('`ud_quiz_question`',NULL,array('quizID'=>$_GET['quizID']));
		$question_list = $db->ud_mysql_fetch_assoc_all($result);
		for($i=0;$i<sizeof($question_list);$i++)
		{
			$db->ud_insertQuery('`ud_users_attempt_answer`',array('attemptID'=>$attemptID , 'questionID'=>$question_list[$i]['questionID'] , 'questionNo' => ($i+1)));
		}
	}
		
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
		
		$flag = true;
		$result = $db->ud_getQuery('SELECT * FROM (SELECT * FROM ud_users_attempt where attemptNo in ( select max(attemptNo) from ud_users_attempt where userID = '.$_SESSION['studentID'].' and quizID= '.$_GET['quizID'].' ) ) x RIGHT JOIN ud_quiz q ON x.quizID = q.quizID WHERE q.quizPublished = 1 AND q.quizID = '.$_GET['quizID'].' AND q.subjectID = '.$_GET['subjectID'].' AND x.userID = '.$_SESSION['studentID']);
		
		if( $db->ud_getRowCountResult($result)==0)
		{
			$flag = false;
		} 
		else
		{
			$quiz = $db->ud_mysql_fetch_assoc($result);
			if(strtotime($quiz['quiztimestampF'])<time())
			{
				$flag = false;
			}
			
			$attempt = 1;
			if($quiz['attemptNo'] != NULL)
			{
				if($quiz['attemptNo'] > $quiz['quizAttempts'])
				{
					$flag = false;
				}
				else
				{
					//$attempt = $quiz['attemptNo'] + 1;
				}
			}
			
			if($quiz['attemptComplete'] != NULL)
			{
				if($quiz['attemptComplete'] == 0)
				{
					$attemptID = $quiz['attemptID'];
				}
			}		
		}
		if($flag == false)
		{
			//header('location:index.php');	
		}
	}		
	$result = $db->ud_getQuery('SELECT * FROM `ud_users_attempt` a JOIN ud_quiz q ON a.quizID = q.quizID where attemptID = '.$attemptID);
	$quiz_detail = $db->ud_mysql_fetch_assoc($result);
	//print_r($quiz_detail);
	

	$_SESSION['attemptID'] = $attemptID;
	
	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array( 'attemptID' => $attemptID),'AND',false,'ORDER BY questionNo ASC');
	$question_list = $db->ud_mysql_fetch_assoc_all($result);
		
	
	function checkAttempt()
	{
		return true;
	}
	
	function check($flag)
	{
		if($flag == true)
		{
			echo 'True';
		}
		else 
		{
			echo 'False';
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
<span class="auto-style1">
<!-->
</span>
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
<link rel="stylesheet" href="../../resources/css/modules/question/question.css"/>
<link rel="stylesheet" href="../../resources/css/modules/student/quiz-attempt.css"/>
</head>

<body>
<?php require '../../include/header/headerS.php'; ?>
<div class="row content">
	<div class="twelve columns">
		<center><h4><?php echo $quiz_detail['quizName']; ?></h4></center>
		
		<?php
			for($i=0;$i<sizeof($question_list);$i++)
			{
			
				echo preview($question_list[$i]['questionID'],$i+1,$attemptID);
			}
		?>
		
	</div>
	
	<div class="clock-div">
		<div class="time-remaining-text">
			Time Remaining
		</div>
		
		<div class="time-rem">
			<span class="clock-h">00</span> :
			<span class="clock-m">00</span> :
			<span class="clock-s">00</span>
		</div>
	</div>
	
	<div class="submit">
		<input type="button" class="button secondary" id="submit" value="Submit The Quiz" style="margin-bottom: 40px;"/>
	</div>
</div>
<script type="text/javascript" src="../../resources/js/modules/student/quizAttempt.js"></script>
<?php require '../../include/footer/footerS.php'; ?>
</body>

</html>
