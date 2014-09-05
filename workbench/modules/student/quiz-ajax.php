<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinS.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/student/student.inc.php';

	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_getQuery('SELECT * FROM ud_users_attempt a JOIN ud_quiz q ON a.quizID = q.quizID WHERE a.userID = '.$_SESSION['studentID'].' AND a.attemptID = '.$_SESSION['attemptID']);
	$attempt = $db->ud_mysql_fetch_assoc($result);
	
	//print_r($attempt);
	$attemptID = $attempt['attemptID'];
	
	if(isset($_POST['time']) && !empty($_POST['time']))
	{
		$start = $attempt['timestamp'];
		$end   = time();
		echo $attempt['quizDuration'];	
		//echo $db->ud_timestamp();
		//echo $attempt['quizDuration'] ;
	}
	
	if(isset($_POST['type']) && !empty($_POST['type']))
	{
		if($_POST['type'] == 'single')
		{
			if(checkQuestion($_POST['questionID'],1))
			{
				$db->ud_updateQuery('`ud_users_attempt_answer`',array('answer'=>$_POST['choiceID']),array('attemptID'=>$attemptID,'questionID'=>$_POST['questionID']));
				echo 'True';
			}
			else
			{
				return 'False';
			}
		}
		else if($_POST['type'] == 'multiple')
		{
			if(checkQuestion($_POST['questionID'],2))
			{
				$db->ud_updateQuery('`ud_users_attempt_answer`',array('answer'=>$_POST['choiceID']),array('attemptID'=>$attemptID,'questionID'=>$_POST['questionID']));
				echo 'True';
			}
			else
			{
				return 'False';
			}
		}
		
		else if($_POST['type'] == 'true-false')
		{
			if(checkQuestion($_POST['questionID'],3))
			{
				$db->ud_updateQuery('`ud_users_attempt_answer`',array('answer'=>$_POST['choiceVal']),array('attemptID'=>$attemptID,'questionID'=>$_POST['questionID']));	
				echo 'True';
			}
			else
			{
				return 'False';
			}
		}
		else if($_POST['type'] == 'subjective')
		{
			if(checkQuestion($_POST['questionID'],3))
			{
				$db->ud_updateQuery('`ud_users_attempt_answer`',array('answer'=>$_POST['questionText']),array('attemptID'=>$attemptID,'questionID'=>$_POST['questionID']));	
				echo 'True';
			}
			else
			{
				return 'False';
			}
		}
		else if($_POST['type'] == 'numerical')
		{
			if(checkQuestion($_POST['questionID'],6))
			{
				$db->ud_updateQuery('`ud_users_attempt_answer`',array('answer'=>$_POST['questionText']),array('attemptID'=>$attemptID,'questionID'=>$_POST['questionID']));	
				echo 'True';
			}
			else
			{
				return 'False';
			}
		}
	}
	
	function checkQuestion($questionID,$type)
	{
		return true;
	}

?>