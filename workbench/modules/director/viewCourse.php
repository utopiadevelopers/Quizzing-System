<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinD.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';

	
	$db = new dbHelper;
	$db->ud_connectToDB();	

	$result = $db->ud_getQuery('SELECT * FROM ud_subject s LEFT JOIN ( SELECT count(subjectID) as tcount,subjectID FROM `ud_subjects_users` GROUP BY subjectID ) u ON s.subjectID = u.subjectID');
	$subject = $db->ud_mysql_fetch_assoc_all($result);
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


</head>

<body>
<?php require '../../include/header/headerD.php'; ?>
<div class="row content">
	<div class="row" style="margin-top:20px;">
		<div class="twelve columns">
			<table class="subject-table">
				<thead>
					<tr>
						<th style="width:20px;">#</th>
						<th>Subject Name</th>
						<th style="width:150px;">No of Teachers</th>
						<th style="width:150px;"><center>Action</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
				for($i=0;$i<sizeof($subject);$i++)
				{
					if(empty($subject[$i]['tcount']))
					{
						$subject[$i]['tcount'] = '-';
					}
				?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><?php echo $subject[$i]['subjectName'];?></td>
						<td style="text-align: center;"><?php echo $subject[$i]['tcount'];?></td>
						<td></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>

		</div>
	</div>
</div> 
<?php require '../../include/footer/footerD.php'; ?>
<script language="javascript" src="../../resources/js/modules/director/view-subject.js" type="text/javascript"></script>
</body>

</html>
