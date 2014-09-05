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
	else if(!empty($_POST['func']) &&!empty($_POST['type']) &&!empty($_POST['subjectID']) &&!empty($_POST['value']) && $_POST['func']=='quiz' && $_POST['type']=='bar')
	{
		quiz('bar');
	}
	else {
		echo "Invalid";
	}
}
else {
		echo "Invalid Isset";
}

function quiz($type)
{
	if($type=='bar')
	{
		$subjectID = $_POST['subjectID'];
		$value = $_POST['value'];
		$db = new dbHelper;
		$db->ud_connectToDB();	
		$result = $db->ud_getQuery("select * from ud_users_attempt as a,ud_quiz as b where timestamp in (select max(timestamp) from ud_users_attempt group by userID) and a.quizID = b.quizID and subjectID = $subjectID and quizName = '$value' order by a.userId ");
		$scores = $db->ud_mysql_fetch_assoc_all($result);
		$singleScore = array();
		$maxScore = 0;
		$studentId  =$scores[0]['userID'];
		$score = $scores[0]['attemptScore']+1-1;
		$count = 0;
		$returnArray =array();;
		for($i = 1;$i < sizeof($scores);$i++)
		{
			if($scores[$i]['userID'] == $studentId)
			{
				$score += $scores[$i]['attemptScore'];
			}else
			{
				$singleScore[0]=$score;
				$singleScore[1]=$count;
				$returnArray[$count]=$singleScore;
				$count++;
				$studentId  =$scores[$i]['userID'];
				$score = $scores[$i]['attemptScore'];
			}
		}
		//fOR lAST
		$singleScore[0]=$score;
		$singleScore[1]=$count;
		$returnArray[$count]=$singleScore;
		
		echo json_encode($returnArray);
	}
}

function overall($type)
{
	if($type=='bar')
	{
		$subjectID = $_POST['subjectID'];
		$db = new dbHelper;
		$db->ud_connectToDB();	
		$result = $db->ud_getQuery("select * from ud_users_attempt as a,ud_quiz as b where timestamp in (select max(timestamp) from ud_users_attempt group by userID) and a.quizID = b.quizID and subjectID = $subjectID order by a.userId");
		$scores = $db->ud_mysql_fetch_assoc_all($result);
		$singleScore = array();
		$maxScore = 0;
		$studentId  =$scores[0]['userID'];
		$score = $scores[0]['attemptScore']+1-1;
		$count = 0;
		$returnArray =array();;
		for($i = 1;$i < sizeof($scores);$i++)
		{
			if($scores[$i]['userID'] == $studentId)
			{
				$score += $scores[$i]['attemptScore'];
			}else
			{
				$singleScore[0]=$score;
				$singleScore[1]=$count;
				$returnArray[$count]=$singleScore;
				$count++;
				$studentId  =$scores[$i]['userID'];
				$score = $scores[$i]['attemptScore'];
			}
		}
		//fOR lAST
		$singleScore[0]=$score;
		$singleScore[1]=$count;
		$returnArray[$count]=$singleScore;
		
		echo json_encode($returnArray);
	}
}

?>