$(document).ready(function()
{
	subjectID = getParams('subjectID');
	quizID = getParams('quizID');
    check_all_flag = false;
	postOBJ = null;
	postSelectObj = null;
	
	getQuestion($('#category-select').val());
	
	ont = $('table').dataTable(
    {
        "sPaginationType": "full_numbers",
    }); 
    
    $('#category-select').change(function()
    {
    	check_all_flag = false;
    	$('#question-select').attr('disabled','disabled');
    	getQuestion($('#category-select').val());
    });
    
    $('#add-all').click(function()
    {
    	if(check_all_flag)
    	{
    		check_all_flag = false;	
	    	catID = $('#category-select').val();
	    	$('#question-select').attr('disabled','disabled');
			$('#question-select').html('<option>No Question in this Category</option>');
			$('#add-all').css('cursor','default');
			$('#row-grade').hide();
			$('#row-preview').hide();
			$('#add-all').css('text-decoration','line-through');
	    	$.post('ajax.php',{func:'addAllQues',subjectID:subjectID,quizID:quizID,catID:catID},function(data)
	    	{
	    	});
	    }
    });
    
    $('#add-question').click(function()
    {
    	questionID = $('#question-select').val();
	    grade = $('#question-grade').val();
	    $('#question-select option:selected').remove();
	 	$('#question-grade').val($('#question-select option:selected').attr('grade'));
	    getPreview($('#question-select').val());

	    if($('#question-select').html() == '')
	    {
			togglePrev(false);
		}

	    if(grade!='' && grade!=0)
	    {
	    	$.post('ajax.php',{func:'addQuizQuestion',subjectID:subjectID,questionID:questionID,quizID:quizID,grade:grade},function(data)
	    	{
	    	});
	    }
    });
    
    $('#question-select').change(function()
    {
    	$('#question-grade').val($('#question-select option:selected').attr('grade'));
    	getPreview($('#question-select').val());

    });
    
});


function getQuestion(catID)
{
	if(postSelectObj != null)
	{
		postSelectObj.abort();
	}
	
	$('#row-grade').hide();
	$('#row-preview').hide();
	$('#question-select').html('<option>Downloading Question List</option>');
	postSelectObj = $.post('ajax.php',{func:'getQuestion',subjectID:subjectID,quizID:quizID,catID:catID},function(data)
	{
		if($.trim(data) != '' )
		{
			$('#question-select').html('');			
			data = $.parseJSON(data);
			var temp = 0;
			$.each(data,function(i,val)
			{
				if(val.questionName!='')
				{
					$('#question-select').append('<option grade="'+ val.questionMark +'" value="' + val.questionID + '">' + val.questionName + '</option>');
				}
				else
				{
					$('#question-select').append('<option grade="'+ val.questionMark +'" value="' + val.questionID + '">'  +val.questionText.substr(0,60) + '</option>');
				}
				temp = temp + 1;
			});
			if(temp>0)
			{
				togglePrev(true);
				getPreview($('#question-select').val());
			}
			else
			{
				togglePrev(false);
			}
		}
	});
	
	$("#question-auto").autocomplete({
      source: "autocomplete_question.php",
      minLength: 2,
      select: function( event, ui ) 
      {
      } 
    });
}

function getPreview(questionID)
{
	if(postOBJ!=null)
	{
		postOBJ.abort();
	}
	$('#question-preview').html('<center><img alt="ajax-loader" src="../../resources/images/common/ajax-loader.gif" style="margin:135px;"/></center>');
	$('#question-preview').css('min-height','200px');
	postOBJ = $.post('ajax.php',{func:'getPrevQuestion',questionID:questionID},function(data)
	{
		$('#question-preview').css('min-height','0px');
		$('#question-preview').html(data);
	});
}

function togglePrev(flag)
{
	if(flag == true)
	{
		$('#question-select').removeAttr('disabled');
		check_all_flag = true;
		$('#add-all').css('cursor','pointer');
		$('#add-all').css('text-decoration','none');
		$('#row-grade').show();
		$('#row-preview').show();
		$('#question-grade').val($('#question-select option:selected').attr('grade'));
	}
	else
	{
		$('#question-select').html('<option>No Question in this Category</option>');
		check_all_flag = false;	
		$('#add-all').css('cursor','default');
		$('#add-all').css('text-decoration','line-through');
		$('#row-grade').hide();
		$('#row-preview').hide();
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