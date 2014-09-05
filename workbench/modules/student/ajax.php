<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinS.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/student/student.inc.php';

	$db = new dbHelper();
	$db->ud_connectToDB();

	
	if(isset($_POST['func']) && !empty($_POST['func']))
	{
		if($_POST['func'] == 'unenrollcourse')
		{
			$result = $db->ud_whereQuery('ud_users_subjects',NULL,array('userSID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0)
			{
				$result = $db->ud_deleteQuery('ud_users_subjects',array('userSID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
				echo 'true';
			}
		}
	}

?>