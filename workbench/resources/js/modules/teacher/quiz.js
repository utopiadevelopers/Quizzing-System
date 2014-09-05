$(document).ready(function()
{
	ucategoryID = null;
	ucategoryNo = null;
	ocategory   = null;
	subjectID   = getParams('subjectID');
	
	$('#fromDateTime').datetimepicker(
	{
		numberOfMonths: 2,
		timeFormat: "HH:mm:00",	
		dateFormat: "yy-m-d"
	});
	
	$('#toDateTime').datetimepicker(
	{
		numberOfMonths: 2,
		timeFormat: "HH:mm:00",	
		dateFormat: "yy-m-d"
	});
	
	$('#quiz-dur').timepicker();
	
	ont = $('table').dataTable(
    {
        
        "sPaginationType": "full_numbers"
    });  
     
	$('#add-quiz-modal').click(function()
	{
		$("#myModal").reveal();
	});  
	
	$('#close-box').click(function()
	{
		$('#myModal').trigger('reveal:close');
	});
	
	$('.add-button').on('click',function()
	{
		var quizID = $(this).closest('.quiz-id').attr('id');
		window.location = 'addQuizQuestion.php?subjectID=' + subjectID + '&quizID=' + quizID;
	});
	
	$('#add-quiz').click(function()
	{
		var quizTitle = $('input[name="quizTitle"]');
		var quizS	  = $('input[name="quizF"]');
		var quizT	  = $('input[name="quizT"]');
		
		var flag = true;
		
		if(quizTitle.val()==null)
		{
			validateField(quizTitle,'Fill in Quiz Title');
			flag = false;
		}
		if(quizS.val()==null)
		{
			validateField(quizS,'Fill in Quiz Start Time');
			flag = false;
		}
		if(quizT.val()==null)
		{
			validateField(quizT,'Fill in Quiz Finish Time');
			flag = false;
		}
		
		quizDuration = $('#hour-select option:selected').val() * 3600 + $('#minute-select option:selected').val() * 60;
		
		if(quizDuration == 0)
		{
			flag = false;
		}
		
		if(flag == true)
		{
			$.post('ajax.php',{func:'addQuiz',subjectID:subjectID,quizName:quizTitle.val(),quiztimestampF:quizT.val(),quiztimestampS:quizS.val(),quizDuration:quizDuration},function(data)
			{
				if($.trim(data)!='false')
				{
					$('#myModal').trigger('reveal:close');
					window.location.reload();
				}
			});
		}
	});
});

function validateField(field,message)
{
	var txt = $(field).val();
	if(txt.replace(/ /g, "") != "")
	{
		if($(field).is(".error"))
		{
			$(field).removeClass("error");
			$(field).next().remove();
			
		}
		return false;
	}
	else
	{
		if(!$(field).is(".error"))
		{
			$(field).addClass("error");
			$(field).after('<small class="error">' + message +'.</small>');
		//	$(field).focus();
		}	
		else
		{
			$(field).next().html(message);
		//	$(field).focus();
		}
		return true;
	}
}
function removeError(field)
{
	$(field).removeClass("error");
	$(field).next().remove();
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