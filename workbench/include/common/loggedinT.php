<?php
	
	if(!isset($_SESSION['teacherID']) && empty($_SESSION['teacherID']))
	{
		header('Location:../homepage/index.php');
	}

?>