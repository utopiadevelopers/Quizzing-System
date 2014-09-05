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
<?php require '../../include/header/headerT.php'; ?>
<div class="content-teacher">
	<div class="row">
		<div>
			<h4>Select Question Type</h4>
			<div class="row">
				<div class="five columns">
					<select id="selectQuestion">
						<option value="1">Single Choice</option>
						<option value="2">Multiple Choice</option>
						<option value="3">Subjective</option>
						<option value="4">True/False</option>
						<option value="5">Matching</option>
						<option value="6">Numerical</option>
					</select>					
				</div>
			</div>	
			<div class="addQuestion-content">
			<form>
				<fieldset>	
				<legend>Enter a Question</legend>		
					<div class="row">
						<div class="two columns mobile-one">
							<label class="right inline">Question Name</label>
						</div>
						<div class="six columns mobile-three">
							<input id="questionName" type="text" placeholder="Enter Question Name">
						</div>
						<div class="four columns">
						</div>
					</div>
					<div class="row">
						<div class="two columns mobile-one">
							<label class="right inline">Question</label>
						</div>
						<div class="ten columns mobile-three">
							<textarea id="questionText" placeholder="Enter the Question here"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="two columns mobile-one">
							<label class="right inline">Default Marks</label>
						</div>
						<div class="six columns mobile-three">
							<input id="defaultMarks" type="number" placeholder="Enter Default Marks">
						</div>
						<div class="four columns">
						</div>
					</div>	
					<div class="row">
						<div class="two columns mobile-one">
							<label class="right inline">Shuffle the Choices</label>
						</div>
						<div class="six columns mobile-three">
							<input id="shuffleChoices" type="checkbox">
						</div>
						<div class="four columns">
						</div>
					</div>		
					<hr>
					<fieldset>
					<legend>Choices</legend>
					<div class="row">
						<div class="three columns">
							<label class="right inline">Add/Remove Additional choices</label>
						</div>
						<div class="two columns">
							<input type="button" class="button" id="addChoice" value="Add Choice">
						</div>
						<div class="two columns">
							<input type="button" class="button" id="removeChoice" value="Remove Choice">
						</div>
						<div class="five columns">
						</div>
					</div>	
					<div class="choice-single">
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Choice 1</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the Choice">
							</div>
							<div class="four columns">
								<label for="radio1"><input name="radio-choice" type="radio" checked="checked" id="radio1">Is Choice Correct</label>
							</div>
						</div>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Grade</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter Grade Percentage eg 33">
							</div>
							<div class="four columns">
							</div>
						</div>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Feedback</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the feedback for the Choice">
							</div>
							<div class="four columns">
							</div>
						</div>
					</div>
					<hr>
					<div class="choice-single">
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Choice 2</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the Choice">
							</div>
							<div class="four columns">
								<label for="radio2"><input name="radio-choice" type="radio" id="radio2">Is Choice Correct</label>
							</div>
						</div>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Grade</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter Grade Percentage eg 33">
							</div>
							<div class="four columns">
							</div>
						</div>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Feedback</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the feedback for the Choice">
							</div>
							<div class="four columns">
							</div>
						</div>
					</div>
					</fieldset>
					<fieldset>
					<legend>Combined Feedback</legend>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Any Correct Response</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the feedback for a correct response">
							</div>
							<div class="four columns">
							</div>
						</div>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Any Incorrect Response</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the feedback for an incorrect response">
							</div>
							<div class="four columns">
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend>Additional Options</legend>
						<div class="row">
							<div class="two columns mobile-one">
								<label class="right inline">Penalty For Incorrect Answer</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter Penalty in Percentage eg 33">
							</div>
							<div class="four columns">
							</div>
						</div>
						<div class="row hint">
							<div class="two columns mobile-one">
								<label class="right inline">Hint 1</label>
							</div>
							<div class="six columns mobile-three">
								<input type="text" placeholder="Enter the Hint">
							</div>
							<div class="four columns">
							</div>
						</div>
						<div class="row">
							<div class="three columns">
								<label class="right inline">Add/Remove Additional Hints</label>
							</div>
							<div class="two columns">
								<input type="button" class="button" id="addHint" value="Add Hint">
							</div>
							<div class="two columns">
								<input type="button" class="button" id="removeHint" value="Remove Hint">
							</div>
							<div class="five columns">
							</div>
						</div>
					</div>
					</fieldset>
				</fieldset>
			</form>
			</div>
			<div class="row" style="margin-bottom: 20px;">
				<div class="four columns">
				</div>
				<div class="two columns" style="padding-left: 20px;padding-right: 20px;">
					<input id="addButton" style="width: 100%;" class="button" type="button" value="Add" />
				</div>
				<div class="two columns" style="padding-left: 20px;padding-right: 20px;">
					<input id="cancelButton" style="width: 100%;" class="button" type="button" value="Cancel" />
				</div>
				<div class="four columns">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../../resources/js/modules/questions/addQuestion.js"></script> 
<?php require '../../include/footer/footerT.php'; ?>
</body>

</html>
