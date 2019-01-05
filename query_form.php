<!DOCTYPE PHP>
<html>
    <!-- Script for the region slider -->
    <script>
    $( function() {
      $( "#slider-range" ).slider({
        range: true,
        min: 1,
        max: 1305633,
        values: [ 1, 1305633 ],
        slide: function( event, ui ) {
          $( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
        }
      });
      $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
        " - " + $( "#slider-range" ).slider( "values", 1 ) );
    } );
    </script>

    <!-- Connection to the database -->
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
    <b>Type of information</b><br/>
    </br>

    <!-- Queries by Gene locus -->
    <form method="POST" action="gene_locus_search.php" name=""><b>Search by Gene locus : <i>BC1G_</i></b>
        <input type="number" min="1" max="16448">
        <input type="submit" form=value="Search">
    </form>
    </br>

    <!-- Queries by Region -->
    <form method="POST" action="region_search.php"><b>Search by region : </b>
        <input type="text" id="amount" readonly maxlength="18" style="border:0; color:darkgreen; font-weight:bold;">
        <input type="submit" value="Search"></br>
        <div id="slider-range" style="width:50%"></div>
    </form>
    </br>

    <!-- Queries by protein name -->
    <form method="POST" action="prot_name_search.php"><b>Search by Protein name : </b>
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

    </p>



</html>
