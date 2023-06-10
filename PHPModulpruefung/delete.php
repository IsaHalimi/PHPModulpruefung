<?php
include ("checkuser.php");

$id = $_GET['id'];
$con = new mysqli("", "root", "", "kino");

$query = "DELETE FROM presentation WHERE id = '$id'";

if ($con->query($query)) {
  header("Location: vorstellung.php");
} else {
  echo "Fehler: " . $con->error;
}

$con->close();
?>
