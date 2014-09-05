<?php
	require 'core.inc.php';
	require 'dbhelper.inc.php';
	require 'help.inc.php';
	
	require_once 'Classes/PHPExcel.php';
	require_once 'Classes/PHPExcel/IOFactory.php';
	
	//getSession();
	
	if(isset($_POST['func'],$_POST['subjectID'],$_POST['type']))
	{
		if(!empty($_POST['func']) &&!empty($_POST['subjectID']) &&!empty($_POST['type']) && $_POST['func']=='exportStudent')
		{		
			studentExport($_POST['type']);			
		}		
		else {
			echo "Invalid:Empty";
		}
	}
	else {
		echo "Invalid:Isset";
	}
	
	function studentExport($type)
	{
		$subjectID = $_POST['subjectID'];
		$type = $_POST['type'];
		
		$subjectName;
		$time=date('Y-m-d H:i:s',time());
		
		$db = new dbHelper;
		$db->ud_connectToDB();	
		
		$result = $db->ud_getQuery("select * from ud_users as u,ud_users_subjects as s, ud_subject as sub where u.userID = s.userSID AND s.subjectID = $subjectID AND sub.subjectID=s.subjectID");
		$facultyName=$_SESSION['userName'];
		
		
		
		if($db->ud_getRowCountResult($result)>0)
		{
			
			$userValues = $db->ud_mysql_fetch_assoc($result);
			$subjectName=$userValues['subjectName'];
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle($subjectName);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'userCode');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'userName');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'userLogin');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'userPassword');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'userEmail');	
			$count=2;
			//As I am getting subje name
			$objPHPExcel->getActiveSheet()->setCellValue("A$count", $userValues['userCode']);
			$objPHPExcel->getActiveSheet()->setCellValue("B$count", $userValues['userName']);
			$objPHPExcel->getActiveSheet()->setCellValue("C$count", $userValues['userLogin']);
			$objPHPExcel->getActiveSheet()->setCellValue("D$count", $userValues['userPassword']);
			$objPHPExcel->getActiveSheet()->setCellValue("E$count", $userValues['userEmail']);	
			$count++;
			
			while ($userValues = $db->ud_mysql_fetch_assoc($result)) {
				
				
				$objPHPExcel->getActiveSheet()->setCellValue("A$count", $userValues['userCode']);
				$objPHPExcel->getActiveSheet()->setCellValue("B$count", $userValues['userName']);
				$objPHPExcel->getActiveSheet()->setCellValue("C$count", $userValues['userLogin']);
				$objPHPExcel->getActiveSheet()->setCellValue("D$count", $userValues['userPassword']);
				$objPHPExcel->getActiveSheet()->setCellValue("E$count", $userValues['userEmail']);				
				
				$count++;
				
			}
			
			if($type=='excelNew')
			{
				// Redirect output to a client’s web browser (Excel5)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="studentList_'.$subjectName.'_'.$facultyName.'_'.$time.'.xlsx"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save('php://output');
			}elseif($type=='excel')
			{
				// Redirect output to a client’s web browser (Excel5)
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="studentList_'.$subjectName.'_'.$facultyName.'_'.$time.'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
			elseif ($type=='csv') 
			{
				// Redirect output to a client’s web browser (Excel5)
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment;filename="studentList_'.$subjectName.'_'.$facultyName.'_'.$time.'.csv"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
				$objWriter->save('php://output');				
			}
			elseif ($type=='pdf') {
				$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
				//$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
				//$rendererLibrary = 'tcPDF5.9';
				$rendererLibrary = 'MPDF56';
				//$rendererLibrary = 'domPDF0.6.0beta3';
				$rendererLibraryPath = $rendererLibrary;
				
				if (!PHPExcel_Settings::setPdfRenderer(
				        $rendererName,
				        $rendererLibraryPath
				    )) {
				    die(
				        'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
				        '<br />' .
				        'at the top of this script as appropriate for your directory structure'
				    );
				}

				 
				// Redirect output to a clientâs web browser (PDF)
				header('Content-Type: application/pdf');
				header('Content-Disposition: attachment;filename="studentList_'.$subjectName.'_'.$facultyName.'_'.$time.'.pdf"');
				header('Cache-Control: max-age=0');
				 
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
				$objWriter->save('php://output');
			}
				
			
			/*
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('Name of Sheet 1');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');
			
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="studentList".xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			 * 
			 */
		}
		else {
			echo "No Students";
		}
		
		
	}

?>