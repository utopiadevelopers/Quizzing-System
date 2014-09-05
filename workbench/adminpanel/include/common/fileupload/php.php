<?php
session_start();

require_once '../Classes/PHPExcel.php';
require_once '../dbhelper.inc.php';
require_once '../../../../include/modules/teacher/teacher.inc.php';

if(isset($_GET['type'],$_GET['subjectID']) && $_GET['type']=="student")
{
	importStudents();
}
else {
	die('Invalid');
}

//Example of how to use this uploader class...
//You can uncomment the following lines (minus the require) to use these as your defaults.

// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array("xls","csv","html","xlsx","gnumeric","ods");
// max file size in bytes
$sizeLimit = 10 * 1024 * 1024;


function importStudents()
{
	//require('valums-file-uploader/server/php.php');
	$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	
	// If you want to use resume feature for uploader, specify the folder to save parts.
	$uploader->chunksFolder = '../../../uploads/chunks';
	
	$uploader->inputName='sds';
	
	// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
	$result = $uploader->handleUpload('../../../uploads/students/');
	//print_r($result);
	$filename=$uploader->getUploadName();
	
	$inputFileName = '../../../uploads/students/'.$filename;

	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	//echo 'File ',pathinfo($inputFileName,PATHINFO_BASENAME),' has been identified as an ',$inputFileType,' file<br />';
	//Hack
	//echo $uploader->getUploadExtension();
	
	if($uploader->getUploadExtension()=='.csv')
		$inputFileType = 'CSV';
	//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory with the identified reader type<br />';
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);
	
	
	//echo '<hr />';
	
	$sheetData = $objPHPExcel->getActiveSheet()->toArray();
	//$result['sdas']='sads';
	//print_r($sheetData);
	
	$db = new dbHelper;
	$db->ud_connectToDB();	
	$failure=array();
	$failureFormat=array();
	$addedEntries=array();
	$subjectID=$_GET['subjectID'];
	//echo 'debug';
	for($i=0;$i<sizeof($sheetData);$i++)
	{
		$innernode=$sheetData[$i];
		if($innernode!=null && !($innernode[0]=='userCode' || $innernode[1]=='userName' ||$innernode[2]=='userLogin'||$innernode[3]=='userEmail' ||$innernode[4]=='userPassword' ))
		{
			//print_r($innernode);
			if(sizeof($innernode)==5)
			{
				$Qresult = $db->ud_whereQuery('ud_users',array('userID'), array('userCode'=>$innernode[0],'userLogin'=>$innernode[2]),'OR');
				$present = $db->ud_getRowCountResult($Qresult);
				
				if($present == 0)
				{
					//New Timestamp Every insert Hack
					$timestamp = date('Y-m-d H:i:s',time()+rand(1, 1000));
					$innernode[3]=md5($innernode[3]);
					$Qresult = $db->ud_insertQuery('ud_users', array('userCode'=>$innernode[0],'timestamp'=>$timestamp,'userName'=>$innernode[1],'userLogin'=>$innernode[2],'userPassword'=>$innernode[3],'userEmail'=>$innernode[4],'userRole'=>4));
					$Qresult= $db->ud_whereQuery('ud_users',array('userID'),array('timestamp'=>$timestamp));
					$Qresult = $db->ud_mysql_fetch_assoc($Qresult);
					
					$userID=$Qresult['userID'];
					$Qresult = $db->ud_insertQuery('ud_users_subjects',array('userTID'=>$_SESSION['teacherID'],'userSID'=>$userID,'subjectID'=>$subjectID));
					updateMod($subjectID);
					array_push($addedEntries,$innernode);
					
				}
				else {
					$Qresult = $db->ud_getQuery("select userID,subjectID from ud_users,ud_users_subjects where userCode='$innernode[0]' AND userLogin='$innernode[2]' AND userID=userSID");
					$present = $db->ud_getRowCountResult($result);
					if($present != 0)
					{
						//JSUT Check and Add to subject
						$userid=$db->ud_mysql_fetch_assoc($result);
						$userID = $userid['userID'];
						$existingSubjectID=$userid['subjectID'];
						
						if($subjectID == $existingSubjectID)
						{
							//EXISTS
							array_push($failure,$innernode);
						}
						else {
							$Qresult = $db->ud_insertQuery('ud_users_subjects',array('userTID'=>$_SESSION['teacherID'],'userSID'=>$userID,'subjectID'=>$subjectID));				
							updateMod($subjectID);
							array_push($addedEntries,$innernode);
							
						}
					}
					else {
						array_push($failure,$innernode);
					}
				}
			}			
		}
		else
		{
			array_push($failureFormat,$innernode);
		}
	}
	if(unlink($inputFileName)){}
	else
	{
		$result['error']="File Deletion Failed";
	}
	
	$result['failure']=$failure;
	
	$result['failureFormat']=$failureFormat;
	
	$result['addedEntries']=$addedEntries;
		
		
	
	//print_r($result);
	//echo $uploader->getUploadName();
	// to pass data through iframe you will need to encode all html tags
	echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
}




/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    public function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }

    /**
     * Get the original filename
     * @return string filename
     */
    public function getName() {
        return $_GET['qqfile'];
    }
    
    /**
     * Get the file size
     * @return integer file-size in byte
     */
    public function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {
	  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    public function save($path) {
        return move_uploaded_file($_FILES['qqfile']['tmp_name'], $path);
    }
    
    /**
     * Get the original filename
     * @return string filename
     */
    public function getName() {
        //return $_FILES['qqfile']['name'];
        return $_GET['qqfile'];
    }
    
    /**
     * Get the file size
     * @return integer file-size in byte
     */
    public function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

/**
 * Class that encapsulates the file-upload internals
 */
class qqFileUploader {
    private $allowedExtensions;
    private $sizeLimit;
    private $file;
	private $ext;
    private $uploadName;

    /**
     * @param array $allowedExtensions; defaults to an empty array
     * @param int $sizeLimit; defaults to the server's upload_max_filesize setting
     */
    function __construct(array $allowedExtensions = null, $sizeLimit = null){
        if($allowedExtensions===null) {
            $allowedExtensions = array();
    	}
    	if($sizeLimit===null) {
    	    $sizeLimit = $this->toBytes(ini_get('upload_max_filesize'));
    	}
    	        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if(!isset($_SERVER['CONTENT_TYPE'])) {
            $this->file = false;	
        } else if (strpos(strtolower($_SERVER['CONTENT_TYPE']), 'multipart/') === 0) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = new qqUploadedFileXhr();
        }
    }
    
    /**
     * Get the name of the uploaded file
     * @return string
     */
    public function getUploadName(){
        if( isset( $this->uploadName ) )
            return $this->uploadName;
    }
	
    /**
     * Get the original filename
     * @return string filename
     */
    public function getName(){
        if ($this->file)
            return $this->file->getName();
    }
	
	
    public function getUploadExtension(){
        if ($this->file)
            return $this->ext;
    }
    
    /**
     * Internal function that checks if server's may sizes match the
     * object's maximum size for uploads
     */
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die(json_encode(array('error'=>'increase post_max_size and upload_max_filesize to ' . $size)));    
        }        
    }
    
    /**
     * Convert a given size with units to bytes
     * @param string $str
     */
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Handle the uploaded file
     * @param string $uploadDirectory
     * @param string $replaceOldFile=true
     * @returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        //$filename = $pathinfo['filename'];
		
		
        $filename = $_SESSION['userLogin'].'_'.time();
        $ext = @$pathinfo['extension'];		// hide notices if extension is empty

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension '.$ext.', it should be one of '. $these . '.');
        }
        
        $ext = ($ext == '') ? $ext : '.' . $ext;
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . DIRECTORY_SEPARATOR . $filename . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        $this->uploadName = $filename . $ext;
		
		$this->ext = $ext;
		
        if ($this->file->save($uploadDirectory . DIRECTORY_SEPARATOR . $filename . $ext)){
            return array('success'=>true);
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }    
}

?>