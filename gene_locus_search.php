<!DOCTYPE php>
<html>
    <?php
        $gene_locus = "BC1G_$_POST[gene_number]";
        echo "$gene_locus</br>";

        // Query
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
            $query_gene = $dbh->query('SELECT gene_locus, gene_seq, gene_start, gene_stop, gene_length, gene_strand, gene_supercontig, gene_operon, trans_id FROM gene WHERE gene_locus = "'.$gene_locus.'";');

            while ($row = $query_gene->fetch(PDO::FETCH_ASSOC)) {
                // print_r($row);
                $locus = $row['gene_locus'];
                $seq = $row['gene_seq'];
                $start = $row['gene_start'];
                $stop = $row['gene_stop'];
                $length = $row['gene_length'];
                $strand = $row['gene_strand'];
                $supercontig = $row['gene_supercontig'];
                $operon = $row['gene_operon'];
                $trans = $row['trans_id'];
            }
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage() . "<br/>";
            die();
        } catch (Exception $ee) {
            echo "Erreur ! " . $ee->getMessage() . "<br/>";
            die();
        }

        $columns = array($locus, $seq, $start, $stop, $length, $strand, $supercontig, $operon, $trans);

        foreach ($columns as $key => $value) {
            echo $key . " : " . $value . "</br>";
        }
    ?>

    <!-- Display of the gene informations -->
    <!-- <table>


    </table> -->
</html>
