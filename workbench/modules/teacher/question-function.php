<?php

require_once '../../adminpanel/include/common/dbhelper.inc.php';



function preview($questionID,$no = 0)
{	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	$result = $db->ud_whereQuery('ud_question',NULL,array('questionID'=>$questionID));
	$result = $db->ud_mysql_fetch_assoc($result);
	if($result['questionTypeID'] == '1')
	{
		echo getSingle($result,$no);	
	}
	else if($result['questionTypeID'] == '2')
	{
		echo getMutiple($result,$no);	
	}
	else if($result['questionTypeID'] == '3')
	{
		echo getSubjective($result,$no);	
	}
	else if($result['questionTypeID'] == '4')
	{
		echo getTrueFalse($result,$no);	
	}
	else if($result['questionTypeID'] == '5')
	{
		echo getMatching($result,$no);	
	}
	else if($result['questionTypeID'] == '6')
	{
		echo getNumerical($result,$no);	
	}

}

function getSingle($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_whereQuery('`ud_question_choice_single`',NULL,array('questionID'=>$data['questionID']));
	$option = $db->ud_mysql_fetch_assoc_all($result);
	echo '
		<div class="row question-body question-box" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading">'.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
				<div class="option-single-answer">';
	for($i=0;$i<sizeof($option);$i++)
	{
		echo '<label for="radio'.($i+1).'"><input name="radio-option" type="radio" id="radio'.($i+1).'">'.$option[$i]['choiceText'].'</label>';
	}

	echo'
				</div>
			</div>
		</div>';
}

function getMutiple($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_whereQuery('`ud_question_choice_multiple`',NULL,array('questionID'=>$data['questionID']));
	$option = $db->ud_mysql_fetch_assoc_all($result);
	echo '
		<div class="row question-body question-box" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading">'.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
				<div class="option-multiple-answer">';
	for($i=0;$i<sizeof($option);$i++)
	{
		echo '<label for="checkbox'.($i+1).'"><input name="checkbox-option" type="checkbox" id="checkbox'.($i+1).'">'.$option[$i]['choiceText'].'</label>';
	}

	echo'
				</div>
			</div>
		</div>';
}

function getSubjective($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();

	echo '
	
	<div class="row question-body question-box" id="'.$data['questionID'].'">
			<div class="twelve columns">
				<span class="question-subheading">'.$data['questionName'].'</span>
				<p class="question-data">
				'.$data['questionText'].'
				</p>
			<div class="option-subjective">
				 <textarea placeholder="Enter your answer here"></textarea>    
			</div>
		</div>
	</div>

	
	';
}

function getTrueFalse($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	echo '

	<div class="row question-body question-box" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading">'.$data['questionName'].'</span>
			<p class="question-data">
			'.$data['questionText'].'
			</p>
			<div class="option-true-false">
				 <span>Select One:</span> 
				 <label style="margin-top:5px;" for="radioTrue"><input name="radio-option" type="radio" id="radioTrue">True</label>
			     <label for="radioFalse"><input name="radio-option" type="radio" id="radioFalse">False</label>
			</div>
		</div>
	</div>	
		
	';
}

function getMatching($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	echo '

	<div class="row question-body question-box" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading">'.$data['questionName'].'</span>
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

function getNumerical($data,$no)
{ 
	$db = new dbHelper();
	$db->ud_connectToDB();
	echo '

	<div class="row question-body question-box" id="'.$data['questionID'].'">
		<div class="twelve columns">
			<span class="question-subheading">'.$data['questionName'].'</span>
			<p class="question-data">
			'.$data['questionText'].'
			</p>
			<div class="option-numerical">
				 <div class="row">
				 	<div class="two columns mobile-one" style="padding:0px;">
				 		<span class="prefix">Number Only</span>
				 	</div>
				 	<div class="ten columns mobile-three" style="padding:0px;">
				 		<input type="text" placeholder="Enter the numeric answer"> 
				 	</div>
				 </div>
			</div>
		</div>
	</div>
	';

}

?>