<?php
include ("checkuser.php");
$con = new mysqli("", "root", "", "kino");

$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$query = "SELECT * FROM presentation ORDER BY $order";

$result = $con->query($query);

if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th><a href='vorstellung.php?order=id'>id</a></th>
  <th><a href='vorstellung.php?order=datum'>Datum</a></th>
  <th><a href='vorstellung.php?order=film_id'>Film ID</a></th>
  <th><a href='vorstellung.php?order=preis'>Preis</a></th>
  <th>Aktionen</th>
  </tr>";
  
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $col) {
      echo "<td>$col</td>";
    }
    echo "<td><a href='modify.php?id=".$row['id']."'>Modifizieren</a> | <a href='delete.php?id=".$row['id']."'>Löschen</a></td>";
    echo "</tr>";
  }
  
  echo "</table>";
} else {
  echo "Keine Vorstellungen gefunden.";
}

echo "<a href='create.php'>Neue Vorstellung hinzufügen</a>";

$con->close();
?>
<br>
<br>
<!-- Navigation -->
<a href="intern.php">Zurück</a>