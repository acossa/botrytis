<!DOCTYPE PHP>
<html>
    <!-- Je mettrai ca dans un autre fichier plus tard... -->
    <script>
    // Function for the genome region slider.
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

    // Fonction permettant de formatter correctement l'id de gene_locus : 00001
    function numFormat() {
        var num = document.getElementById('gene_number').value;
        if (num.length != 5) {
            if      (num.length == 1) { num = "0000".concat(num); }
            else if (num.length == 2) { num = "000".concat(num); }
            else if (num.length == 3) { num = "00".concat(num); }
            else if (num.length == 4) { num = "0".concat(num); }
            document.getElementById('gene_number').value = num;
            //alert(num);
        }
    }
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
    <form method="POST" action="gene_locus_search.php" name="gene_locus_form" target="_blank" accept-charset="0 1 2 3 4 5 6 7 8 9"><b>Search by Gene locus : <i>BC1G_</i></b>
        <input type="number" name="gene_number" min="00001" max="16448" value="00001" maxlength="5" size="5" id="gene_number" onchange="numFormat()">
        <input type="submit" name="submit_g" value="Search">
    </form>
    </br>

    <!-- Queries by Region -->
    <form method="POST" action="region_search.php" name="region_form" target="_blank"><b>Search by region : </b>
        <input type="text" name="field_region" id="amount" readonly maxlength="18" style="border:0; color:darkgreen; font-weight:bold;">
        <input type="submit" name="submit_r" value="Search"></br> </br>
        <div id="slider-range" style="width:50%"></div>
    </form>
    </br>

    <!-- Queries by protein name -->
    <form method="POST" action="prot_name_search.php" name="prot_name_form" target="_blank"><b>Search by Protein name : </b>
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
        <!-- <input name="prot_name_search_button" size="40" value="Search" type="submit"> -->
        <input type="submit" name=submit_p value="Search">
    </form>
    </br>

    <!-- Display of the query results -->
    <div>
        <!-- <?php

        // /!\ Ne marche pas encore, en cours... /!\

        // include('gene_locus_search.php');
        // include('region_search.php');
        // include('prot_name_search.php');
         ?> -->
    </div>
    </p>



</html>
