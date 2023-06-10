<?php 
session_start (); 
if (!isset ($_SESSION["user_name"]))
{ 
  header ("Location: formular.php"); 
}

if($_SESSION["user_type"] == "1")
{
	echo "Sie sind als Admin eingeloggt!<br>";
	
}

if($_SESSION["user_type"] == "2")
{
	echo "Sie sind als User eingeloggt!<br>";
	
}
?>