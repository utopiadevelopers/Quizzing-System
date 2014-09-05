<?php

	function updateAcc($courseID)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		$time = time();
		$date = date('Y-m-d H:i:s',$time);

		$db->ud_updateQuery('`ud_users_subjects`',array('subjectAcc'=>$date),array('userSID'=>$_SESSION['userID'],'subjectID'=>$courseID));
	}
	
	function updateMod($courseID)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		$time = time();
		$date = date('Y-m-d H:i:s',$time);

		$db->ud_updateQuery('`ud_users_subjects`',array('subjectMod'=>$date),array('userSID'=>$_SESSION['userID'],'subjectID'=>$courseID));
	}

?>