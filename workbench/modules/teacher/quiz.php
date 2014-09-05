<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/teacher/teacher.inc.php';
	
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
	$result = $db->ud_getQuery('SELECT * FROM `ud_subject` s JOIN `ud_subjects_users` u ON s.subjectID = u.subjectID WHERE u.subjectID = '.$courseID.' AND u.userID = '.$_SESSION['userID']);
	if( $db->ud_getRowCountResult($result)==0)
	{
		header('location:index.php');	
	}
	else
	{
		$course = $db->ud_mysql_fetch_assoc($result);
		updateAcc($course['subjectID']);
		
		//	Quiz
		$result = $db->ud_getQuery('SELECT * FROM (SELECT quizID,count(questionID) as count FROM `ud_quiz_question` GROUP BY quizID) x LEFT JOIN (SELECT quizID, COUNT( quizID ) as  attempt , attemptNo FROM `ud_users_attempt` WHERE attemptNo = 1 GROUP BY quizID) a ON x.quizID = a.quizID RIGHT JOIN `ud_quiz` q ON a.quizID = q.quizID WHERE q.userID = '.$_SESSION['userID']. ' AND q.subjectID = '.$_GET['subjectID']);
		$quiz = $db->ud_mysql_fetch_assoc_all($result);			
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
<title><?php echo $_SESSION['userLogin'] ?> - Quiz</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />

<?php require '../../include/header/foundation.php'; ?>
<?php require '../../include/header/datatable.php'; ?>
<!-- Quiz CSS -->
<link rel="stylesheet" href="../../resources/css/modules/teacher/quiz.css"/>
<!-- DateTime Picker -->
<!-- JS -->
<script type="text/javascript" src="../../resources/js/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript" src="../../resources/js/jquery-ui-timepicker-addon.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="../../resources/css/frontend/datetimepicker.css"/>


</head>

<body>
<?php require '../../include/header/headerT.php'; ?>
<div class="content-teacher">
	<div id="myModal" class="reveal-modal [expand, xlarge, large, medium, small]">
		<div class="row">
			<h3>Add Quiz</h3>
			<div class="three columns">
				<label class="inline">Quiz Title :</label>
				<label class="inline">Start Date :</label>
				<label class="inline">End Date :</label>
				<label class="inline">Duration :</label>
			</div>
			<div class="seven columns">
				<input type="text" placeholder="eg. Quiz - 1" name="quizTitle"/>
				<input type="text" placeholder="From Date" id="fromDateTime" name="quizF"/>
				<input type="text" placeholder="To Date" id="toDateTime" name="quizT"/>
				<div>
					<select id="hour-select">
						<?php 
						for($i=0;$i<13;$i++)
						{
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?> Hour</option>
						<?php 
						}
						?>
					</select>
					<select id="minute-select">
						<?php 
						for($i=0;$i<59;$i++)
						{
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?> Minutes</option>
						<?php 
						}
						?>
					</select>
									</div>
			</div>
			<div class="two columns"></div>
		</div>
		<div class="row">
			<div class="four columns">
				<div class="button radius" id="add-quiz">Add</div>
			</div>
			<div class="four columns">
				<div class="button radius" id="close-box">Close</div>
			</div>
			<div class="six columns"></div>
		</div>
	</div>

	<div class="row" style="margin-top:30px;">
		<div class="two columns">
			<div class="radius button" style="height:32px;" id="add-quiz-modal" rowcount="<?php echo sizeof($quiz); ?>">Add</div>
		</div>
		<div class="ten columns"></div>
	</div>
			
	<div class="row" style="margin-top:20px;">
		<div class="twelve columns">
			<table class="quiz-table">
				<thead>
					<tr>
						<th>#</th>
						<th>Quiz Title</th>
						<!--
						<th>From</th>
						<th>To</th>
						 -->
						<th>Duration</th>
						<th>Question Count</th>
						<th>Attempts</th>
						<th>Add/Modify Ques</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				for($i=0;$i<sizeof($quiz);$i++)
				{
					if(empty($quiz[$i]['count']))
					{
						$quiz[$i]['count'] = '-';
					}
					if(empty($quiz[$i]['attempt']))
					{
						$quiz[$i]['attempt'] = '-';
					}
				?>
					<tr>
						<td><?php echo ($i+1); ?></td>
						<td><?php echo $quiz[$i]['quizName']; ?></td>
						<!-- 
						<td><?php echo $quiz[$i]['quiztimestampF']; ?></td>
						<td><?php echo $quiz[$i]['quiztimestampS']; ?></td>
						 -->
						<td><?php echo duration($quiz[$i]['quizDuration']); ?></td>
						<td><?php echo $quiz[$i]['count']; ?></td>
						<td><?php echo $quiz[$i]['attempt']; ?></td>
						<td>
							<?php 
							if($quiz[$i]['attempt'] =='-')
							{
							?>
								<span style="color:green;">Can Be Edited</span>
							<?php
							}
							else
							{
							?>
								<span style="color:maroon;">Cannot be Edited</span>
							<?php
							}
							?>
						</td>
						<td>
							<div class="quiz-id" id="<?php echo $quiz[$i]['quizID'] ?>" row="<?php echo ($i+1); ?>">
								<input type="button" class="edit-button add-button"/>
								<input type="button" class="edit-button"/>
								<input type="button" class="delete-button"/>
							</div>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<?php require '../../include/footer/footerT.php'; ?>
<!-- Quiz JS -->
<script language="javascript" src="../../resources/js/modules/tablesDataGrid.js" type="text/javascript"></script>
<script language="javascript" src="../../resources/js/modules/teacher/quiz.js" type="text/javascript"></script>

</body>

</html>
