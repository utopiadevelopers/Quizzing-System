var barCountainer,d1=[];
var split;
var value;
$(document).ready(function() {
	//var barCountainer=$('#pill1Tab').find('.twelve').first();
	barCountainer = document.getElementById("bar");
	split = location.search.replace('?', '').split('&').map(function(val){
			  return val.split('=');
			});
	setTimeout(plotF,100,Array('bar'),Array('overall'));
	
	$('#quizSelect').change(function() {
		value = $(this).attr('value');
		if(value == 'Overall')
		{
			plotF('bar','overall');
		}
		else
		{
			plotF('bar','');
		}
		
	});
	
	//alert(d1);
	//alert(JSON.stringify(d1));
	
	
});

function plotF(type,graph)
{
	//alert(type);
	//alert(graph);
	if(type=='bar' && graph=='overall')
	{
		//alert('now');
		$.post('reportsGenerate.php',{func:'overall',type:'bar',subjectID:split[0][1]},function(data)
		{
			$('#QuizNo').html(value);
			
			d1 = $.parseJSON(data);
			
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
		            title:'Students'
		        }
		    });
		});
	}
	else
	{
		$.post('reportsGenerate.php',{func:'quiz',type:'bar',subjectID:split[0][1],value:value},function(data)
		{
			$('#QuizNo').html(value);
			d1 = $.parseJSON(data);
			
			//alert(data);
			//alert(d1);
			
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
		            title:'Students'
		        }
			});
		});
	}	
	
}

