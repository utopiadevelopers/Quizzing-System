var barCountainer,d1 = [],split;
$(document).ready(function() {
	barCountainer = document.getElementById("bar");
	setTimeout(plotF,100);
	split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
			
	ont = $('table').dataTable(
    {
        "sPaginationType": "full_numbers"
    });  
});

function plotF()
{	
		//alert('now');
		$.post('reportsGenerate.php',{func:'overall',type:'bar',subjectID:split[0][1]},function(data)
		{
			d1 = $.parseJSON(data);
			//alert(data);
			
			// Draw the graph
		    var graph = Flotr.draw(
		    barCountainer, [d1], {
		        bars: {
		            show: true,
		            horizontal: true,
		            shadowSize: 0,
		            barWidth: 1
		        },
		        mouse: {
		            track: true,
		            relative: true
		        },
		        xaxis: {		        	
		        	min: 0,
		        	title:'Score'
		        },
		        yaxis: {
		            autoscaleMargin: 1,
		            title:'Quizes'
		        }
		    });
		});
}