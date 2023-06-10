<?php
include ("checkuser.php");
$con = new mysqli("", "root", "", "kino");

$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$query = "SELECT * FROM bestellung ORDER BY $order";

$result = $con->query($query);

if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th><a href='bestellung.php?order=id'>id</a></th>
  <th><a href='bestellung.php?order=kunde_id'>Kunde ID</a></th>
  <th><a href='bestellung.php?order=presentation_id'>Vorstellung ID</a></th>
  <th><a href='bestellung.php?order=anzahl'>Anzahl</a></th>
  <th><a href='bestellung.php?order=kreditkartenummer'>Kreditkartennummer</a></th>
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
  echo "Keine Bestellungen gefunden.";
}

$con->close();
?>
<br>
<br>
<!-- Navigation -->
<a href="intern.php">Zurück</a>
