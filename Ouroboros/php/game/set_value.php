<?php 
	require_once 'json_manager.php';

	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['variable']) && !isset($_GET['time']) && isset($_GET['value'])){
		setValue($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['variable'], $_GET['value']);
	}

	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['variable']) && isset($_GET['time']) && isset($_GET['value'])){
		setTimeValue($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['time'], $_GET['variable'], $_GET['value']);
	}

 ?>