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
		$result = $db->ud_whereQuery('ud_quiz',NULL,array('subjectID' => $course['subjectID'],'userID' => $course['userTID'] , 'quizPublished'=>1));		
		$quiz = $db->ud_mysql_fetch_assoc_all($result);

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
<link rel="stylesheet" href="../../resources/css/modules/student/upcoming.css"/>
</head>

<body>

<?php require '../../include/header/headerS.php'; ?>
<div class="row content">
	<div class="twelve columns">
	<?php
	if(sizeof($quiz)>0)
	{
	?>
		<h3>Quizzes</h3>
		<ul class="accordion">
		<?php
		for($i=0;$i<sizeof($quiz);$i++)
		{
		
		$result = $db->ud_whereQuery('ud_users_attempt',NULL,array('quizID' => $quiz[$i]['quizID'],'userID' => $_SESSION['userID'],'attemptComplete'=>1),'AND',false,'ORDER BY attemptNo DESC');		
		$bool = true;
		$button_flag = true;
		if( $db->ud_getRowCountResult($result)==0)
		{
			$bool = false;
		}
		else
		{
			$quiz_attempt = $db->ud_mysql_fetch_assoc_all($result);
			
		}	
		?>
			<li>
			<div class="title">
				<h5><?php echo $quiz[$i]['quizName']; ?></h5>
			</div>
			<div class="content">
				
				<a href="quizStart.php?subjectID=<?php echo $course['subjectID']; ?>&quizID=<?php echo $quiz[$i]['quizID']; ?>" class="button radius two" style="margin-bottom:20px;">Attempt Quiz</a>
				<table class="quiz-table twelve columns">
					<tbody>
						<tr>
							<th>Hard Deadline</th>
							<td>
							<time><?php echo date('D j M Y g:i A',strtotime($quiz[$i]['quiztimestampF'])); ?></time>
							<p class="quiz-help-text">If you submit any time after the hard deadline, you will not receive credit.</p>
							</td>
						</tr>
						<tr>
							<th>Effective Score</th>
							<td>
							<?php 
								if(!$bool)
								{ 
									echo 'N/A';
								}
								else
								{ 
									if($quiz[$i]['quizEffectiveScoreType'] == 0)
									{
										echo number_format($quiz_attempt[0]['attemptScore'],2).' / '.number_format($quiz[$i]['quizTotScore'],2); 
										echo '<p class="quiz-help-text">Your effective score will be based on your latest attempt and will take into account penalties due to late submission. If you make attempts past the max number of attempts or past the hard deadline they will be ignored.</p>';
									}
									else if($quiz[$i]['quizEffectiveScoreType'] == 1)	
									{
										$mark = 0;
										for($j = 0 ; $j <sizeof($quiz_attempt) ; $j++)
										{
											if($mark<$quiz_attempt[$j]['attemptScore'])
											{
												$mark = $quiz_attempt[$j]['attemptScore'];
											}
										}

										echo number_format($mark,2).' / '.number_format($quiz[$i]['quizTotScore'],2); 
										echo '<p class="quiz-help-text">Your effective score will be based on your attempt having maximum score and will take into account penalties due to late submission. If you make attempts past the max number of attempts or past the hard deadline they will be ignored.</p>';										
									}
								}	 
							?> 
							</td>
						</tr>
						<tr>
							<th># of Attempts</th>
							<td>
								<?php if(!$bool){ echo '0';}else{ echo sizeof($quiz_attempt); } echo '/'.$quiz[$i]['quizAttempts'] ?>
							</td>
						</tr>
						<?php
						if($bool)
						{
						?>
						<tr>
							<th>Last Attempted</th>
							<td>
								<time><?php echo date('D j M Y g:i A',strtotime($quiz_attempt[0]['attemptEnd'])); ?></time>
							</td>
						</tr>
						<tr>
							<th>Last Attempted Score</th>
							<td>
								<?php echo number_format($quiz_attempt[0]['attemptScore'],2).' / '.number_format($quiz[$i]['quizTotScore'],2); ?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			</li>
		<?php
		}
		?>
		</ul>
	<?php
	}
	else
	{
	?>
	
	<h3>No Upcoming Quiz</h3>
	
	<?php
	}
	?>
	</div>
</div>
<?php require '../../include/footer/footerS.php'; ?>

</body>

</html>
<![endif]-->