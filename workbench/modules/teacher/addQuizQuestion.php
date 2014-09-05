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
		
		//Getting Quiz Details 
		$result = $db->ud_getQuery('SELECT * FROM (SELECT quizID, COUNT( quizID ) as  attempt , attemptNo FROM `ud_users_attempt` WHERE attemptNo = 1 GROUP BY quizID) a RIGHT JOIN `ud_quiz` q ON a.quizID = q.quizID WHERE q.userID = '.$_SESSION['userID']. ' AND q.subjectID = '.$_GET['subjectID']. ' AND q.quizID = '.$_GET['quizID']);
		if( $db->ud_getRowCountResult($result)==0 )
		{
			header('location:index.php');	
		}
		$quiz = $db->ud_mysql_fetch_assoc($result);
		
		$result = $db->ud_getQuery('SELECT * FROM `ud_quiz_question` a JOIN `ud_question` q ON a.questionID = q.questionID JOIN `ud_question_type` t ON q.questionTypeID = t.questionTypeID JOIN `ud_subject_category` c ON q.questionCatID = c.categoryID where a.quizID = '.$_GET['quizID'].' ORDER BY a.questionNo ASC');
		$quiz_q = $db->ud_mysql_fetch_assoc_all($result);				
		$result = $db->ud_whereQuery('`ud_subject_category`',NULL,array('userID' => $_SESSION['userID'] , 'subjectID' => $course['subjectID']));
		$category = $db->ud_mysql_fetch_assoc_all($result);		
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
<?php require '../../include/header/datatable.php'; ?>

<!-- Quiz CSS -->
<link href="../../resources/css/modules/teacher/addQuizQues.css" rel="stylesheet" />
<link rel="stylesheet" href="../../resources/css/modules/question/question.css"/>
</head>

<body>

<?php require '../../include/header/headerT.php'; ?>
<div class="row" style="margin-top: 20px;">
	<div class="twelve columns">
		<dl class="tabs">
			<dd class="active"><a href="#simple1">Quiz Settings</a></dd>
			<dd><a href="#simple2">Add Question</a></dd>
			<dd><a href="#simple3">Question List</a></dd>
		</dl>
		<ul class="tabs-content">
			<li id="simple1Tab" class="active">
			<p>You can Edit the Quiz here</p>
			<div class="row">
				<div class="two columns">
					<label class="inline right">Quiz Title :</label>
					<label class="inline right">Start Date :</label>
					<label class="inline right">End Date :</label>
					<label class="inline right">Duration :</label> </div>
				<div class="four columns">
					<label class="inline"><?php echo $quiz['quizName']; ?></label>
					<label class="inline"><?php echo $quiz['quiztimestampS']; ?></label>
					<label class="inline"><?php echo $quiz['quiztimestampF']; ?></label>
					<label class="inline"><?php echo duration($quiz['quizDuration']); ?></label>
				</div>
				<div class="six columns">
				</div>
			</div>
			</li>
			<li id="simple2Tab">
				<h3 style="margin-left:100px;">Add Question</h3>
				<div class="row">
					<div class="three columns">
						<label class="inline right bold">Question Category</label>
						<label class="inline right bold">Question Title/Text</label>
					</div>
					<div class="seven columns">
						<select id="category-select">
						<?php 
						for($i=0;$i<sizeof($category);$i++)
						{
						?>
							<option value="<?php echo $category[$i]['categoryID'];?>"><?php echo $category[$i]['category']; ?></option>	
						<?php
						}
						?>
						</select>
						<select id="question-select" disabled="disabled">
						
						</select>
						<a id="add-all">Add All Questions in this category</a>
					</div>
					<div class="two columns"></div>
				</div>
				<div class="row">
					<div class="five columns">
					
					</div>
					<div class="two columns">
						<h3>OR</h3>
					</div>
					<div class="five columns">
					</div>
				</div>
				<div class="row">
					<div class="one columns"></div>
					<div class="nine columns">
						<input type="text" placeholder="Type in Your Question Text / Title" id="question-auto"/>
					</div>
					<div class="two columns"></div>
				</div>
				<div class="row" id="row-preview">
					<div class="twelve columns" style="background:#D8D8CD;min-height:200px; margin-top:30px; margin-bottom:30px;" id="question-preview">
					</div>
				</div>
				<div class="row" id="row-grade">
					<div class="one columns"></div>
					<div class="three columns">
						<input type="number" placeholder="Question Grade" id="question-grade"/>
					</div>
					<div class="three columns">
						<div class="button" id="add-question" style="height:32px;">Add Question</div>
					</div>
					<div class="five columns"></div>
				</div>
				
			</li>
			<li id="simple3Tab">
			<div class="row" style="margin-top: 20px;">
				<div class="twelve columns">
					<table class="quiz-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Question Name</th>
								<th>Category</th>
								<th>Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						for($i=0;$i<sizeof($quiz_q);$i++)
						{
							if($quiz_q[$i]['questionName'] == '')
							{
								$size = 40;
								if($size<sizeof($quiz_q[$i]['questionText']))
								{
									$quiz_q[$i]['questionName'] =substr($quiz_q[$i]['questionText'],0,40);
								}
								else
								{
									$quiz_q[$i]['questionName'] =$quiz_q[$i]['questionText'];
								}
								
							}
						?>
							<tr>
								<td><?php echo ($i+1); ?></td>
								<td><?php echo $quiz_q[$i]['questionName']; ?></td>
								<td><?php echo $quiz_q[$i]['category']; ?></td>
								<td><?php echo $quiz_q[$i]['questionType']; ?></td>
								<td></td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			</li>
		</ul>
	</div>
</div>
<?php require '../../include/footer/footerT.php'; ?>
<!-- Quiz JS -->
<script language="javascript" src="../../resources/js/modules/tablesDataGrid.js" type="text/javascript"></script>
<script language="javascript" src="../../resources/js/modules/teacher/addQuizQues.js" type="text/javascript"></script>

</body>

</html>