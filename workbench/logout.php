<?php
	require 'include/common/core.inc.php';

	session_destroy();
	
	header('Location:index.php');
	ob_get_clean();
?>