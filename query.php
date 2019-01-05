<!DOCTYPE PHP>
<html>

  <?php
  try {
      $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
      $dbh = null;
  } catch (PDOException $e) {
      print "Erreur ! " . $e->getMessage() . "<br/>";
      die();
  }
  ?>
  <h2>Access Database</h2>
  <p>
    <b>Type of information</b><br />

  </p>
</html>
