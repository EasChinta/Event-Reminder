<?php 
	session_start();
	require("config.php");
	
	if(!isset($_SESSION["login_info"])){
		header("location:index.php");
	}
	$sql="DELETE FROM reminders WHERE ID='{$_GET["id"]}'";
	if($con->query($sql)){
		header("location:home.php");
	}
?>