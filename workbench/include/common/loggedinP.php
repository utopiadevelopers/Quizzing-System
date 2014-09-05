<?php
	
	if(!isset($_SESSION['parentID']) && empty($_SESSION['parentID']))
	{
		header('Location:../homepage/index.php');
	}

?>