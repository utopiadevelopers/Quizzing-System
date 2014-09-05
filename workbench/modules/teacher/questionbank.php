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
		$result = $db->ud_whereQuery('ud_subject_category',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$course['subjectID']));
		$category = $db->ud_mysql_fetch_assoc_all($result);		
		$result = $db->ud_getQuery('SELECT * FROM  `ud_question` q JOIN `ud_question_type` t ON q.questionTypeID = t.questionTypeID JOIN `ud_subject_category` c ON q.questionCatID = c.categoryID JOIN `ud_users` u ON u.userID=q.userModID  WHERE c.subjectID = '.$_GET['subjectID'].' AND  q.userID = '.$_SESSION['userID'].' AND  q.questionThrashed = 0' );
		$question = $db->ud_mysql_fetch_assoc_all($result);
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
<!-- QuestionBank CSS -->
<link rel="stylesheet" href="../../resources/css/modules/question/questionbank.css"/>

</head>

<body>

<?php require '../../include/header/headerT.php'; ?>
<div class="content" style="margin-top: 40px;">
	<div class="row" style="margin-bottom: 30px;">
		<div class="five columns">
			<select id="category-select">
			<?php
				for($i=0;$i<sizeof($category);$i++)
				{
			?>
					<option value="<?php echo $category[$i]['categoryID']; ?>"><?php echo $category[$i]['category']; ?></option>
			<?php
				}
			?>
			</select> 
		</div>
		<div class="four columns">
			<a id="add-question" class="radius button" href="addQuestion.php?subjectID=<?php echo $course['subjectID']; ?>">Add Question</a> </div>
		<div class="three columns">
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<table class="question-bank">
				<thead>
					<tr>
						<th>#</th>
						<th>Question</th>
						<th>Type</th>
						<th>Category</th>
						<th>Modified By</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				for($i=0;$i<sizeof($question);$i++)
				{
				?>
					<tr>
						<td><?php echo ($i+1); ?></td>
						<td><?php echo $question[$i]['questionName']; ?></td>
						<td><?php echo $question[$i]['questionType']; ?></td>
						<td><?php echo $question[$i]['category']; ?></td>
						<td><?php echo $question[$i]['userName']; ?></td>
						<td style="width:10%;">
							<div class="question-id" id="<?php echo $question[$i]['questionID'] ?>"   row="<?php echo ($i+1); ?>">
								<input type="button" class="edit-button">
								<input type="button" class="delete-button">
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
	<div class="row reveal-modal [expand, xlarge, large, medium, small]" id="modal-edit-single" >
		<h3>Edit Question</h3>
		<div class="twelve columns">
			<div class="row">
				<div class="two columns mobile-one">
					<label class="right inline">Question</label>
				</div>
				<div class="ten columns mobile-three">
					<textarea id="questionText" placeholder="Enter the Question here"></textarea>
				</div>
				
			</div>			
		</div>
		<input type="button" value="Edit" class="button" id="edit-single" />
	</div>
</div>
<?php require '../../include/footer/footerT.php'; ?>
<!-- QuestionBank JS -->
<script language="javascript" src="../../resources/js/modules/teacher/questionbank.js" type="text/javascript"></script><!-- QuestionBank JS -->

</body>

</html>
<![endif]-->