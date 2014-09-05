$(document).ready(function()
{
	var id,data;
	ont = $('table').dataTable(
    {
        "sPaginationType": "full_numbers"
    });  
    
    $('#add-question').click(function()
    {
    	href = $(this).attr('href');
    	categoryID = $('#category-select').val();
    	href = href + '&categoryID=' + categoryID;
    	$(this).attr('href',href);
    });
    
    $('.edit-button').click(function() {
    	var choiceContent1 = '<div class="choice-single"> <div class="row"> <div class="two columns mobile-one"> <label class="right inline">Choice</label> </div> <div class="six columns mobile-three"> <input type="text" placeholder="Enter the Choice"> </div> <div class="four columns"> <label for="radio';
    	var choiceContent2 = '"><input name="radio-choice" type="radio" id="radio';
    	var choiceContent3 = '">Is Choice Correct</label> </div> </div> </div>';
    	id = $(this).closest('div').attr('id');
    	
    	$("#modal-edit-single").reveal();
    	var flag = false;
    	$.post('ajax.php',{func:"fetchQuest",qID:id},function(data)
    	{
    		if(data != "error")
    		{
    			data = $.parseJSON(data);
    			//alert(data.questionText);
    			$("#modal-edit-single").find('#questionText').val(data.questionText);
    			var selector = $("#modal-edit-single").find('.row');
	    		for(i = 0;i<data.options.length;i++)
	    		{
	    			selector.append(choiceContent1+Number(i+1)+choiceContent2+Number(i+1)+choiceContent2);	    			
	    		}
	    		$("#modal-edit-single").find('.choice-single').each(function(index) {
				  $(this).find('input[type="text"]').val(data.options[index][0]);
				  if(data.options[index][1]=="1")
				  {
				  	$(this).find('input[type="radio"]').attr('checked','checked');
				  }
				});
    		}
    		else
    		{
    			alert("error");
    		}    		
    	});    	
    });
    
    
    //All edits
    $('#edit-single').click(function() {
    	
    });
    
    $('.delete-button').click(function() {
    	var id = $(this).closest('div').attr('id');
    	var selector = $(this).closest('tr')[0];
    	var conf = confirm("Are You Sure You Want To delete This Quistion");
    	if(conf)
    	{
    		
    		
    		$.post('ajax.php',{func:'delQuest',id:id},function(data)
	    	{
	    		if(data=="Success")
	    		{
	    			ont.fnDeleteRow(selector);
	    		}
	    		else
	    		{
	    			//TODO
	    		}
	    	});
    	}
    	
    	
    });
});