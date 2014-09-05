<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';	
	require '../../include/modules/teacher/teacher.inc.php';
	require_once '../../adminpanel/include/common/Classes/PHPExcel.php';
	
	
	
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
<div  >
		
</div>
<div class="content-reports-grade">
	<div class="row" style="margin-top: 20px;">
		<div class="two columns">
			<label class="right inline">Select Quiz</label>
		</div>
		<div class="six columns">
			<select id="quizSelect">
				<option id="-1" value="Overall">Overall</option>
				<?php 
					$result = $db->ud_whereQuery('ud_quiz',array('quizID','quizName','quiztimestampF'),array('userID'=>$_SESSION['userID'],'subjectID'=>$_GET['subjectID']),'AND');
					while($data = $db->ud_mysql_fetch_assoc($result))
					{
						if(strtotime($data['quiztimestampF'])<time())
						echo "<option id='$data[quizID]' value='$data[quizName]'>$data[quizName]</option>";				
					}
				?>
				 
			</select>
		</div>
		<div class="six columns"></div>
	</div>
	
	<div class="row">
		<div class="twelve columns">
			<dl class="tabs pill filter right">
			  <dd class="active"><a href="#pill1">Bar</a></dd>
			  		  
			</dl>
		</div>
	</div>
	
	<div class="row">
		<div class="twelve columns">
			<ul class="tabs-content">
			  <li class="active" id="pill1Tab">
			  	<div class="row">
			  		<h3 id="QuizNo">Overall</h3>
			  		<div id="bar" style="min-height: 500px;" class="twelve columns">
						
					</div>
				</div>
			  </li>
			  <li id="pill2Tab">
			  	<div class="row">
			  		<h3 id="QuizNo">Overall</h3>
					<div id="pie" style="min-height: 500px;" class="twelve columns">
						
					</div>
				</div>
			  </li>
			  </ul>
		</div>
	</div>			  
</div>

<script src="../../adminpanel/resources/js/Flotr2/flotr2.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/flashcanvas.js"></script>
<![endif]-->

<script type="text/javascript" src="../../resources/js/modules/teacher/reportsGrade.js"></script> 
<?php require '../../include/footer/footerT.php'; ?>
</body>
</html>