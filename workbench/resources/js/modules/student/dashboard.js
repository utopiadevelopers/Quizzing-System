$(document).ready(function()
{
	$('.unenroll').click(function()
	{
		subjectID = $(this).attr('id');
		course = $(this).closest('.course');
		if(confirm("Please confirm that you want to un-enroll from: "+ $(this).closest('.course').find('.course-name').html() + "Note: If you un-enroll, you will no longer be able to see your record for this course on the Course records page."))
		{
			course.fadeOut(500);
			$.post('ajax.php',{func:'unenrollcourse',subjectID:subjectID},function(data)
			{
				if($.trim(data) == 'true')
				{
					course.remove();
				}
				else
				{
					course.fadeIn(500);
				}
			})
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