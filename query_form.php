<!DOCTYPE PHP>
<html>

    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
        // $dbh = null;
    } catch (PDOException $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    <h2>Access Database</h2>
    <p>
    <b>Type of information</b><br />

    Search by gene locus : </br>
    Search by protein name :

    <form method="POST" action="prot_name_search.php"><b>Search by Protein Name : </b> <!--action="" a rajouter plus tard....-->
        <select name="field_prot_name">
            <?php
            try {
                // Liste de toutes les proteines de la base
                $prot_name_list = $dbh->query('SELECT prot_name FROM prot_name;');
            }
            catch (Exception $e) {
                echo 'Erreur : '.$e->getMessage();
            }
            while ($row = $prot_name_list->fetch(PDO::FETCH_ASSOC)) {
                // Creer une option pour chaque nom de proteine
                echo '<option value="'.$row['prot_name'].'>'.$row['prot_name'].'</option>';
            }
            ?>
        </select>
        <!-- <input name="prot_name_search_button" size="40" value="Search" type="submit"> -->
        <input type="submit" value="Search">
    </form>
    </br>
    Search by region : compris entre 2-1305633</br>
    </p>
</html>
