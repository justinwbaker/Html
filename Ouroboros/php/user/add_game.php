<?php 
	require_once 'json_manager.php';

if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game'])){
	addGameToUser($_GET['username'], $_GET['UUID'], $_GET['game']);
	header("location: welcome.php");
}

?>