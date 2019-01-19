<!DOCTYPE PHP>
<html>
    <script type="text/javascript" src="./js/functions.js"></script>

    <!-- Connection to the database -->
    <?php
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
    } catch (PDOException $e) {
        print "Erreur ! " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    <h1>Access Database</h1>
    <br/></br>

    <p>
        <!-- Queries by Gene locus -->
        <form method="POST" action="gene_locus_search.php" name="gene_locus_form" target="_blank" accept-charset="0 1 2 3 4 5 6 7 8 9"><b>Search a specific Gene locus: <i>BC1G_</i></b>
            <input type="number" name="gene_number" min="00001" max="16448" value="00001" maxlength="5" size="5" required id="gene_number" pattern="[0-9]{5}" onchange="numFormat()">
            <input type="submit" name="submit_g" value="Search">
        </form>
        </br>

        <!-- Queries by Region -->
        <form method="POST" action="region_search.php" name="region_form" target="_blank"><b>Search by region: </b>
            <input type="text" name="field_region" id="amount" readonly maxlength="18" style="border:0; color:darkgreen; font-weight:bold;">
            <input type="submit" name="submit_r" value="Search"></br> </br>
            <div id="slider-range" style="width:50%"></div>
        </form>
        </br>

        <!-- Queries by protein name -->
        <form method="POST" action="prot_name_search.php" name="prot_name_form" target="_blank"><b>Search by Protein name: </b></br></br>
            <select name="field_prot_name">
                <?php
                try {
                    // List of all the proteins in the database
                    $prot_name_list = $dbh->query('SELECT prot_name FROM prot_name;');
                }
                catch (Exception $e) {
                    echo 'Erreur : '.$e->getMessage();
                }
                while ($row = $prot_name_list->fetch(PDO::FETCH_ASSOC)) {
                    // Create an option field for each protein
                    echo '<option value="'.$row['prot_name'].'">'.$row['prot_name'].'</option>';
                }
                ?>
            </select>
            <input type="submit" name=submit_p value="Search">
        </form>
        </br>
        <b><a href="blast.php" target="_blank" title="Open BLAST Tool in a new tab">BLAST Tool</a></b>
    </p>
</html>
