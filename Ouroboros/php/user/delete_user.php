<?php
session_start();

	require_once 'config.php';

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header("location: login.php");
    } else {
        $sql = "DELETE FROM users WHERE username=\"" . $_SESSION['username'] . "\"";

        $link->query($sql);
        header("location: register.php");
    }
    
    // Close connection
    mysqli_close($link);

?>