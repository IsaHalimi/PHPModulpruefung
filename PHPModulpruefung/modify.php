<?php
include ("checkuser.php");

$id = $_GET['id'];
$con = new mysqli("", "root", "", "kino");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datum = $_POST['datum'];
  $film_id = $_POST['film_id'];
  $preis = $_POST['preis'];
  
  $query = "UPDATE presentation SET datum = '$datum', film_id = '$film_id', preis = '$preis' WHERE id = '$id'";
  
  if ($con->query($query)) {
    header("Location: vorstellung.php");
  } else {
    echo "Fehler: " . $con->error;
  }
} else {
  $query = "SELECT * FROM presentation WHERE id = '$id'";
  $result = $con->query($query);
  $row = $result->fetch_assoc();
?>
  
  <form action="modify.php?id=<?php echo $id; ?>" method="post">
    Datum: <input type="text" name="datum" value="<?php echo $row['datum']; ?>"><br>
    Film ID: <input type="text" name="film_id" value="<?php echo $row['film_id']; ?>"><br>
    Preis: <input type="text" name="preis" value="<?php echo $row['preis']; ?>"><br>
    <input type="submit" value="Speichern">
  </form>
  
<?php
}
$con->close();
?>
