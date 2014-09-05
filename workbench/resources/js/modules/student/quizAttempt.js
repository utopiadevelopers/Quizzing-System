$(document).ready(function()
{	
	duration = 0;
	$.post('quiz-ajax.php',{time:'time'},function(data)
	{
		duration = data;
		
	});
	
	$('#submit').click(function()
	{
		subjectID = getParams('subjectID');
		quizID = getParams('quizID');
		window.location.href = 'complete.php?subjectID='+subjectID+'&quizID='+quizID;
	});
	
	setInterval(setClock, 1000);
	
	$('.single').change(function()
	{
		questionID = $(this).attr('id');
		type = $(this).attr('question-type');
		radio = $(this).find('.option-single-answer input');
		choiceID = null;
		$(radio).each(function(i)
		{
			button = $(this);
			if(button.attr('checked') == 'checked')
			{
				choiceID = button.attr('option-id');
			}
		});
		$.post('quiz-ajax.php',{questionID:questionID,type:type,choiceID:choiceID},function()
		{
	
		});
		
	});
	
	$('.multiple').change(function()
	{
		questionID = $(this).attr('id');
		type = $(this).attr('question-type');
		check = $(this).find('.option-multiple-answer input');
		choiceID = '';
		$(check).each(function(i)
		{
			button = $(this);
			if(button.attr('checked') == 'checked')
			{
				ID = button.attr('option-id');
				choiceID = ID + '//' + choiceID;
			}
		});

		$.post('quiz-ajax.php',{questionID:questionID,type:type,choiceID:choiceID},function()
		{
	
		});
		
	});

	$('.true-false').change(function()
	{
		questionID = $(this).attr('id');
		type = $(this).attr('question-type');
		radio = $(this).find('.option-true-false input');
		choiceVal = null;
		$(radio).each(function(i)
		{
			button = $(this);
			if(button.attr('checked') == 'checked')
			{
				choiceVal = button.attr('val');
			}
		});
		$.post('quiz-ajax.php',{questionID:questionID,type:type,choiceVal:choiceVal},function()
		{
	
		});
	});
		
	$('.subjective').change(function()
	{
		questionText = $(this).find('textarea').val();
		questionID = $(this).attr('id');
		type = $(this).attr('question-type');
		$.post('quiz-ajax.php',{questionID:questionID,questionText:questionText,type:type},function()
		{
	
		});
	});
	
	$('.numerical').change(function()
	{
		questionText = $(this).find('input').val();
		questionID = $(this).attr('id');
		type = $(this).attr('question-type');
		$.post('quiz-ajax.php',{questionID:questionID,questionText:questionText,type:type},function()
		{
	
		});
	});
});

function setClock()
{
	time = duration;
	if(time>-1)
	{
		h = Math.floor(duration/3600);
		duration = duration%3600;
		m = Math.floor(duration/60);
		duration = duration%60;
		s = duration;
		
		$('.clock-h').html(getZero(h));
		$('.clock-m').html(getZero(m));
		$('.clock-s').html(getZero(s));
		
		duration = time - 1;
	}
}

function getParams(param)
{
	var queryParameters = {}, queryString = location.search.substring(1),
        re = /([^&=]+)=([^&]*)/g,
        m;

    // Creates a map with the query string parameters
    while (m = re.exec(queryString))
    {
        queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    return queryParameters[param];
}

function getZero(time)
{
	if(time<10)
	{
		time = '0' + time;
	}
	return time;
}