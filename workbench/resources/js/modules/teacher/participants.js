$(document).ready(function() {
	var split = location.search.replace('?', '').split('&').map(function(val) {
		return val.split('=');
	});

	var addedEntries,failureFormat,failureExists;
	
	$('#add-student').click(function() {
		$("#modalAdd").reveal();
	});
	
	$('#add-manual').click(function() {
		var rollNo,username,email,password;
		$('#modalAdd').find('input[type="text"],input[type="email"]').each(function(index) {
			alert($(this).attr('placeholder'));
			switch(index)
			{
				case 0:
				rollNo = $(this).val();
				break;
				
				case 1:
				username = $(this).val();
				
				break;
				case 2:
				email = $(this).val();
				
				break;
				case 3:
				password = $(this).val();
				break;
				default:
				alert("Error");
				break;
			}
		  
		});
		$.post('ajaxParticipantManual.php',{func:'addPart',roll:rollNo,username:username,email:email,password:password},function(data)
		{
			if(data == "ok")
			{
				$('#modalAdd').find('input[type="text"],input[type="email"]').each(function(index) {
					$(this).val('');
				});
				$("#modalAdd").trigger('reveal:close');
			}
			else
			{
				alert('Error');
			}
			
		});
	});
	
	switch(split[1][1]) {
		case 'Active':
			$('.content-participants').find('dd:eq(0)').addClass('active');
			$('.content-participants').find('li:eq(0)').addClass('active');
			$('.content-participants').find('dd:eq(1)').removeClass('active');
			$('.content-participants').find('dd:eq(2)').removeClass('active');
			$('.content-participants').find('li:eq(1)').removeClass('active');
			$('.content-participants').find('li:eq(2)').removeClass('active');
			break;
		case 'Debarred':
			$('.content-participants').find('dd:eq(1)').addClass('active');
			$('.content-participants').find('li:eq(1)').addClass('active');
			$('.content-participants').find('dd:eq(0)').removeClass('active');
			$('.content-participants').find('dd:eq(2)').removeClass('active');
			$('.content-participants').find('li:eq(0)').removeClass('active');
			$('.content-participants').find('li:eq(2)').removeClass('active');
			break;
		case 'All':
			$('.content-participants').find('dd:eq(2)').addClass('active');
			$('.content-participants').find('li:eq(2)').addClass('active');
			$('.content-participants').find('dd:eq(1)').removeClass('active');
			$('.content-participants').find('dd:eq(0)').removeClass('active');
			$('.content-participants').find('li:eq(1)').removeClass('active');
			$('.content-participants').find('li:eq(0)').removeClass('active');
			break;
		default:
			alert('Invalid');
	}
	

	ont = $('.all-student').dataTable({
		"sPaginationType" : "full_numbers",
	});
	
	ont = $('.active-student').dataTable({
		"sPaginationType" : "full_numbers",
	});
	
	ont = $('.debarred-student').dataTable({
		"sPaginationType" : "full_numbers",
	});

	var errorHandler = function(event, id, fileName, reason) {
		qq.log("id: " + id + ", fileName: " + fileName + ", reason: " + reason);
	};

	var fileNum = 0;

	$('#uploadStudent').fineUploader({
		uploadButtonText : "Select Files",
		request : {
			endpoint : "../../adminpanel/include/common/fileupload/php.php",
			paramsInBody : false,
			params : {
				type : 'student',
				subjectID : split[0][1],
				bar : {
					one : '1',
					two : '2',
					three : {
						foo : 'bar'
					}
				},
				fileNum : function() {
					fileNum += 1;
					return fileNum;
				}
			}
		},
		validation: {
            allowedExtensions: ["xls","csv","html","xlsx","gnumeric","ods"],
            sizeLimit: 100000
        },
		retry : {
			enableAuto : true,
			showButton : true
		}
	}).on('error', errorHandler)
	.on('uploadChunk resume', function(event, id, fileName, chunkData) {
		qq.log('on' + event.type + ' -  ID: ' + id + ", FILENAME: " + fileName + ", PARTINDEX: " + chunkData.partIndex + ", STARTBYTE: " + chunkData.startByte + ", ENDBYTE: " + chunkData.endByte + ", PARTCOUNT: " + chunkData.totalParts);
	}).on('complete',function(id, fileName, responseText,xhr) {	
				//alert(JSON.stringify(xhr));
				//alert(responseText);
				
				if(xhr.success) {
				    
			    }
			    else
			    {
			    	alert('sads');
			    }
			    
	});

	$('.unstyled').find('input[type="file"]').addClass('button');
	
	$('#export-student').click(function() {
		$("#modalExport").reveal();
	});
	
	//Vsrious Type
	$('#excelNew').click(function() {
		form = $('#exportForm');
		form.append("<input type='text' value='exportStudent' name='func'>");
		form.append("<input type='text' value='"+split[0][1]+"' name='subjectID'>");
		form.append("<input type='text' value='excelNew' name='type'>");
		
		form.submit();
		$('input[type="text"]').each(function(index) {
		  	$(this).remove();
		});
	});
	
	$('#excel').click(function() {
		form = $('#exportForm');
		form.append("<input type='text' value='exportStudent' name='func'>");
		form.append("<input type='text' value='"+split[0][1]+"' name='subjectID'>");
		form.append("<input type='text' value='excel' name='type'>");
		
		form.submit();
		$('input[type="text"]').each(function(index) {
		  	$(this).remove();
		});
	});
	
	$('#csv').click(function() {
		form = $('#exportForm');
		form.append("<input type='text' value='exportStudent' name='func'>");
		form.append("<input type='text' value='"+split[0][1]+"' name='subjectID'>");
		form.append("<input type='text' value='csv' name='type'>");
		
		form.submit();
		$('input[type="text"]').each(function(index) {
		  	$(this).remove();
		});
	});
	
	$('#pdf').click(function() {
		form = $('#exportForm');
		form.append("<input type='text' value='exportStudent' name='func'>");
		form.append("<input type='text' value='"+split[0][1]+"' name='subjectID'>");
		form.append("<input type='text' value='pdf' name='type'>");
		
		form.submit();
		$('input[type="text"]').each(function(index) {
		  	$(this).remove();
		});
	});
	
});
