<?php
	
	if(!isset($_SESSION['studentID']) && empty($_SESSION['studentID']))
	{
		header('Location:../homepage/index.php');
	}

?>