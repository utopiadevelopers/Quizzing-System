<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinT.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	require '../../include/modules/teacher/teacher.inc.php';
	require 'question-function.php';
	$db = new dbHelper();
	$db->ud_connectToDB();

	
	if(isset($_POST['func']) && !empty($_POST['func']))
	{
		if($_POST['func'] == 'addCat')
		{
			$result = $db->ud_whereQuery('ud_subjects_users',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0)
			{
				$timestamp = date('Y-m-d H:i:s',time());		
				$db->ud_insertQuery('ud_subject_category',array('userID'=>$_SESSION['userID'],'category'=>$_POST['category'] , 'subjectID'=>$_POST['subjectID'] ,'timestamp'=>$timestamp));
				$result = $db->ud_whereQuery('ud_subject_category',NULL,array('timestamp'=>$timestamp));
				$result = $db->ud_mysql_fetch_assoc($result);
				$data = array('categoryID'=>$result['categoryID']);
				updateMod($_POST['subjectID']);
				echo json_encode($data);
			}
			else
			{
				echo 'false';
			}
		}
		else if($_POST['func'] == 'delCat')
		{
			$result = $db->ud_whereQuery('ud_subject_category',NULL,array('userID'=>$_SESSION['userID'],'categoryID'=>$_POST['categoryID'],'categoryDefault'=>0));
			if($db->ud_getRowCountResult($result)>0)
			{
				$db->ud_deleteQuery('ud_subject_category',array('userID'=>$_SESSION['userID'],'categoryID'=>$_POST['categoryID']));
				updateMod($_POST['subjectID']);
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		else if($_POST['func'] == 'updCat')
		{
			$result = $db->ud_whereQuery('ud_subject_category',NULL,array('userID'=>$_SESSION['userID'],'categoryID'=>$_POST['categoryID'],'categoryDefault'=>0));
			if($db->ud_getRowCountResult($result)>0)
			{
				$db->ud_updateQuery('ud_subject_category',array('category'=>$_POST['category']),array('userID'=>$_SESSION['userID'],'categoryID'=>$_POST['categoryID']));
				updateMod($_POST['subjectID']);
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		else if($_POST['func'] == 'addQuiz')
		{
			$result = $db->ud_whereQuery('ud_subjects_users',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0)
			{
				$timestamp = date('Y-m-d H:i:s',time());		
				$db->ud_insertQuery('ud_quiz',array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID'],'quizName'=>$_POST['quizName'],'quiztimestampF'=>$_POST['quiztimestampF'],'quiztimestampS'=>$_POST['quiztimestampS'],'quizDuration'=>$_POST['quizDuration'],'timestampC'=>$timestamp,'timestampM'=>$timestamp));
				$result = $db->ud_whereQuery('ud_quiz',array('quizID'),array('timestampC'=>$timestamp));
				$result = $db->ud_mysql_fetch_assoc($result);
				$data = array('quizID'=>$result['quizID']);
				updateMod($_POST['subjectID']);
				echo json_encode($data);
			}
			else
			{
				echo 'false';
			}
		}
		else if($_POST['func'] == 'getQuestion')
		{
			$result = $db->ud_whereQuery('ud_subjects_users',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0 || true)
			{
				$result = $db->ud_getQuery('SELECT * FROM  `ud_question` WHERE questionCatID = '.$_POST['catID'] .' AND questionID NOT IN (SELECT questionID FROM `ud_quiz_question` WHERE quizID = '.$_POST['quizID'].')');
				$question = $db->ud_mysql_fetch_assoc_all($result);
				echo json_encode($question);
			}
			else
			{	
				echo 'false';
			}
		}
		else if($_POST['func'] == 'addAllQues')
		{
			$result = $db->ud_whereQuery('ud_subjects_users',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0 || true)
			{
				$result = $db->ud_getQuery('SELECT questionID,questionMark FROM  `ud_question` WHERE questionCatID = '.$_POST['catID'] .' AND questionID NOT IN (SELECT questionID FROM `ud_quiz_question` WHERE quizID = '.$_POST['quizID'].')');
				if($db->ud_getRowCountResult($result)>0)
				{
					$question = $db->ud_mysql_fetch_assoc_all($result);					
					$result = $db->ud_whereQuery('`ud_quiz_question`',array('max(questionNo)+1 as max'),array('quizID'=>$_POST['quizID']));
					$questionNo = $db->ud_mysql_fetch_assoc($result);
					if($questionNo['max'] == NULL)
					{	
						$questionNo = 1;
					}
					else
					{
						$questionNo = $questionNo['max'];
					}
					
					for($i=0;$i<sizeof($question);$i++)
					{
						$db->ud_insertQuery('`ud_quiz_question`',array('quizID'=>$_POST['quizID'],'questionID'=>$question[$i]['questionID'],'questionGrade'=>$question[$i]['questionMark'],'questionNo'=>$questionNo));
						$questionNo++;
					}
					updateMod($_POST['subjectID']);
				}
			}
			else
			{	
				echo 'false';
			}
		}
		else if($_POST['func'] == 'addQuizQuestion')
		{
			$result = $db->ud_whereQuery('ud_subjects_users',NULL,array('userID'=>$_SESSION['userID'],'subjectID'=>$_POST['subjectID']));
			if($db->ud_getRowCountResult($result)>0 || true)
			{
					$result = $db->ud_whereQuery('`ud_quiz_question`',array('max(questionNo)+1 as max'),array('quizID'=>$_POST['quizID']));
					$questionNo = $db->ud_mysql_fetch_assoc($result);
					if($questionNo['max'] == NULL)
					{	
						$questionNo = 1;
					}
					else
					{
						$questionNo = $questionNo['max'];
					}
					
					$db->ud_insertQuery('`ud_quiz_question`',array('quizID'=>$_POST['quizID'],'questionID'=>$_POST['questionID'],'questionGrade'=>$_POST['grade'],'questionNo'=>$questionNo));
					$questionNo++;
					echo 'true';
					updateMod($_POST['subjectID']);

			}
			else
			{	
				echo 'false';
			}
		}
		else if($_POST['func'] == 'getPrevQuestion')
		{
			$result = $db->ud_whereQuery('ud_question',NULL,array('userID'=>$_SESSION['userID'],'questionID'=>$_POST['questionID']));
			if($db->ud_getRowCountResult($result)>0)
			{
				echo preview($_POST['questionID']);
			}
		}
		else if($_POST['func'] == 'delQuest')
		{
			$result = $db->ud_updateQuery('ud_question',array('questionThrashed'=>1),array('userID'=>$_SESSION['userID'],'questionID'=>$_POST['id']));
			
			if($result>0)
			{
				echo 'Success';
			}
			else {
				echo "Failure";
			}
		}
		else if($_POST['func'] == 'fetchQuest')
		{
			$questionID = $_POST['qID'];
			$result = $db->ud_getQuery("SELECT questionID,questionType,questionText FROM `ud_question_type` a,ud_question b WHERE a.questionTypeID = b.questionTypeID and b.questionID = $questionID");
			$questionType = $db->ud_mysql_fetch_assoc_all($result);
			$questionText = $questionType[0]['questionText'];
			$option = array();
			$options = array();
			switch ($questionType[0]['questionType']) {
				case 'Single Choice':
					$questionType = $questionType[0]['questionType'];
					$result = $db->ud_getQuery("select * from ud_question a,ud_question_choice_single b where a.questionID = b.questionID and a.questionID = $questionID");
					$questionOptions = $db->ud_mysql_fetch_assoc_all($result);
					for($i=0;$i<sizeof($questionOptions);$i++)
					{
						$option[0]=$questionOptions[$i]['choiceText'];
						$option[1]=$questionOptions[$i]['choiceCorrect'];
						$options[$i]=$option;
					}
					$result = array('questionText'=>$questionText,'questionType'=>$questionType,'options'=>$options);
					echo json_encode($result);
					break;
				case 'Multiple Choice':
					
					break;
				case 'Subjective':
					
					break;
				case 'True/False':
					
					break;
				case 'Matching':
					
					break;
				case 'Numerical':
					
					break;				
				default:
					echo "Error";					
					break;
			}
			
		}
		else if($_POST['func'] == 'editQuest')
		{
			
		}

	}

?>