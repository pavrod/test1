<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("Location:index.php");
}

include ("view/top.html");
?>