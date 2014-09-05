<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../adminpanel/include/common/help.inc.php';
	require '../../include/modules/teacher/teacher.inc.php';
	require 'question-function.php';
	$db = new dbHelper();
	$db->ud_connectToDB();

	
	if(isset($_POST['func'],$_POST['roll'],$_POST['email'],$_POST['password']))
	{
		if(!empty($_POST['func']) &&!empty($_POST['roll']) &&!empty($_POST['email']) &&!empty($_POST['password']) && $_POST['func'] == 'addPart')
		{
		
			$func = htmlentities($_POST['func']);
			$roll = htmlentities($_POST['roll']);
			$username = htmlentities($_POST['username']);
			$email = htmlentities($_POST['email']);
			$password = htmlentities($_POST['password']);
			
			if($db->ud_insertQuery('ud_users', array('userCode'=>$roll,'userLogin'=>$username,'userPassword'=>md5($password),'userEmail'=>$email,'userRole'=>4)))
			{
				echo "OK";
			}
			else {
				echo "Error";
			}
			
		}
		else {
			echo "Error";
		}
	}
	else 
	{
			echo "Error";
	}
	
?>
