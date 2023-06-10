<?php
include ("checkuser.php");
$con = new mysqli("", "root", "", "kino");

$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$query = "SELECT * FROM verleiher ORDER BY $order";

$result = $con->query($query);

if ($result->num_rows > 0) {
  echo "<table border='1'>
  <tr>
  <th><a href='verleiher.php?order=id'>id</a></th>
  <th><a href='verleiher.php?order=name'>Name</a></th>
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
  echo "Keine Verleiher gefunden.";
}

$con->close();
?>
<br>
<br>
<!-- Navigation -->
<a href="intern.php">Zurück</a>