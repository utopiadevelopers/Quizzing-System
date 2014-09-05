<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinP.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';

	$banner = true;
	$db = new dbHelper;
	$db->ud_connectToDB();	

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
<script src="../../adminpanel/resources/js/Flotr2/flotr2.min.js"></script>
</head>

<body>
<?php require '../../include/header/headerP.php'; ?>
<?php
$subjectID = $_GET['subjectID'];
$studentID =  $_SESSION['sonID'];
$result = $db->ud_getQuery("SELECT *
FROM ud_users_attempt AS a, ud_quiz AS b
WHERE timestamp
IN (

SELECT max( timestamp )
FROM ud_users_attempt
GROUP BY userID
)
AND a.quizID = b.quizID
AND subjectID =$subjectID
AND a.userID =$studentID
ORDER BY a.quizID");
		$marks = $db->ud_mysql_fetch_assoc_all($result);
?>
<div class="row">
	<div class="twelve columns">
		<h3>Progress</h3>
		<div class="row"> 
			<div id="bar" style="min-height: 500px;" class="twelve columns">
						
			</div>
		</div>
		<table class="quizmarks">
				<thead>
					<tr>
						<td>#</td>
						<th>Quiz Name</th>
						<th>Quiz Marks</th>						
					</tr>
				</thead>
				<tbody>
				<?php
				for($i=0;$i<sizeof($marks);$i++)
				{
				?>
					<tr>
						<td><?php echo $i+1 ?></td>
						<th><?php echo $marks[$i]['quizName'] ?></th>
						<th><?php echo $marks[$i]['attemptScore'] ?></th>	
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript" src="../../resources/js/modules/parent/reportsGrade.js"></script> 
<?php require '../../include/footer/footerP.php'; ?>
</body>

</html>
