<?php 
	require_once 'json_manager.php';
	
	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['variable']) && !isset($_GET['time'])){
		echo getValue($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['variable'], $_GET['value']);
	}

	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['variable']) && isset($_GET['time'])){
		echo getTimeValue($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['time'], $_GET['variable'], $_GET['value']);
	}

 ?>