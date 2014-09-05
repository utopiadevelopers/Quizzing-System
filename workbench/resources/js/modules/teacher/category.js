$(document).ready(function()
{
	ucategoryID = null;
	ucategoryNo = null;
	ocategory   = null;
	subjectID   = null;
	ont = $('table').dataTable(
    {
        "sPaginationType": "full_numbers"
    });  
        
    $('#add-category').click(function()
    {
    	if($('#add-category').html() == 'Add')
    	{
	    	category = $('input[name="category"]').val();
	    	subjectID = getParams('subjectID'); 
	    	sno = Number($('#add-category').attr('rowcount')) + 1;
	    	$('#add-category').attr('rowcount',sno);
	    	$.post('ajax.php',{func:'addCat',category:category,subjectID:subjectID},function(data)
	    	{
	    		data = jQuery.parseJSON(data);
	    		ont.fnAddData( [ '<div class="categoryNo">' + sno + '</div>' , '<div class="categoryTitle">' + $('input[name="category"]').val() + '</div>','<center>-</center>','<center><div class="category-id" id="' + data['categoryID'] + '" row="' + sno + '"> <img class="edit-button" style="margin-right:15px;"> <img class="delete-button"> </div> <?php } ?> </center>' ] );
	    		$('input[name="category"]').val('');
	    	});
	    }
	    else
	    {
	    	category = $('input[name="category"]').val() ;
	    	$('input[name="category"]').val('');
			$('#add-category').html('Add');

	    	ont.fnUpdate( '<div class="categoryTitle">' + category + '</div>', ucategoryNo , 1 );
	    	$.post('ajax.php',{func:'updCat',category:category,categoryID:ucategoryID,subjectID:subjectID},function(data)
	    	{
	    		data = jQuery.parseJSON(data);
	    		if($.trim(data) != 'true')
	    		{
	    			ont.fnUpdate( ocategory, ucategoryNo , 1 );
	    			$('input[name="category"]').val(category);
	    			$('#add-category').html('Modify');
	    		}
	    	});
	    }
    });
    
    $('.edit-button').live('click',function()
    {
    	ucategoryID = $(this).closest('.category-id').attr('id');
    	ucategoryNo = $(this).closest('tr').find('.categoryNo').html();
    	ucategoryNo = Number(ucategoryNo) - 1;
    	$('#add-category').html('Modify');
    	category = $(this).closest('tr').find('.categoryTitle').html();
    	ocategory = '<div class="categoryTitle">'  + category + '</div>';
    	$('input[name="category"]').val(category);
    });

    $('.delete-button').live('click',function()
    {
		$('#add-category').html('Add');
    	$('input[name="category"]').val('');
    	categoryID = $(this).closest('.category-id').attr('id');
    	categoryNo = $(this).closest('tr').find('.categoryNo').html();
    	categoryNo = Number(categoryNo) - 1;
    	var check = confirm('Are you sure you want to delete this category?\n\nNote : Deleting this category will delete all the questions in this category.');
		if(check == true)
		{
			$.post('ajax.php',{func:'delCat',categoryID:categoryID,subjectID:subjectID},function(data)
			{
				if($.trim(data) == 'true')
				{
					var sno = Number($('#add-category').attr('rowcount')) - 1;
    				$('#add-category').attr('rowcount',sno);
					ont.fnDeleteRow(categoryNo);
					for(var i = categoryNo; i<$('#add-category').attr('rowcount') ; i++)
					{
						var sn = Number(i) + 1;
						ont.fnUpdate( '<div class="categoryNo">' + sn + '</div>', i, 0 );
					}
	
  				}
			});
		}
    });
    
});

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