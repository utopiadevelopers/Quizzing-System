<?php
	require '../../include/common/core.inc.php';
	require '../../include/common/loggedinD.php';
	require '../../adminpanel/include/common/dbhelper.inc.php';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	

	if(isset($_POST['subjectName'],$_POST['overview']))
	{
		if(!empty($_POST['subjectName']) &&!empty($_POST['overview']))
		{
			$file_name = '';
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$extension = end(explode(".", $_FILES["file"]["name"]));
			if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/jpg")
					|| ($_FILES["file"]["type"] == "image/pjpeg")
					|| ($_FILES["file"]["type"] == "image/x-png")
					|| ($_FILES["file"]["type"] == "image/png"))
					&& in_array($extension, $allowedExts))
			{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Error: " . $_FILES["file"]["error"] . "<br>";
				}
				else
				{
					$extension = end(explode(".", $_FILES["file"]["name"]));
					$file_name  =  time().'.'.$extension;
					move_uploaded_file($_FILES["file"]["tmp_name"],"../../uploads/subject/" .$file_name);
				}
			}
			$subjectName = htmlentities($_POST['subjectName']);
			$overview = htmlentities($_POST['overview']);
			
			$db->ud_insertQuery('ud_subject',array('subjectName'=>$subjectName,'subjectDetail'=>$overview,'subjectLogo'=>$file_name));
		}
	}
?>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]--><!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">

<![endif]--><!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">

<![endif]--><!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">

<!--<![endif]-->

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $_SESSION['userLogin'] ?> - Home</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />

<?php require '../../include/header/foundation.php'; ?>


</head>

<body>
<?php require '../../include/header/headerD.php'; ?>
<div class="row content">
	<h4 style="margin-bottom: 50px;">Add Course</h4>
	<form action="addCourse.php" method="post" enctype="multipart/form-data" >
		<div class="row">
			<div class="two columns">
				<label class="inline">Subject Name</label>
			</div>
			<div class="five columns">
				<input type="text" placeholder="Subject Name" name="subjectName"/>
			</div>
			<div class="seven columns">
			</div>
		</div>
		<div class="row">
			<div class="two columns">
				<label class="inline">Subject Icon</label>
			</div>
			<div class="five columns">
				<input name="file" type="file" id="file" />
			</div>
			<div class="seven columns">
			</div>
		</div>
		<div class="row">
			<div class="two columns">
				<label class="inline">Subject Overview</label>									
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<textarea id="suggest" name="overview" placeholder="Course Overview" rows="4" ></textarea>
			</div>										
		</div>
		<input type="submit" class="secondary button two" value="Add"/>
	</form>
</div> 
<?php require '../../include/footer/footerD.php'; ?>
<script language="javascript" src="../../resources/js/modules/director/view-subject.js" type="text/javascript"></script>
</body>

</html>
