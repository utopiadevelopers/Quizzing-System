<?php

	require '../../include/common/core.inc.php';
	require '../../include/common/loggedin.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	
	$file_path = '../../';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	
	
	if(isset($_POST['username'],$_POST['password']))
	{
		if(!empty($_POST['username']) &&!empty($_POST['password']))
		{
		
			$username = htmlentities($_POST['username']);
			$password = md5(htmlentities($_POST['password']));
			
			$result=$db->ud_getQuery('SELECT * FROM ud_users u JOIN ud_users_role r ON u.userRole = r.userRoleID WHERE u.userLogin = \''.$username.'\' AND u.userPassword = \''.$password.'\';');
			if( $db->ud_getRowCountResult($result)==0)
			{
				$login = false;
			}
			else
			{
				$result = $db->ud_mysql_fetch_assoc($result);
				$_SESSION['userName']=$result['userName'];	
				$_SESSION['userLogin']=$result['userLogin'];	
				$_SESSION['userRole']=$result['userRoleID'];	
				$_SESSION['userID']=$result['userID'];		
				if($_SESSION['userRole'] == '1')
				{
					$_SESSION['adminID']=$result['userID'];					
					header('Location:../../adminpanel/index.php');
				}					
				else if($_SESSION['userRole'] == '2')
				{
					$_SESSION['directorID']=$result['userID'];			
					header('Location:../director/index.php');				
				}					
				else if($_SESSION['userRole'] == '3')
				{
					$_SESSION['teacherID']=$result['userID'];			
					header('Location:../teacher/index.php');
				}					
				else if($_SESSION['userRole'] == '4')
				{
					$_SESSION['studentID']=$result['userID'];			
					header('Location:../student/index.php');
				}
				else if($_SESSION['userRole'] == '5')
				{
					$_SESSION['parentID']=$result['userID'];			
					header('Location:../parent/index.php');
				}					
			}
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
<title>Home | Administrator - Quiz</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />

<?php require '../../include/header/foundation.php'; ?>
<!-- CSS Styles -->
<link rel="stylesheet" href="../../resources/css/modules/homepage/login.css"/>

</head>

<body>
<?php require '../../include/header/header.php'; ?>
<form style="margin-top:75px; margin-bottom:75px;" action="login.php" method="post">
	<div class="row">
		<div class="two columns"></div>
		<div class="eight columns login-box">
			<h3>Log In</h3>
			<hr/>
			<?php 
			
			
			?>
			<div class="row">
				
			</div>
			
			<div class="row">
				<div class="three columns">
					<label class="right inline">Username</label>
					<label class="right inline">Password</label>
				</div>
				<div class="eight columns">
					<input type="text" name="username" placeholder="utopiadeveloper"/>
					<input type="password" name="password" placeholder=""/>
				</div>
				<div class="one columns"></div>
			</div>
			<div class="row">
				<div class="three columns"></div>
				<div class="three columns">
					<button class="button login-button">Log in</button>
				</div>
				<div class="six columns" style="margin-top:10px;">
					<a href="#" class="left inline">Forget Your Password?</a>
				</div>
			</div>
			
		</div>
		<div class="two columns"></div>
	</div>
</form>

<?php require '../../include/footer/footer.php'; ?>
</body>

</html>
