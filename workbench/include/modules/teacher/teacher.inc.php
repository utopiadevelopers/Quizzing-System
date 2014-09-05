<?php

	function updateAcc($courseID)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		$time = time();
		$date = date('Y-m-d H:i:s',$time);

		$db->ud_updateQuery('`ud_subjects_users`',array('subjectAcc'=>$date),array('userID'=>$_SESSION['userID'],'subjectID'=>$courseID));
	}
	
	function updateMod($courseID)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		$time = time();
		$date = date('Y-m-d H:i:s',$time);

		$db->ud_updateQuery('`ud_subjects_users`',array('subjectMod'=>$date),array('userID'=>$_SESSION['userID'],'subjectID'=>$courseID));
	}

?>