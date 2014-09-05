<?php
	
	if(!isset($_SESSION['directorID']) && empty($_SESSION['directorID']))
	{
		header('Location:../homepage/index.php');
	}

?>