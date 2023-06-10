<?php
include ("checkuser.php");
$con = new mysqli("", "root", "", "kino");

$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$query = "SELECT * FROM kunde ORDER BY $order";

$result = $con->query($query);

if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th><a href='kunden.php?order=id'>id</a></th>
  <th><a href='kunden.php?order=name'>Name</a></th>
  <th><a href='kunden.php?order=strasse'>Strasse</a></th>
  <th><a href='kunden.php?order=hausnummer'>Hausnummer</a></th>
  <th><a href='kunden.php?order=plz'>PLZ</a></th>
  <th><a href='kunden.php?order=ort'>Ort</a></th>
  <th><a href='kunden.php?order=landcode'>Landcode</a></th>
  <th><a href='kunden.php?order=telefon'>Telefon</a></th>
  <th><a href='kunden.php?order=email'>Email</a></th>
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
  echo "Keine Kunden gefunden.";
}

$con->close();
?>
<br>
<br>
<!-- Navigation -->
<a href="intern.php">Zurück</a>