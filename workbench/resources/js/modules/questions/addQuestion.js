var count=0;
var singleChoiceHTML='<form> <fieldset> <legend>Enter a Question</legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="ten columns mobile-three"> <textarea id="questionText" placeholder="Enter the Question here"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Shuffle the Choices</label> </div> <div class="six columns mobile-three"> <input id="shuffleChoices" type="checkbox"> </div> <div class="four columns"> </div> </div> <hr> <fieldset> <legend>Choices</legend> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional choices</label> </div> <div class="two columns"> <input type="button" class="button" id="addChoice" value="Add Choice"> </div> <div class="two columns"> <input type="button" class="button" id="removeChoice" value="Remove Choice"> </div> <div class="five columns"> </div> </div> <div class="choice-single"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="radio1"><input name="radio-choice" type="radio" checked="checked" id="radio1">Is Choice Correct</label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div> <hr> <div class="choice-single"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice 2</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="radio2"><input name="radio-choice" type="radio" id="radio2">Is Choice Correct</label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div> </fieldset> <fieldset> <legend>Combined Feedback</legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a correct response"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Incorrect Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for an incorrect response"> </div> <div class="four columns"> </div> </div> </fieldset> <fieldset> <legend>Additional Options</legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33"> </div> <div class="four columns"> </div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns"> <input type="button" class="button" id="addHint" value="Add Hint"> </div> <div class="two columns"> <input type="button" class="button" id="removeHint" value="Remove Hint"> </div> <div class="five columns"> </div> </div> </div> </fieldset> </fieldset> </form>';
var multipleChoiceHTML='<form> <fieldset> <legend> Enter a Question </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="ten columns mobile-three"> <textarea id="questionText" placeholder="Enter the Question here"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Shuffle the Choices</label> </div> <div class="six columns mobile-three"> <input id="shuffleChoices" type="checkbox"> </div> <div class="four columns"></div> </div> <hr> <fieldset> <legend> Choices </legend> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional choices</label> </div> <div class="two columns"> <input id="addChoice" class="button" type="button" value="Add Choice"> </div> <div class="two columns"> <input id="removeChoice" class="button" type="button" value="Remove Choice"> </div> <div class="five columns"></div> </div> <div class="choice-multiple"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="checkbox1"> <input id="checkbox1" checked="checked" type="checkbox" name="checkbox-choice"> Is Choice Correct </label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> <hr> <div class="choice-multiple"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice 2</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="checkbox2"> <input id="checkbox2" type="checkbox" name="checkbox-choice"> Is Choice Correct </label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> </fieldset> <fieldset> <legend> Combined Feedback </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Partially Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a partially correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Incorrect Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for an incorrect response"> </div> <div class="four columns"></div> </div> </fieldset> <fieldset> <legend> Additional Options </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns"> <input id="addHint" class="button" type="button" value="Add Hint"> </div> <div class="two columns"> <input id="removeHint" class="button" type="button" value="Remove Hint"> </div> <div class="five columns"></div> </div> </fieldset> </fieldset> </form> ';
var subjectiveHTML='<form> <fieldset> <legend> Enter a Question </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="ten columns mobile-three"> <textarea id="questionText" placeholder="Enter the Question here"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"></div> </div> <hr> <fieldset> <legend> Answer </legend> <div class="choice-subjective"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Correct Answer</label> </div> <div class="ten columns mobile-three"> <textarea id="answer" placeholder="Enter the Answer"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input id="feedback" type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> </fieldset> <fieldset> <legend> Combined Feedback </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Partially Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a partially correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Incorrect Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for an incorrect response"> </div> <div class="four columns"></div> </div> </fieldset> <fieldset> <legend> Additional Options </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns"> <input id="addHint" class="button" type="button" value="Add Hint"> </div> <div class="two columns"> <input id="removeHint" class="button" type="button" value="Remove Hint"> </div> <div class="five columns"></div> </div> </fieldset> </fieldset> </form> ';
var truefalseHTML='<form> <fieldset> <legend> Enter a Question </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="ten columns mobile-three"> <textarea id="questionText" placeholder="Enter the Question here"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"></div> </div> <hr> <fieldset> <legend> Answer </legend> <div class="choice-true-false"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Correct Answer</label> </div> <div class="five columns mobile-three"> <label for="radio1"> <input id="radio1" checked="checked" value="True" type="radio" name="radio-ans"> True is Choice Correct </label> </div> <div class="five columns mobile-three"> <label for="radio2"> <input id="radio2" value="False" type="radio" name="radio-ans"> False is Choice Correct </label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input id="feedback" type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> </fieldset> <fieldset> <legend> Additional Options </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns"> <input id="addHint" class="button" type="button" value="Add Hint"> </div> <div class="two columns"> <input id="removeHint" class="button" type="button" value="Remove Hint"> </div> <div class="five columns"></div> </div> </fieldset> </fieldset> </form>';
var numericalHTML='<form> <fieldset> <legend> Enter a Question </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="ten columns mobile-three"> <textarea id="questionText" placeholder="Enter the Question here"></textarea> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"></div> </div> <hr> <fieldset> <legend> Answer </legend> <div class="choice-subjective"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Correct Answer</label> </div> <div class="ten columns mobile-three"> <div class="row"> <div class="two columns mobile-one" style="padding:0px;"> <span class="prefix">Number Only</span> </div> <div class="five columns mobile-two" style="padding:0px;"> <input id="answer" type="number" placeholder="Enter the numeric answer"> </div> <div class="five"></div> </div> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Tolerance</label> </div> <div class="six columns mobile-three"> <input id="tolerance" type="text" placeholder="Enter Tolerance Percentage eg 33 Default 0"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input id="feedback" type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> </fieldset> <fieldset> <legend> Combined Feedback </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Partially Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a partially correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Incorrect Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for an incorrect response"> </div> <div class="four columns"></div> </div> </fieldset> <fieldset> <legend> Additional Options </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33%"> </div> <div class="four columns"></div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns"> <input id="addHint" class="button" type="button" value="Add Hint"> </div> <div class="two columns"> <input id="removeHint" class="button" type="button" value="Remove Hint"> </div> <div class="five columns"></div> </div> </fieldset> </fieldset> </form> ';
var matchingHTML='<form> <fieldset> <legend> Enter a Question </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question Name</label> </div> <div class="six columns mobile-three"> <input id="questionName" type="text" placeholder="Enter Question Name"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns mobile-two"> <label class="right inline">Add/Remove Additional Questions</label> </div> <div class="two columns mobile-one"> <input class="button" type="button" id="addQuestion" value="Add Question"> </div> <div class="two columns mobile-one"> <input class="button" type="button" id="removeQuestion" value="Remove Question"> </div> <div class="five columns"></div> </div> <hr> <div class="row question-matching"> <div class="six columns mobile four"> <div class="row "> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Question"> </div> <div class="four columns"></div> </div> </div> <div class="six columns mobile four"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Answer"> </div> <div class="four columns"></div> </div> </div> </div> <div class="row question-matching"> <div class="six columns mobile four"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Question"> </div> <div class="four columns"></div> </div> </div> <div class="six columns mobile four"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Answer"> </div> <div class="four columns"></div> </div> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Default Marks</label> </div> <div class="six columns mobile-three"> <input id="defaultMarks" type="number" placeholder="Enter Default Marks"> </div> <div class="four columns"></div> </div> <hr> <fieldset> <legend> Additional Choices </legend> <div class="row"> <div class="three columns mobile-two"> <label class="right inline">Add/Remove Additional choices</label> </div> <div class="two columns mobile-one"> <input class="button" type="button" id="addChoice" value="Add Choice"> </div> <div class="two columns mobile-one"> <input class="button" type="button" id="removeChoice" value="Remove Choice"> </div> <div class="five columns"></div> </div> <div class="choice-misquide"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice To Misguide</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> <hr> <div class="choice-misquide"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice To Misguide</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"></div> </div> </div> </fieldset> <fieldset> <legend> Combined Feedback </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Partially Correct Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for a partially correct response"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Any Incorrect Response</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for an incorrect response"> </div> <div class="four columns"></div> </div> </fieldset> <fieldset> <legend> Additional Options </legend> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Penalty For Incorrect Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Penalty in Percentage eg 33"> </div> <div class="four columns"></div> </div> <div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint 1</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"></div> </div> <div class="row"> <div class="three columns mobile-two"> <label class="right inline">Add/Remove Additional Hints</label> </div> <div class="two columns mobile-one end"> <input class="button" type="button" id="addHint" value="Add Hint"> </div> <div class="two columns mobile-one"> <input class="button" type="button" id="removeHint" value="Remove Hint"> </div> <div class="five columns"></div> </div> </fieldset> </fieldset> </form> ';
var hintinit='<div class="row hint"> <div class="two columns mobile-one"> <label class="right inline">Hint ';
var hintfin ='</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Hint"> </div> <div class="four columns"> </div> </div>';
var singleChoice='<hr> <div class="choice-single"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice '+count+'</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="radio'+count+'"><input name="radio-choice" type="radio" id="radio'+count+'">Is Choice Correct</label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div>';
var multipleChoice='<hr> <div class="choice-multiple"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice '+count+'</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="checkbox'+count+'"> <input id="checkbox'+count+'" type="checkbox" name="checkbox-choice"> Is Choice Correct </label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div>';
var matchingAddQuestion='<div class="row question-matching"> <div class="six columns mobile four"> <div class="row "> <div class="two columns mobile-one"> <label class="right inline">Question</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Question"> </div> <div class="four columns"> </div> </div> </div> <div class="six columns mobile four"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Answer</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Answer"> </div> <div class="four columns"> </div> </div> </div> </div>';
var matchingChoice='<hr><div class="choice-misquide"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice To Misguide</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div>';

$(document).ready(function()
{
	$('#selectQuestion').change(function()
	{
		var choice=$(this).val();
		var selector=$('.addQuestion-content');
		switch(choice)
		{
			case '1':
				selector.html(singleChoiceHTML);
			break;
			case '2':
				selector.html(multipleChoiceHTML);
			break;
			case '3':
				selector.html(subjectiveHTML);
			break;
			case '4':
				selector.html(truefalseHTML);
			break;
			case '5':
				selector.html(matchingHTML);
			break;
			case '6':
				selector.html(numericalHTML);
			break;
			default:
				alert('Invalid Case');
			break;

		}
	});
	
	$('#addHint').live('click',function()
	{
		var count=0;
		var selector;
		$('.hint').each(function()
		{
			count++;
			selector=$(this);
		});
		
		count++;
		selector.after(hintinit+count+hintfin);		
		
		
	});
	
	$('#removeHint').live('click',function()
	{
		var selector;
		var count=0;
		$('.hint').each(function()
		{
			count++;
			selector=$(this);
		});
		
		if(count>1)
			selector.remove();
	});
	
	$('#addChoice').live('click',function()
	{
		count=0;
		var choice=$('#selectQuestion').val();
		var selector;
		switch(choice)
		{
			case '1':
			$('.choice-single').each(function()
			{
				selector=$(this);
				count++;
			});
			
			count++;
			selector.after(setupSingleChoice());
			break;
			case '2':
			$('.choice-multiple').each(function()
			{
				selector=$(this);
				count++;
			});
			
			count++;
			selector.after(setupMultipleChoice());
	
			break;
			case '3':
				
			break;
			case '4':
				
			break;
			case '5':
			$('.choice-misquide').each(function()
			{
				selector=$(this);
				count++;
			});
			
			count++;
			selector.after(matchingChoice);
	
			break;
			case '6':
				
			break;
			default:
				alert('Invalid Case');
			break;
		}

	});
		
		$('#addQuestion').live('click',function(){
			count=0;
			var selector;
			$('.question-matching').each(function()
			{
				selector=$(this);
				count++;
			});

			count++;
			selector.after(matchingAddQuestion);
		});
		
		$('#removeQuestion').live('click',function()
		{
			count=0;
			var selector;
			$('.question-matching').each(function()
			{
				selector=$(this);
				count++;
			});
			
			if(count>2)	
			{		
				selector.remove();				
			}

		});

	
	$('#removeChoice').live('click',function()
	{
		count=0;
		var choice=$('#selectQuestion').val();
		var selector;
		switch(choice)
		{
			case '1':
			$('.choice-single').each(function()
			{
				selector=$(this);
				count++;
			});
			
			if(count>2)	
			{		
				selector.prev('hr').remove()
				selector.remove();				
			}
				
			break;
			case '2':
			$('.choice-multiple').each(function()
			{
				selector=$(this);
				count++;
			});
			
			if(count>2)	
			{		
				selector.prev('hr').remove()
				selector.remove();				
			}
				
			break;
			case '3':
				
			break;
			case '4':
				
			break;
			case '5':
			$('.choice-misquide').each(function()
			{
				selector=$(this);
				count++;
			});
			
			if(count>2)	
			{		
				selector.prev('hr').remove()
				selector.remove();				
			}
	
			break;
			case '6':
				
			break;
			default:
				alert('Invalid Case');
			break;

		}

	});
	
	$('#addButton').click(function() 
	{
		var choice=$('#selectQuestion').val();
		$('#selectQuestion').attr('disabled','disabled');
				
		switch(choice)
		{
			case '1':
			//Question
			var questionName=$('#questionName').val();
			var questionText=$('#questionText').val();
			if(questionText=="")
			{
				alert('Enter Question Text');
				returnNow=true;
				return;
			}
			var shuffle="";
			if($('#shuffleChoices').is(':checked'))
				shuffle='1';
			else
				shuffle='0';
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var choice=[];
			var grade=[];
			var feedback=[];
			var temp;
			var outercount=0;
			var innercount=0;
			var returnNow=false;
			var correctAns;
			var combindedFeedbackPos;
			var combindedFeedbackNeg;
			var penalty=0;
			var hintQ=[];
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			//Choices
			$('.choice-single').each(function()
			{
				innercount=0;
				if(returnNow==true)
					return;
					
				//alert(returnNow);
				
				$(this).find("input[type='text']").each(function()
				{
					if(returnNow==true)
					return;
					temp = $(this).val();
					switch(innercount)
					{
						case 0:
						if(temp=="")
						{
							alert('Enter Choice');
							returnNow=true;
							return;
						}
						else
							choice.push(temp);
						break;
						case 1:
						if(temp!="")						
						{
							temp=Number(temp);
							if(isNaN(temp)|| temp>100 || temp<0)
							{
								alert('Enter Valid Grade Percentage');
								returnNow=true;
								return;
							}
							else
								grade.push(temp);
						}
							
						break;
						case 2:
							feedback.push(temp);
						break;
						default:
						alert('Invalid');
					}
					innercount++;					
				});			
				
			});
			correctAns=$('input[name=radio-choice]:checked', '.choice-single').attr('id');
			correctAns=correctAns.charAt(correctAns.length-1);
			var count=0;
			$('fieldset:eq(2)').find("input[type='text']").each(function()
			{
				switch(count)
				{
					case 0:
					combindedFeedbackPos=$(this).val();
					break;
					case 1:
					combindedFeedbackNeg=$(this).val();
					break;
					default:
					alert('Invalid');
				}
				count++;
			});
			var additionalOptions=$('fieldset:eq(3)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'1',questionName:questionName,questionText:questionText,shuffle:shuffle,defaultMarks:defaultMarks,choice:choice,grade:grade,feedback:feedback,correctAns:correctAns,combinedPos:combindedFeedbackPos,combinedNeg:combindedFeedbackNeg,questionHint:hintQ,penalty:penalty,categoryId:split[1][1]},function(data)
				{
					
				});
			}
			break;
			case '2':
			//Question
			var questionName=$('#questionName').val();
			var questionText=$('#questionText').val();
			if(questionText=="")
			{
				alert('Enter Question Text');
				returnNow=true;
				return;
			}
			var shuffle="";
			if($('#shuffleChoices').is(':checked'))
				shuffle='1';
			else
				shuffle='0';
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var choice=[];
			var grade=[];
			var feedback=[];
			var temp;
			var outercount=0;
			var innercount=0;
			var returnNow=false;
			var correctAns=[];
			var combindedFeedbackPos;
			var combindedFeedbackNeg;
			var combindedFeedbackPar;
			var penalty=0;
			var hintQ=[];
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			//Choices
			$('.choice-multiple').each(function()
			{
				innercount=0;
				if(returnNow==true)
					return;
					
				//alert(returnNow);
				
				$(this).find("input[type='text']").each(function()
				{
					if(returnNow==true)
					return;
					temp = $(this).val();
					switch(innercount)
					{
						case 0:
						if(temp=="")
						{
							alert('Enter Choice');
							returnNow=true;
							return;
						}
						else
							choice.push(temp);
						break;
						case 1:
						if(temp!="")						
						{
							temp=Number(temp);
							if(isNaN(temp)|| temp>100 || temp<0)
							{
								alert('Enter Valid Grade Percentage');
								returnNow=true;
								return;
							}
							else
								grade.push(temp);
						}
							
						break;
						case 2:
							feedback.push(temp);
						break;
						default:
						alert('Invalid');
					}
					innercount++;					
				});			
				
			});
			$('input[name=checkbox-choice]:checked', '.choice-multiple').each(function()
			{
				temp = $(this).attr('id');
				correctAns.push(temp.charAt(temp.length-1));
			});
			
			var count=0;
			$('fieldset:eq(2)').find("input[type='text']").each(function()
			{
				switch(count)
				{
					case 0:
					combindedFeedbackPos=$(this).val();
					break;
					case 1:
					combindedFeedbackPar=$(this).val();
					break;
					case 2:
					combindedFeedbackNeg=$(this).val();
					break;
					default:
					alert('Invalid');
				}
				count++;
			});
			var additionalOptions=$('fieldset:eq(3)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'2',questionName:questionName,questionText:questionText,shuffle:shuffle,defaultMarks:defaultMarks,choice:choice,grade:grade,feedback:feedback,correctAns:correctAns,combinedPos:combindedFeedbackPos,combinedNeg:combindedFeedbackNeg,combinedPar:combindedFeedbackPar ,questionHint:hintQ,penalty:penalty,categoryId:split[1][1]},function(data)
				{
					
				});
			}				
			break;
			case '3':
			//Question
			var questionName=$('#questionName').val();
			var questionText=$('#questionText').val();
			if(questionText=="")
			{
				alert('Enter Question Text');
				returnNow=true;
				return;
			}
			
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var feedback;
			var temp;
			var outercount=0;
			var innercount=0;
			var returnNow=false;
			var correctAns;
			var combindedFeedbackPos;
			var combindedFeedbackNeg;
			var combindedFeedbackPar;
			var penalty=0;
			var hintQ=[];
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			
			correctAns = $('#answer').val();
			if(correctAns=="")
			{
				alert('Enter the correct answer');
				returnNow=true;
				return;
			}
			
			feedback = $('#feedback').val();
			
			var count=0;
			$('fieldset:eq(2)').find("input[type='text']").each(function()
			{
				switch(count)
				{
					case 0:
					combindedFeedbackPos=$(this).val();
					break;
					case 1:
					combindedFeedbackPar=$(this).val();
					break;
					case 2:
					combindedFeedbackNeg=$(this).val();
					break;
					default:
					alert('Invalid');
				}
				count++;
			});
			var additionalOptions=$('fieldset:eq(3)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'3',questionName:questionName,questionText:questionText,defaultMarks:defaultMarks,feedback:feedback,correctAns:correctAns,combinedPos:combindedFeedbackPos,combinedNeg:combindedFeedbackNeg,combinedPar:combindedFeedbackPar ,questionHint:hintQ,penalty:penalty,categoryId:split[1][1]},function(data)
				{
					
				});
			}	
			break;
			case '4':
			//Question
			var questionName=$('#questionName').val();
			var questionText=$('#questionText').val();
			if(questionText=="")
			{
				alert('Enter Question Text');
				returnNow=true;
				return;
			}
			
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var feedback;
			var temp;
			var outercount=0;
			var innercount=0;
			var returnNow=false;
			var correctAns="";
			var combindedFeedbackPos;
			var combindedFeedbackNeg;
			var combindedFeedbackPar;
			var penalty=0;
			var hintQ=[];
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			
			correctAns = $('input[name=radio-ans]:checked', '.choice-true-false').val();
			if(correctAns=="")
			{
				alert('Enter the correct answer');
				returnNow=true;
				return;
			}
			
			feedback = $('#feedback').val();
			
			var additionalOptions=$('fieldset:eq(2)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'4',questionName:questionName,questionText:questionText,defaultMarks:defaultMarks,feedback:feedback,correctAns:correctAns,questionHint:hintQ,penalty:penalty,categoryId:split[1][1]},function(data)
				{
					
				});
			}	
			break;
			case '5':
			//Question
			var questionName=$('#questionName').val();
			
			var question=[];
			var answer=[];
			var outercount=0;
			var innercount=0;
			$('.question-matching').each(function()
			{
				innercount=0;
				if(returnNow==true)
					return;
					
				//alert(returnNow);
				
				$(this).find("input[type='text']").each(function()
				{
					if(returnNow==true)
					return;
					temp = $(this).val();
					switch(innercount)
					{
						case 0:
							if(temp=="")
							{
								alert('Enter atleast two questions');
								returnNow=true;
								return;
							}
							else
							question.push(temp);
						break;
						case 1:
							if(temp=="")
							{
								alert('Enter atleast two answers');
								returnNow=true;
								return;
							}
							else
							answer.push(temp);
						break;
						default:
						alert('Invalid');
					}
					innercount++;					
				});			
				
			});
						
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var misguideChoice=[];
			var misguideFeedback=[];
			var temp;			
			var returnNow=false;
			var correctAns;
			var combindedFeedbackPos;
			var combindedFeedbackPar;
			var combindedFeedbackNeg;
			var penalty=0;
			var hintQ=[];
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			//Choices
			$('.choice-misquide').each(function()
			{
				innercount=0;
				if(returnNow==true)
					return;
					
				//alert(returnNow);
				
				$(this).find("input[type='text']").each(function()
				{
					if(returnNow==true)
					return;
					temp = $(this).val();
					switch(innercount)
					{
						case 0:
							if(temp!="")
								misguideChoice.push(temp);
						break;
						case 1:
							if(temp!="")
								misguideFeedback.push(temp);
						break;
						default:
						alert('Invalid');
					}
					innercount++;					
				});			
				
			});
			
			var count=0;
			$('fieldset:eq(2)').find("input[type='text']").each(function()
			{
				switch(count)
				{
					case 0:
					combindedFeedbackPos=$(this).val();
					break;
					case 1:
					combindedFeedbackPar=$(this).val();
					break;
					case 2:
					combindedFeedbackNeg=$(this).val();
					break;
					default:
					alert('Invalid');
				}
				count++;
			});
			
			var additionalOptions=$('fieldset:eq(3)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'5',questionName:questionName,question:question,answer:answer,defaultMarks:defaultMarks,misguidechoice:misguideChoice,misguidefeedback:misguideFeedback,combinedPos:combindedFeedbackPos,combinedPar:combindedFeedbackPar,combinedNeg:combindedFeedbackNeg,questionHint:hintQ,penalty:penalty,categoryId:split[1][1]},function(data)
				{
					
				});
			}
			break;	
			case '6':
			//Question
			var questionName=$('#questionName').val();
			var questionText=$('#questionText').val();
			if(questionText=="")
			{
				alert('Enter Question Text');
				returnNow=true;
				return;
			}
			var shuffle="";
			if($('#shuffleChoices').is(':checked'))
				shuffle='1';
			else
				shuffle='0';
			var defaultMarks=$('#defaultMarks').val();
			if(defaultMarks=="")
			{
				alert('Enter Default Marks');
				returnNow=true;
				return;
			}
			else
			{
				defaultMarks=Number(defaultMarks);
				if(isNaN(defaultMarks)|| defaultMarks>100 || defaultMarks<0)
				{
					alert('Enter Valid Default Marks');
					returnNow=true;
					return;
				}
				
			}	
			var feedback;
			var temp;
			var outercount=0;
			var innercount=0;
			var returnNow=false;
			var correctAns;
			var combindedFeedbackPos;
			var combindedFeedbackNeg;
			var combindedFeedbackPar;
			var penalty=0;
			var hintQ=[];
			var tolerance;
			var split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			//alert(split[1][1]);
			
			correctAns = $('#answer').val();
			if(correctAns=="")
			{
				alert('Enter the correct answer');
				returnNow=true;
				return;
			}
			else
			{
				temp=Number(correctAns);
				if(isNaN(temp))
				{
					alert('Enter Valid Correct Answer');
					returnNow=true;
					return;
				}
				else
					correctAns=temp;
			}
			
			feedback = $('#feedback').val();
			
			tolerance = $('#tolerance').val();
			temp=Number(tolerance);
			if(isNaN(temp)|| temp>100 || temp<0)
			{
				alert('Enter Valid Tolerance');
				returnNow=true;
				return;
			}
			else
				tolerance=temp;
					
			var count=0;
			$('fieldset:eq(2)').find("input[type='text']").each(function()
			{
				switch(count)
				{
					case 0:
					combindedFeedbackPos=$(this).val();
					break;
					case 1:
					combindedFeedbackPar=$(this).val();
					break;
					case 2:
					combindedFeedbackNeg=$(this).val();
					break;
					default:
					alert('Invalid');
				}
				count++;
			});
			var additionalOptions=$('fieldset:eq(3)');
			temp = additionalOptions.find("input[type='text']").first().val();
			if(temp!="")
			{
				temp=Number(temp);
				if(isNaN(temp)|| temp>100 || temp<0)
				{
					alert('Enter Valid Penalty Percentage');
					returnNow=true;
					return;
				}
				else
					penalty=temp;
			}
			
			additionalOptions.find('.hint').each(function() {
			  hintQ.push($(this).find('input[type="text"]').first().val());
			});
			
			if(returnNow==true)
				return;
			else
			{
				$.post('addQuestionAjax.php',{type:'6',questionName:questionName,questionText:questionText,defaultMarks:defaultMarks,feedback:feedback,correctAns:correctAns,combinedPos:combindedFeedbackPos,combinedNeg:combindedFeedbackNeg,combinedPar:combindedFeedbackPar ,questionHint:hintQ,penalty:penalty,categoryId:split[1][1],tolerance:tolerance},function(data)
				{
					
				});
			}	
			break;
			default:
				alert('Invalid Case');
			break;

		}
	});


});

function setupSingleChoice()
{
	return singleChoice='<hr> <div class="choice-single"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice '+count+'</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="radio'+count+'"><input name="radio-choice" type="radio" id="radio'+count+'">Is Choice Correct</label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div>';
}

function setupMultipleChoice()
{
	return multipleChoice='<hr> <div class="choice-multiple"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice '+count+'</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="checkbox'+count+'"> <input id="checkbox'+count+'" type="checkbox" name="checkbox-choice"> Is Choice Correct </label> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Grade</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter Grade Percentage eg 33%"> </div> <div class="four columns"> </div> </div> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Feedback</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the feedback for the Choice"> </div> <div class="four columns"> </div> </div> </div>';

}

