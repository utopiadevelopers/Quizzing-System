<?php

require_once '../../adminpanel/include/common/dbhelper.inc.php';



function preview($questionID,$no,$attemptID)
{	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	$result = $db->ud_whereQuery('ud_question',NULL,array('questionID'=>$questionID));
	$result = $db->ud_mysql_fetch_assoc($result);
	
	if(true)
	{
		$result['questionName'] = '';
	}
	if($result['questionTypeID'] == '1')
	{
		echo getSingle($result,$no,$attemptID);	
	}
	else if($result['questionTypeID'] == '2')
	{
		echo getMutiple($result,$no,$attemptID);	
	}
	else if($result['questionTypeID'] == '3')
	{
		echo getSubjective($result,$no,$attemptID);	
	}
	else if($result['questionTypeID'] == '4')
	{
		echo getTrueFalse($result,$no,$attemptID);	
	}
	else if($result['questionTypeID'] == '5')
	{
		echo getMatching($result,$no,$attemptID);	
	}
	else if($result['questionTypeID'] == '6')
	{
		echo getNumerical($result,$no,$attemptID);	
	}

}

function getSingle($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_whereQuery('`ud_question_choice_single`',NULL,array('questionID'=>$data['questionID']));
	$option = $db->ud_mysql_fetch_assoc_all($result);

	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array('attemptID'=>$attemptID,'questionID'=>$data['questionID']));
	$answer =  $db->ud_mysql_fetch_assoc($result);
	
	echo '
		<div class="row question-body question-box single" question-type="single" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
				<div class="option-single-answer">';
	for($i=0;$i<sizeof($option);$i++)
	{
		$checked = '';
		if($option[$i]['choiceID'] == $answer['answer'])
		{
			$checked = ' checked="checked" ';
		}
		echo '<label for="radio'.($i+1).'"><input name="radio-option-'.$data['questionID'].'" option-id="'.$option[$i]['choiceID'].'" type="radio" '.$checked.' id="radio'.($i+1).'">'.$option[$i]['choiceText'].'</label>';
	}

	echo'
				</div>
			</div>
		</div>';
}

function getMutiple($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_whereQuery('`ud_question_choice_multiple`',NULL,array('questionID'=>$data['questionID']));
	$option = $db->ud_mysql_fetch_assoc_all($result);

	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array('attemptID'=>$attemptID,'questionID'=>$data['questionID']));
	$answer =  $db->ud_mysql_fetch_assoc($result);
	
	$answer = explode('//',$answer['answer']);
	
	
	
	echo '
		<div class="row question-body question-box multiple" question-type="multiple" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
				<div class="option-multiple-answer">';
	
	for($i=0;$i<sizeof($option);$i++)
	{
		$checked = '';
		if(in_array($option[$i]['choiceID'], $answer))
		{
			$checked = ' checked="checked" ';
		}
		echo '<label for="checkbox'.($i+1).'"><input name="checkbox-option-'.$data['questionID'].'" option-id="'.$option[$i]['choiceID'].'" type="checkbox" '.$checked.' id="checkbox'.($i+1).'">'.$option[$i]['choiceText'].'</label>';
	}

	echo'
				</div>
			</div>
		</div>';
}

function getSubjective($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array('attemptID'=>$attemptID,'questionID'=>$data['questionID']));
	$answer =  $db->ud_mysql_fetch_assoc($result);

	echo '
	
	<div class="row question-body question-box subjective" question-type="subjective" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
			<div class="option-subjective">
				 <textarea placeholder="Enter your answer here">'.$answer['answer'].'</textarea>    
			</div>
		</div>
	</div>

	
	';
}

function getTrueFalse($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array('attemptID'=>$attemptID,'questionID'=>$data['questionID']));
	$answer =  $db->ud_mysql_fetch_assoc($result);
	
	$checked_true = '';
	$checked_false = '';
	
	if($answer['answer'] == 'True')
	{
		$checked_true = ' checked="checked" ';
	}
	if($answer['answer'] == 'False')
	{
		$checked_false = ' checked="checked" ';
	}
	
	echo '

	<div class="row question-body question-box true-false" question-type="true-false" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
			<p class="question-data">
			'.$data['questionText'].'
			</p>
			<div class="option-true-false">
				 <span>Select One:</span> 
				 <label style="margin-top:5px;" for="radioTrue"><input name="radio-option-'.$data['questionID'].'" type="radio" '.$checked_true.' val="True">True</label>
			     <label for="radioFalse"><input name="radio-option-'.$data['questionID'].'" type="radio" '.$checked_false.' val="False">False</label>
			</div>
		</div>
	</div>	
		
	';
}

function getMatching($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	echo '

	<div class="row question-body question-box matching" question-type="matching" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
			<p class="question-data">
			'.$data['questionText'].'
			</p>
			<div class="option-match">
				 <span>Select The Correct Match:</span> 
				 <div class="row matrix-match">
				 	<div class="six columns mobile-two">
				 		<label class="option">A) Something</label>
				 		<label class="option">B) Something</label>
				 		<label class="option">C) Something</label>
				 	</div>
				 	<div class="one columns mobile-one">
				 		<select>	
				 			<option>A)</option>
				 			<option>B)</option>
				 			<option>C)</option>
				 		</select>
				 		<select>	
				 			<option>A)</option>
				 			<option>B)</option>
				 			<option>C)</option>
				 		</select>
						<select>	
				 			<option>A)</option>
				 			<option>B)</option>
				 			<option>C)</option>
				 		</select>
				 	</div>
					<div class="five columns mobile-one end">
						<label class="option">Something</label>
						<label class="option">Something</label>
						<label class="option">Something</label>
				 	</div>
				 </div>
			</div>
		</div>
	</div>
	';
}

function getNumerical($data,$no,$attemptID)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	$result = $db->ud_whereQuery('`ud_users_attempt_answer`',NULL,array('attemptID'=>$attemptID,'questionID'=>$data['questionID']));
	$answer =  $db->ud_mysql_fetch_assoc($result);
	echo '

	<div class="row question-body question-box numerical" question-type="numerical" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading"><span class="question-no">Question #'.$no.'</span> '.$data['questionName'].'</span>
			<p class="question-data">
			'.$data['questionText'].'
			</p>
			<div class="option-numerical">
				 <div class="row">
				 	<div class="two columns mobile-one" style="padding:0px;">
				 		<span class="prefix">Number Only</span>
				 	</div>
				 	<div class="ten columns mobile-three" style="padding:0px;">
				 		<input type="text" placeholder="Enter the numeric answer" value="'.$answer['answer'].'"> 
				 	</div>
				 </div>
			</div>
		</div>
	</div>
	';

}

?>