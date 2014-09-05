<?php

require '../../include/common/core.inc.php';
require '../../adminpanel/include/common/dbhelper.inc.php';
require '../../adminpanel/include/common/help.inc.php';

//getSession(false);

if (isset($_POST['type'], $_POST['questionName'], $_POST['questionText'], $_POST['categoryId'], $_POST['shuffle'], $_POST['defaultMarks'], $_POST['choice'], $_POST['grade'], $_POST['feedback'], $_POST['correctAns'], $_POST['combinedPos'], $_POST['combinedNeg'], $_POST['penalty']) && !empty($_POST['type']) && !empty($_POST['questionText']) && !empty($_POST['defaultMarks']) && !empty($_POST['choice'][0]) && !empty($_POST['correctAns']) && !empty($_POST['categoryId']) && $_POST['type'] == '1') {
	singleChoice();
}
else if (isset($_POST['type'], $_POST['questionName'], $_POST['questionText'], $_POST['categoryId'], 
	$_POST['shuffle'], $_POST['defaultMarks'], $_POST['choice'], $_POST['feedback'], 
	$_POST['correctAns'], $_POST['combinedPos'], $_POST['combinedNeg'], $_POST['combinedPar'], 
	$_POST['penalty']) && !empty($_POST['type']) && !empty($_POST['questionText']) && 
	!empty($_POST['defaultMarks']) && !empty($_POST['choice'][0]) && !empty($_POST['correctAns'][0]) && 
	!empty($_POST['categoryId']) && $_POST['type'] == '2') 
{
	multipleChoice();
}
else if (isset($_POST['type'], $_POST['questionName'], $_POST['questionText'], $_POST['categoryId'], 
	 $_POST['defaultMarks'], $_POST['feedback'], $_POST['correctAns'], $_POST['combinedPos'], $_POST['combinedNeg'], $_POST['combinedPar'], 
	$_POST['penalty']) && !empty($_POST['type']) && !empty($_POST['questionText']) && 
	!empty($_POST['defaultMarks']) && !empty($_POST['correctAns']) && 
	!empty($_POST['categoryId']) && $_POST['type'] == '3') 
{
	subjective();
}
else if (isset($_POST['type'], $_POST['questionName'], $_POST['questionText'], $_POST['categoryId'], 
	 $_POST['defaultMarks'], $_POST['feedback'], $_POST['correctAns'],$_POST['penalty']) && !empty($_POST['type']) 
	 && !empty($_POST['questionText']) && !empty($_POST['defaultMarks']) && !empty($_POST['correctAns']) && 
	!empty($_POST['categoryId']) && $_POST['type'] == '4') 
{
	trueFalse();
}
else if (isset($_POST['type'], $_POST['questionName'], $_POST['question'],$_POST['answer'], $_POST['categoryId'], 
	 $_POST['defaultMarks'],$_POST['penalty']) && !empty($_POST['type']) 
	 && !empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['defaultMarks']) 
	 && !empty($_POST['categoryId']) && $_POST['type'] == '5') 
{
	matching();
}
else if (isset($_POST['type'], $_POST['questionName'], $_POST['questionText'], $_POST['categoryId'], 
	 $_POST['defaultMarks'], $_POST['feedback'], $_POST['correctAns'], $_POST['combinedPos'], $_POST['combinedNeg'], $_POST['combinedPar'], 
	$_POST['penalty'], $_POST['tolerance']) && !empty($_POST['type']) && !empty($_POST['questionText']) && 
	!empty($_POST['defaultMarks']) && !empty($_POST['correctAns']) && 
	!empty($_POST['categoryId']) && $_POST['type'] == '6') 
{
	numerical();
}
else {
	echo "Invalid";
	//echo $_POST['choice'][0];
}

/*
 *
 * && !empty($_POST['type']) &&
 !empty($_POST['questionText']) && !empty($_POST['shuffle']) && !empty($_POST['defaultMarks']) &&
 !empty($_POST['choice'][0]) && !empty($_POST['correctAns']) &&
 */

function singleChoice() {
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$questionText = $_POST['questionText'];
	$shuffle = htmlentities($_POST['shuffle']);
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$choice = $_POST['choice'];
	$grade = $_POST['grade'];
	$feedback = $_POST['feedback'];
	$correctAns = htmlentities($_POST['correctAns']);
	$combinedPos = htmlentities($_POST['combinedPos']);
	$combinedNeg = htmlentities($_POST['combinedNeg']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionText" => $questionText, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionShuffle" => $shuffle, "questionPosFeedback" => $combinedPos, "questionNegFeedback" => $combinedNeg,"timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
	$feed=null;
	//echo $choice[0];
	for($i=0;$i<sizeof($choice);$i++)
	{
		if($feedback[$i]==null)
			$feed=null;
		else {
			$feed=$feedback[$i];
		}
		if(($i+1)==$correctAns)
		{
			$db-> ud_insertQuery('ud_question_choice_single', array('questionID'=>$questionID,"choiceText"=>$choice[$i],"choiceCorrect"=>'1',"choiceGrade"=>$grade[$i],"choiceFeedback"=>$feedback[$i]));
		}			
		else {
			$db-> ud_insertQuery('ud_question_choice_single', array('questionID'=>$questionID,"choiceText"=>$choice[$i],"choiceCorrect"=>'0',"choiceGrade"=>$grade[$i],"choiceFeedback"=>$feedback[$i]));
		}
	}
	
	//HINT :(
}

function multipleChoice() {
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$questionText = $_POST['questionText'];
	$shuffle = htmlentities($_POST['shuffle']);
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$choice = $_POST['choice'];
	$grade = $_POST['grade'];
	$feedback = $_POST['feedback'];
	$correctAns = htmlentities($_POST['correctAns']);
	$combinedPos = htmlentities($_POST['combinedPos']);
	$combinedPar = htmlentities($_POST['combinedPar']);
	$combinedNeg = htmlentities($_POST['combinedNeg']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionText" => $questionText, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionShuffle" => $shuffle, "questionPosFeedback" => $combinedPos, "questionNegFeedback" => $combinedNeg, "questionParFeedback" => $combinedPar,"timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
	$feed=null;
	//echo $choice[0];
	for($i=0;$i<sizeof($choice);$i++)
	{
		if($feedback[$i]==null)
			$feed=null;
		else {
			$feed=$feedback[$i];
		}
		if(in_array(($i+1), $correctAns))
		{
			$db-> ud_insertQuery('ud_question_choice_multiple', array('questionID'=>$questionID,"choiceText"=>$choice[$i],"choiceCorrect"=>'1',"choiceGrade"=>$grade[$i],"choiceFeedback"=>$feedback[$i]));
		}			
		else {
			$db-> ud_insertQuery('ud_question_choice_multiple', array('questionID'=>$questionID,"choiceText"=>$choice[$i],"choiceCorrect"=>'0',"choiceGrade"=>$grade[$i],"choiceFeedback"=>$feedback[$i]));
		}
	}
	
	//HINT :(
}

function subjective() {
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$questionText = $_POST['questionText'];
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$feedback = $_POST['feedback'];
	$correctAns = htmlentities($_POST['correctAns']);
	$combinedPos = htmlentities($_POST['combinedPos']);
	$combinedPar = htmlentities($_POST['combinedPar']);
	$combinedNeg = htmlentities($_POST['combinedNeg']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionText" => $questionText, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionShuffle" => $shuffle, "questionPosFeedback" => $combinedPos, "questionNegFeedback" => $combinedNeg, "questionParFeedback" => $combinedPar,"timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
	$feed=null;
	$db-> ud_insertQuery('ud_question_choice_sub', array('questionID'=>$questionID,"choiceText"=>$correctAns,"choiceFeedback"=>$feedback));
		
	//HINT :(
}

function trueFalse()
{
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$questionText = $_POST['questionText'];
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$feedback = $_POST['feedback'];
	$correctAns = htmlentities($_POST['correctAns']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionText" => $questionText, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionShuffle" => $shuffle, "timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
		
	if($correctAns=='True')
		$correctAns='1';
	else
		$correctAns='0';
	
	$db-> ud_insertQuery('ud_question_choice_true_false', array('questionID'=>$questionID,"choiceTF"=>$correctAns,"choiceFeedback"=>$feedback));
	
}

function matching() {
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$choice = $_POST['misguidechoice'];
	$feedback = $_POST['misguidefeedback'];
	$combinedPos = htmlentities($_POST['combinedPos']);
	$combinedPar = htmlentities($_POST['combinedPar']);
	$combinedNeg = htmlentities($_POST['combinedNeg']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionPosFeedback" => $combinedPos, "questionNegFeedback" => $combinedNeg, "questionParFeedback" => $combinedPar,"timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
	$feed=null;
	//echo $choice[0];
	//Q nd A
	for($i=0;$i<sizeof($question);$i++)
	{
		//Can do extra checks.Lazing out for now
		$db-> ud_insertQuery('ud_question_choice_match', array('questionID'=>$questionID,"matchQuestion"=>$question[$i],"matchAnswer"=>$answer[$i]));
	}
	
	for($i=0;$i<sizeof($choice);$i++)
	{
		$db-> ud_insertQuery('ud_question_choice_match_misguide', array('questionID'=>$questionID,"choiceText"=>$choice[$i],"choiceFeedback"=>$feedback[$i]));
	}
	
	//HINT :(
}

function numerical() {
	$type = htmlentities($_POST['type']);
	$questionName = htmlentities($_POST['questionName']);
	$questionText = $_POST['questionText'];
	$defaultMarks = htmlentities($_POST['defaultMarks']);
	$feedback = $_POST['feedback'];
	$correctAns = htmlentities($_POST['correctAns']);
	$combinedPos = htmlentities($_POST['combinedPos']);
	$combinedPar = htmlentities($_POST['combinedPar']);
	$combinedNeg = htmlentities($_POST['combinedNeg']);
	$penalty = htmlentities($_POST['penalty']);
	$userid = $_SESSION['teacherID'];
	$categoryId = $_POST['categoryId'];
	$tolerance = $_POST['tolerance'];
	$timestamp=date('Y-m-d H:i:s',time());
	$db = new dbHelper;
	$db -> ud_connectToDB();

	$db -> ud_insertQuery('ud_question', array("userID" => $userid, "userModID" => $userid, "questionCatID" => $categoryId, "questionName" => $questionName, "questionText" => $questionText, "questionMark" => $defaultMarks, "questionPenaltyMark" => $penalty, "questionTypeID" => $type, "questionShuffle" => $shuffle, "questionPosFeedback" => $combinedPos, "questionNegFeedback" => $combinedNeg, "questionParFeedback" => $combinedPar,"timestamp"=>$timestamp));
	$result= $db->ud_whereQuery('ud_question',array('questionID'),array('timestamp'=>$timestamp));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	$questionID=$result['questionID'];
	$feed=null;
	$db-> ud_insertQuery('ud_question_choice_numerical', array('questionID'=>$questionID,"choiceValue"=>$correctAns,"choiceFeedback"=>$feedback,"choiceTolerance"=>$tolerance));
		
	//HINT :(
}

?>