<!DOCTYPE PHP>
<html>
    <?php
        include("./functions.php");
        
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
            // $dbh = null;
        } catch (PDOException $e) {
            print "Erreur ! " . $e->getMessage() . "<br/>";
            die();
        }

        echo '<datalist id="name">';
        try {
            $query = $dbh->prepare('SELECT gene_locus FROM gene;');
            $query->execute();
        }
        catch (Exception $e){
            echo 'Erreur : '.$e->getMessage();
        }
        // $result = $query->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($result as $row) {
        //     echo "<option value='".$row['name']. "'>";
        // }
        // echo '</datalist></br></br>';

        // Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
		if ($query->rowCount() == 0) {
			echo 'Aucun résultat pour la requête, veuillez réessayer svp.';
		}
		else{
			// $file=echo_resultats_sp($query);
			echo_results($query);
		}

    ?>
    <h2>Access Database</h2>
    <p>
        <b>Type of information</b><br/>
    </p>
</html>
