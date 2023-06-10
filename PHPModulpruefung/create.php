<?php
include ("checkuser.php");

$con = new mysqli("", "root", "", "kino");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datum = $_POST['datum'];
  $zeit = $_POST['zeit'];
  $film_id = $_POST['film_id'];
  $preis = $_POST['preis'];
  
  // Überprüfen, ob das Datum und die Zeit im richtigen Format vorliegen
  $parsedDate = date_parse_from_format("Y-m-d", $datum);
  $parsedTime = date_parse_from_format("H:i:s", $zeit);
  
  if ($parsedDate['error_count'] === 0 && $parsedDate['warning_count'] === 0 &&
      $parsedTime['error_count'] === 0 && $parsedTime['warning_count'] === 0) {
    // Überprüfen, ob die Film-ID in der `film` Tabelle existiert
    $filmQuery = "SELECT COUNT(*) as count FROM film WHERE id = '$film_id'";
    $filmResult = $con->query($filmQuery);
    $filmRow = $filmResult->fetch_assoc();
  
    if ($filmRow['count'] > 0) {
      // Film-ID existiert, Vorstellung einfügen
      $datetime = $datum . ' ' . $zeit;
      
      $query = "INSERT INTO presentation (datum, film_id, preis) VALUES ('$datetime', '$film_id', '$preis')";
  
      if ($con->query($query)) {
        header("Location: vorstellung.php");
      } else {
        echo "Fehler: " . $con->error;
      }
    } else {
      echo "Fehler: Die Film-ID existiert nicht.";
    }
  } else {
    // JavaScript-Aufruf, um Fehlermeldung als Popup-Fenster anzuzeigen
    echo "<script>alert('Fehler: Das Datum oder die Zeit sind im falschen Format.');</script>";
  }
} else {
?>
  <form action="create.php" method="post">
    Datum (YYYY-MM-DD): <input type="text" name="datum"><br>
    Zeit (HH:MM:SS): <input type="text" name="zeit"><br>
    Film ID:
    <select name="film_id">
      <?php
      $filmQuery = "SELECT id, titel FROM film";
      $filmResult = $con->query($filmQuery);
      
      if ($filmResult->num_rows > 0) {
        while($filmRow = $filmResult->fetch_assoc()) {
          echo "<option value='" . $filmRow['id'] . "'>" . $filmRow['titel'] . "</option>";
        }
      }
      ?>
    </select><br>
    Preis: <input type="text" name="preis" placeholder="Geben Sie den Preis ein"><br>
    <input type="submit" value="Erstellen">
  </form>
  
<?php
}
$con->close();
?>
