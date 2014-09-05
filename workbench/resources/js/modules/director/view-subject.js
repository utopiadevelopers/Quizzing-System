$(document).ready(function()
{
	ont = $('table').dataTable(
    {
        "sPaginationType": "full_numbers"
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