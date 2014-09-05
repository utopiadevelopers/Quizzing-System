<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/teacher/teacher.inc.php';

	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_getQuery('SELECT * FROM `ud_question` WHERE userID = '.$_SESSION['userID'].' AND questionName LIKE \'%'.$_GET['term'].'%\' OR questionText LIKE \'%'.$_GET['term'].'%\'');
	$result = $db->ud_mysql_fetch_assoc_all($result);
	
	$data = array();
	$count = 0;
	
	$json = '[';
	
	for($i=0;$i<sizeof($result);$i++)
	{
		$json .= '{"id":"'.$result[$i]['questionID'].'","label":"Isabelline Wheatear","value":"Isabelline Wheatear"}';
		if($i!=(sizeof($result)-1))
		{
			$json .= ',';
		}	
	}		
	
	$json .= ']';
	
	echo $json;
?>