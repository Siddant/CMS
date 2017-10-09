<?php
session_start();

if(!empty($_GET["logout"])) {
	if($_GET["logout"] == "logadminout"){
		unset($_SESSION["manager"]);
		header("location:../index.php"); 
	}else{
		header("location: index.php"); 
	}
}
?>