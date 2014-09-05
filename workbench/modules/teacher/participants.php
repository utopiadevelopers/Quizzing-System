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
<?php require '../../include/header/datatable.php'; ?>
<?php require '../../include/header/upload.php'; ?>


</head>

<body>
<?php require '../../include/header/headerT.php'; ?>

<div class="content-participants">
	<div class="row">
		<div class="twelve columns">
			<dl class="tabs pill filter right">
			  <dd class="active"><a href="#pill1">Active</a></dd>
			  <dd><a href="#pill2">Debarred</a></dd>
			  <dd><a href="#pill3">Add/Remove</a></dd>
			</dl>			
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<ul class="tabs-content">
			  <li class="active" id="pill1Tab">
			  	<div class="row">
					<div class="twelve columns">
						<table class="active-student">
								<thead>
									<tr>
										<th>Registration Number</th>
										<th>Name</th>
										<th>User Name</th>
										<th>Email</th>										
									</tr>
								</thead>
								<tbody>
								<?php
								$subjectID=$_GET['subjectID'];
								$resultStudent= $db->ud_getQuery("SELECT * FROM  ud_users,ud_users_subjects where subjectID=$subjectID AND userID=userSID and debarred = 0" );
								while($students=$db->ud_mysql_fetch_assoc($resultStudent))
								{
									
								?>
									<tr>
										<td ><div class="studentReg"><?php echo $students['userCode']; ?></div></td>
										<td ><div class="studentName"><?php echo $students['userName']; ?></div></td>
										<td ><div class="studentName"><?php echo $students['userLogin']; ?></div></td>
										<td><div class="studentEmail"><?php echo $students['userEmail']; ?></div></td>
										
									</tr>
								<?php
								}
								?>
								</tbody>
						</table>
					</div>
				</div>
			  </li>
			  <li id="pill2Tab">
			  	<div class="row">
					<div class="twelve columns">
						<table class="debarred-student">
								<thead>
									<tr>
										<th>Registration Number</th>
										<th>Name</th>
										<th>User Name</th>
										<th>Email</th>										
									</tr>
								</thead>
								<tbody>
								<?php
								$subjectID=$_GET['subjectID'];
								$resultStudent= $db->ud_getQuery("SELECT * FROM  ud_users,ud_users_subjects where subjectID=$subjectID AND userID=userSID and debarred = 1" );
								while($students=$db->ud_mysql_fetch_assoc($resultStudent))
								{
									
								?>
									<tr>
										<td ><div class="studentReg"><?php echo $students['userCode']; ?></div></td>
										<td ><div class="studentName"><?php echo $students['userName']; ?></div></td>
										<td ><div class="studentName"><?php echo $students['userLogin']; ?></div></td>
										<td><div class="studentEmail"><?php echo $students['userEmail']; ?></div></td>
										
									</tr>
								<?php
								}
								?>
								</tbody>
						</table>
					</div>
				</div>
			  </li>
			  <li id="pill3Tab">
			  	
					<div class="row">
				  		<h4 style="margin-bottom:25px;" >Add/Remove Student</h4>	
				  		<div class="three columns">
							<div class="radius button" style="height:32px;" id="add-student" >Add</div>
						</div>
						<div class="three columns">	
							<div class="radius button" style="height:32px;" id="export-student" >Export</div>		
				  		</div>	
				  		<div class="six columns">			
				  		</div>					
					</div>
					<div class="row">
					<div class="twelve columns">
						<table class="all-student">
						<thead>
							<tr>
								<th>Registration Number</th>
								<th>Name</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$subjectID=$_GET['subjectID'];
						$resultStudent= $db->ud_getQuery("SELECT * FROM  ud_users,ud_users_subjects where subjectID=$subjectID AND userID=userSID" );
						while($students=$db->ud_mysql_fetch_assoc($resultStudent))
						{
							
						?>
							<tr>
								<td ><div class="studentReg"><?php echo $students['userCode']; ?></div></td>
								<td ><div class="studentName"><?php echo $students['userName']; ?></div></td>
								<td ><div class="studentName"><?php echo $students['userLogin']; ?></div></td>
								<td><div class="studentEmail"><?php echo $students['userEmail']; ?></div></td>
								<td>
																		
									<div class="student-id" id="<?php echo $students['userID']; ?>" >
										<input type="button" class="edit-button">
										<input type="button" class="delete-button">									</div>
									</div>
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
				</table>
					
				</div>
			  </li>
			</ul>
		</div>
	</div>
	
	<div id="modalAdd" class="reveal-modal [expand, xlarge, large, medium, small]">	
		<div class="row">
			<div class="nine columns">
				<span>You can upload any excel or csv file.Enteries not meeting the requirements will be ignored.</span>
			</div>	
			<div class="three columns">
				<ul class="unstyled" id="uploadStudent"></ul>
			</div>		
		</div>
		<div class="row">
			<div class="nine columns">
				<h5>Template Categories</h5>
				<table>
					<thead>
						<tr>
							<th>Unique Registration Number</th>
							<th>Unique Username</th>
							<th>User Password</th>
							<th>User Email</th>
						</tr>
					</thead>
				</table>
			</div>					
		</div>
		<div class="row">
			<div class="five columns">
				<hr>
			</div>	
			<div class="two columns or">
				<span>OR</span>
			</div>	
			<div class="five columns">
				<hr>
			</div>		
		</div>
		<div class="row">
			<div class="twelve columns">
				<h5>Add Student Manually</h5>
				<div class="row">
					<div class="three columns">
						<label class="right inline">Registration Number</label>
					</div>	
					<div class="nine columns">
						<input type="text" placeholder="Enter Unique Reg. No.">
					</div>		
				</div>
				<div class="row">
					<div class="three columns">
						<label class="right inline">User Name</label>
					</div>	
					<div class="nine columns">
						<input type="text" placeholder="Enter Unique Username">
					</div>		
				</div>
				<div class="row">
					<div class="three columns">
						<label class="right inline">Email Address</label>
					</div>	
					<div class="nine columns">
						<input type="email" placeholder="Enter Email Id.">
					</div>		
				</div>
				<div class="row">
					<div class="three columns">
						<label class="right inline">Password</label>
					</div>	
					<div class="nine columns">
						<input type="text" placeholder="Enter a password">
					</div>		
				</div>
				<input type="button" class="button" value="Add" id="add-manual" />
			</div>		
		</div>
	</div>
	
	<div id="modalExport" class="reveal-modal [expand, xlarge, large, medium, small]">
		<div class="row">
			<div class="six columns centered">
				<form action="../../adminpanel/include/common/createFile.php" method="post" id="exportForm">
					<input type="button" class="button exportModal" id="excelNew" value="Export As Excel 2007"/>
					<input type="button" class="button exportModal" id="excel" value="Export As Excel"/>
					<input type="button" class="button exportModal" id="csv" value="Export As CSV"/>
					<input type="button" class="button exportModal" id="pdf" value="Export As PDF"/>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../../resources/js/modules/teacher/participants.js"></script> 
<?php require '../../include/footer/footerT.php'; ?>
</body>
</html>