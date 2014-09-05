<?php

require '../../include/common/core.inc.php';
require '../../adminpanel/include/common/dbhelper.inc.php';
require '../../adminpanel/include/common/help.inc.php';
//die('fv');
$db = new dbHelper;
	$db->ud_connectToDB();	

		


if(isset($_POST['func'],$_POST['type'],$_POST['subjectID']))
{
	if(!empty($_POST['func']) &&!empty($_POST['type']) &&!empty($_POST['subjectID']) && $_POST['func']=='overall' && $_POST['type']=='bar')
	{
		overall('bar');		
	}	
	else {
		echo "Invalid";
	}
}
else {
		echo "Invalid Isset";
}
function overall($type)
{
	if($type=='bar')
	{
		$subjectID = $_POST['subjectID'];
		$studentID = $_SESSION['studentID'];
		$db = new dbHelper;
		$db->ud_connectToDB();	
		$result = $db->ud_getQuery("SELECT *
FROM ud_users_attempt AS a, ud_quiz AS b
WHERE timestamp
IN (

SELECT max( timestamp )
FROM ud_users_attempt
GROUP BY userID
)
AND a.quizID = b.quizID
AND subjectID =$subjectID
AND a.userID =$studentID
ORDER BY a.quizID");
		$scores = $db->ud_mysql_fetch_assoc_all($result);
		$singleScore = array();
		$maxScore = 0;
		
		
		$count = 0;
		$returnArray =array();
		//print_r($scores);
		for($i = 0;$i < sizeof($scores);$i++)
		{
				$score = $scores[$i]['attemptScore']+1-1;
				$singleScore[0]=$score;
				$singleScore[1]=$count;
				$returnArray[$count]=$singleScore;
				$count++;		
		}
		
		
		echo json_encode($returnArray);
	}
}