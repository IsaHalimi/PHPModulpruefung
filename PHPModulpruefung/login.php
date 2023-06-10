<?php 
// Session starten 
session_start (); 

// Datenbankverbindung aufbauen 
   $con = new mysqli("", "root", "", "firma");
   $sql = "SELECT * FROM login WHERE ". 
       "(benutzername like '".$_REQUEST["name"]."') AND ". 
       "(passwort = '".md5 ($_REQUEST["pwd"])."')"; 
    
    $res = $con->query($sql);
	$anzahl = $con->affected_rows;
	
	if ($anzahl > 0)
    { 
      // Benutzerdaten in ein Array auslesen. 
      $data = mysqli_fetch_array ($res); 

      // Sessionvariablen erstellen und registrieren 
      $_SESSION["user_name"] = $data["benutzername"]; 
      $_SESSION["user_type"] = $data["usertype"]; 
      header ("Location: intern.php"); 
    } 
    else 
    { 
      header ("Location: formular.php?fehler=1"); 
    } 
?> 
