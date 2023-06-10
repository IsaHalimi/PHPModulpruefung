<?php
include ("checkuser.php");
$con = new mysqli("", "root", "", "kino");

$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$query = "SELECT * FROM film ORDER BY $order";

$result = $con->query($query);

if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th><a href='filme.php?order=id'>id</a></th>
  <th><a href='filme.php?order=titel'>Titel</a></th>
  <th><a href='filme.php?order=verleiher_id'>Verleiher ID</a></th>
  </tr>";
  
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $col) {
      echo "<td>$col</td>";
    }
    echo "</tr>";
  }
  
  echo "</table>";
} else {
  echo "Keine Filme gefunden.";
}

$con->close();
?>
<br>
<br>
<!-- Navigation -->
<a href="intern.php">Zurück</a>