<?php

	if(isset($_SESSION['adminID']) && !empty($_SESSION['adminID']))
	{
		header('Location:../../adminpanel/index.php');
	}
	else if(isset($_SESSION['directorID']) && !empty($_SESSION['directorID']))
	{
		header('Location:../director/index.php');
	}
	else if(isset($_SESSION['teacherID']) && !empty($_SESSION['teacherID']))
	{
		header('Location:../teacher/index.php');
	}
	else if(isset($_SESSION['studentID']) && !empty($_SESSION['studentID']))
	{
		header('Location:../student/index.php');
	}
	else if(isset($_SESSION['parentID']) && !empty($_SESSION['parentID']))
	{
		header('Location:../parent/index.php');
	}

?>