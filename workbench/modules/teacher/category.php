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
		
		//	Category
		$result = $db->ud_getQuery('SELECT * FROM `ud_subject_category` c LEFT JOIN (SELECT questionCatID,count(questionID) FROM `ud_question` GROUP BY questionCatID) x ON c.categoryID = x.questionCatID WHERE c.userID = \''.$_SESSION['userID'].'\' AND c.subjectID = \''.$course['subjectID'].'\'');
		$category = $db->ud_mysql_fetch_assoc_all($result);
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
<!-- Category CSS -->
</head>

<body>
<?php require '../../include/header/headerT.php'; ?>
<div class="content-teacher">
	<div class="row" >
		<h4 style="margin-bottom:25px;" >Add/Modify Category</h4>	
		<div class="nine columns">
			<input type="text" name="category" placeholder="Category Title"/>
		</div>
		<div class="three columns">
			<div class="radius button" style="height:32px;" id="add-category" rowcount="<?php echo sizeof($category); ?>">Add</div>
		</div>
	</div>
			
	<div class="row" style="margin-top:20px;">
		<div class="twelve columns">
			<table class="question-bank">
				<thead>
					<tr>
						<th style="width:20px;">#</th>
						<th>Category</th>
						<th style="width:50px;">Count</th>
						<th style="width:150px;"><center>Action</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
				for($i=0;$i<sizeof($category);$i++)
				{
					if(empty($category[$i]['count(questionID)']))
					{
						$category[$i]['count(questionID)'] = '-';
					}
				?>
					<tr>
						<td ><div class="categoryNo"><?php echo ($i+1); ?></div></td>
						<td ><div class="categoryTitle"><?php echo $category[$i]['category'] ?></div></td>
						<td><center><?php echo $category[$i]['count(questionID)']; ?></center></td>
						<td style="height:37px;"><center>
							<?php 
								if($category[$i]['categoryDefault'] == 1)
								{
									echo '-';
								}
								else
								{
									
							?>
							<div class="category-id" id="<?php echo $category[$i]['categoryID'] ?>" row="<?php echo ($i+1); ?>">
								<input type="button" class="edit-button">
								<input type="button" class="delete-button">
							</div>
							<?php
								}
							?>
							</center>
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
<!-- Category JS -->
<script language="javascript" src="../../resources/js/modules/tablesDataGrid.js" type="text/javascript"></script>
<script language="javascript" src="../../resources/js/modules/teacher/category.js" type="text/javascript"></script>

</body>

</html>
