<?php
session_start();
if(isset($_SESSION["uname"]))//if user is logged in already
{
	header("Location:menu.php"); // then go to page menu.php
}
include ("view/top.html");
include ("view/login.html");


if(isset($_REQUEST["uname"])) // check if input has received from form
{
	$uname=$_REQUEST["uname"];
	$pwd=password_hash($_REQUEST["pwd"],PASSWORD_DEFAULT);
	

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mydbsystem";

// Create connection
	$kalov = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
	if (!$kalov) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM users where username = '$uname' ";
	
	
	$result = mysqli_query($kalov, $sql);
	if (mysqli_num_rows($result) >0 )
	{
		mysqli_close($kalov);
		echo "USER EXISTS";
	}
	else
	{
		$sql = "INSERT INTO users (username, password) values (  '$uname' , '$pwd')";
		if (mysqli_query($kalov, $sql)) 
		{
			mysqli_close($kalov);
			$_SESSION["uname"] = $uname;
			header("Location:menu.php");
		} 
		else 
		{
			mysqli_close($kalov);
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
	}
}

?>