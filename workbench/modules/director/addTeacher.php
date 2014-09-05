<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinD.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	

	if(isset($_POST['userCode'],$_POST['userName'],$_POST['userEmail'],$_POST['userLogin'],
			$_POST['userPassword']))
	{
		if(!empty($_POST['userCode']) &&!empty($_POST['userName']) &&!empty($_POST['userEmail']) &&!empty($_POST['userLogin']) &&
				!empty($_POST['userPassword']))
		{
	
			$userCode = htmlentities($_POST['userCode']);
			$userName = htmlentities($_POST['userName']);
			$userEmail = htmlentities($_POST['userEmail']);
			$userLogin = htmlentities($_POST['userLogin']);
			$userPassword = htmlentities($_POST['userPassword']);
	
			$db->ud_insertQuery('ud_users',array('userCode'=>$userCode,'userName'=>$userName,'userEmail'=>$userEmail,'userLogin'=>$userLogin,'userRole'=>3,'userPassword'=>md5($userPassword)));
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


</head>

<body>
<?php require '../../include/header/headerD.php'; ?>
<div class="row">
	<form action="addTeacher.php" method="post">
		<div class="twelve columns">
			<h4>Add Teacher</h4>
			<div class="row">
				<div class="three columns">
					<label class="right inline">Registration Number</label>
					<label class="right inline">Name</label>
					<label class="right inline">Email Address</label>
					<label class="right inline">Login</label>
					<label class="right inline">Password</label>
				</div>	
				<div class="four columns">
					<input type="text" placeholder="eg 10BCE0046" name="userCode">
					<input type="text" placeholder="Name" name="userName">
					<input type="text" placeholder="Email ID" name="userEmail">
					<input type="text" placeholder="Login" name="userLogin">
					<input type="text" placeholder="Password" name="userPassword">
				</div>		
				<div class="seven columns"></div>
			</div>
			<input type="submit" class="secondary button two" value="Add"/>
		</div>		
	</form>
</div> 
<?php require '../../include/footer/footerD.php'; ?>
<script language="javascript" src="../../resources/js/modules/director/view-subject.js" type="text/javascript"></script>
</body>

</html>
